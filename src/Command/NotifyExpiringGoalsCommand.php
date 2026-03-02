<?php

namespace App\Command;

use App\Repository\ObjectifRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[AsCommand(
    name: 'app:notify-expiring-goals',
    description: 'Envoie des emails de rappel pour les objectifs arrivant bientôt à échéance',
)]
class NotifyExpiringGoalsCommand extends Command
{
    private $objectifRepository;
    private $mailer;

    public function __construct(ObjectifRepository $objectifRepository, MailerInterface $mailer)
    {
        parent::__construct();
        $this->objectifRepository = $objectifRepository;
        $this->mailer = $mailer;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Vérification des échéances d\'objectifs');

        try {
            $now = new \DateTime();
            
            $goals = $this->objectifRepository->createQueryBuilder('o')
                ->where('o.progression < 100')
                ->andWhere('o.date_fin IS NOT NULL')
                ->getQuery()
                ->getResult();

            $count = 0;
            foreach ($goals as $goal) {
                $targetDate = $goal->getDateFin();
                $diff = $now->diff($targetDate);
                $days = (int) $diff->format('%r%a');
                
                // Notification pour aujourd'hui (0) ou demain (1)
                if ($days === 0 || $days === 1) {
                    $user = $goal->getUtilisateur();
                    if ($user && $user->getEmail()) {
                        $email = (new Email())
                            ->from('life.ops.esprit@gmail.com')
                            ->to($user->getEmail())
                            ->subject('🔔 Échéance proche : ' . $goal->getTitre())
                            ->html(sprintf(
                                "<h3>Bonjour %s,</h3>
                                <p>Votre objectif <strong>'%s'</strong> arrive à échéance le <strong>%s</strong>.</p>
                                <p>Il vous reste encore un peu de chemin pour atteindre 100%% (actuellement à %d%%).</p>
                                <p>Ne baissez pas les bras, vous y êtes presque ! ✨</p>
                                <br>
                                <p>L'équipe LifeOps</p>",
                                htmlspecialchars($user->getEmail()),
                                htmlspecialchars($goal->getTitre()),
                                $targetDate->format('d/m/Y'),
                                $goal->getProgression()
                            ));
                        
                        $this->mailer->send($email);
                        $count++;
                        
                        $io->text(sprintf('- Email de rappel envoyé à %s pour "%s"', $user->getEmail(), $goal->getTitre()));
                    }
                }
            }

            if ($count > 0) {
                $io->success(sprintf('%d notification(s) envoyée(s) avec succès.', $count));
            } else {
                $io->info('Aucun objectif n\'arrive à échéance aujourd\'hui ou demain.');
            }

        } catch (\Throwable $e) {
            $io->error('Une erreur est survenue : ' . $e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
