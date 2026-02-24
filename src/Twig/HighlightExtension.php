<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class HighlightExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('highlight', [$this, 'highlightText'], ['is_safe' => ['html']]),
        ];
    }

    public function highlightText(?string $text, ?string $search): string
    {
        if (!$text) {
            return '';
        }

        if (!$search || trim($search) === '') {
            return htmlspecialchars($text);
        }

        $search = preg_quote($search, '/');
        
        // Wrap matches in a span with a specific class for styling
        // Using preg_replace with 'i' for case-insensitive matching
        return preg_replace(
            '/(' . $search . ')/i',
            '<span class="bg-primary/20 text-primary-foreground font-bold px-1 rounded shadow-[0_0_10px_hsl(var(--primary)/0.3)]">$1</span>',
            htmlspecialchars($text)
        );
    }
}
