<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* other/finance/index.html.twig */
class __TwigTemplate_0f6632b3135e9ab966bc7edefb114fa1 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/finance/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/finance/index.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Finances - LifeOps";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "    <div class=\"flex items-center justify-between mb-8\">
        <div>
            <h1 class=\"text-3xl font-bold tracking-tight text-foreground\">Gestion Financière</h1>
            <p class=\"text-muted-foreground\">Suivez vos budgets et dépenses</p>
        </div>
        <div class=\"flex gap-2\">
            <a href=\"";
        // line 12
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_budget_new");
        yield "\" class=\"inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2\">
                Nouveau Budget
            </a>
            <a href=\"";
        // line 15
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_depense_new");
        yield "\" class=\"inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2\">
                Ajouter Dépense
            </a>
        </div>
    </div>

    ";
        // line 22
        yield "    ";
        if ((($tmp = (isset($context["currentBudget"]) || array_key_exists("currentBudget", $context) ? $context["currentBudget"] : (function () { throw new RuntimeError('Variable "currentBudget" does not exist.', 22, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 23
            yield "        <div class=\"mb-8 rounded-xl border border-border bg-card text-card-foreground shadow p-6\">
            <div class=\"flex items-center justify-between mb-4\">
                <h2 class=\"text-lg font-semibold\">Budget du Mois (";
            // line 25
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["currentBudget"]) || array_key_exists("currentBudget", $context) ? $context["currentBudget"] : (function () { throw new RuntimeError('Variable "currentBudget" does not exist.', 25, $this->source); })()), "mois", [], "any", false, false, false, 25), "html", null, true);
            yield ")</h2>
                <span class=\"text-sm text-muted-foreground\">Revenu: ";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, (isset($context["currentBudget"]) || array_key_exists("currentBudget", $context) ? $context["currentBudget"] : (function () { throw new RuntimeError('Variable "currentBudget" does not exist.', 26, $this->source); })()), "revenuMensuel", [], "any", false, false, false, 26), 2, ",", " "), "html", null, true);
            yield " €</span>
            </div>
            
            ";
            // line 29
            $context["percentage"] = (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["currentBudget"]) || array_key_exists("currentBudget", $context) ? $context["currentBudget"] : (function () { throw new RuntimeError('Variable "currentBudget" does not exist.', 29, $this->source); })()), "plafond", [], "any", false, false, false, 29) > 0)) ? ((((isset($context["totalDepensesMonth"]) || array_key_exists("totalDepensesMonth", $context) ? $context["totalDepensesMonth"] : (function () { throw new RuntimeError('Variable "totalDepensesMonth" does not exist.', 29, $this->source); })()) / CoreExtension::getAttribute($this->env, $this->source, (isset($context["currentBudget"]) || array_key_exists("currentBudget", $context) ? $context["currentBudget"] : (function () { throw new RuntimeError('Variable "currentBudget" does not exist.', 29, $this->source); })()), "plafond", [], "any", false, false, false, 29)) * 100)) : (0));
            // line 30
            yield "            
            <div class=\"space-y-2\">
                <div class=\"flex justify-between text-sm\">
                    <span>Dépenses: ";
            // line 33
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["totalDepensesMonth"]) || array_key_exists("totalDepensesMonth", $context) ? $context["totalDepensesMonth"] : (function () { throw new RuntimeError('Variable "totalDepensesMonth" does not exist.', 33, $this->source); })()), 2, ",", " "), "html", null, true);
            yield " €</span>
                    <span>Plafond: ";
            // line 34
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, (isset($context["currentBudget"]) || array_key_exists("currentBudget", $context) ? $context["currentBudget"] : (function () { throw new RuntimeError('Variable "currentBudget" does not exist.', 34, $this->source); })()), "plafond", [], "any", false, false, false, 34), 2, ",", " "), "html", null, true);
            yield " €</span>
                </div>
                <div class=\"h-2 w-full rounded-full bg-secondary\">
                    <div class=\"h-full rounded-full transition-all duration-500 ";
            // line 37
            yield ((((isset($context["percentage"]) || array_key_exists("percentage", $context) ? $context["percentage"] : (function () { throw new RuntimeError('Variable "percentage" does not exist.', 37, $this->source); })()) > 100)) ? ("bg-destructive") : (((((isset($context["percentage"]) || array_key_exists("percentage", $context) ? $context["percentage"] : (function () { throw new RuntimeError('Variable "percentage" does not exist.', 37, $this->source); })()) > 80)) ? ("bg-[hsl(var(--warning))]") : ("bg-primary"))));
            yield "\" style=\"width: ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(min((isset($context["percentage"]) || array_key_exists("percentage", $context) ? $context["percentage"] : (function () { throw new RuntimeError('Variable "percentage" does not exist.', 37, $this->source); })()), 100), "html", null, true);
            yield "%\"></div>
                </div>
                <p class=\"text-xs text-right text-muted-foreground\">Reste: ";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((CoreExtension::getAttribute($this->env, $this->source, (isset($context["currentBudget"]) || array_key_exists("currentBudget", $context) ? $context["currentBudget"] : (function () { throw new RuntimeError('Variable "currentBudget" does not exist.', 39, $this->source); })()), "plafond", [], "any", false, false, false, 39) - (isset($context["totalDepensesMonth"]) || array_key_exists("totalDepensesMonth", $context) ? $context["totalDepensesMonth"] : (function () { throw new RuntimeError('Variable "totalDepensesMonth" does not exist.', 39, $this->source); })())), 2, ",", " "), "html", null, true);
            yield " €</p>
            </div>
        </div>
    ";
        } else {
            // line 43
            yield "        <div class=\"mb-8 p-6 rounded-xl border border-dashed border-border text-center text-muted-foreground\">
            Pas de budget défini pour ce mois. <a href=\"";
            // line 44
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_budget_new");
            yield "\" class=\"text-primary hover:underline\">Créer un budget</a>
        </div>
    ";
        }
        // line 47
        yield "
    ";
        // line 49
        yield "    <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow\">
        <div class=\"p-6 border-b border-border\">
            <h3 class=\"font-semibold\">Historique des dépenses</h3>
        </div>
        <div class=\"relative w-full overflow-auto\">
            <table class=\"w-full caption-bottom text-sm\">
                <thead class=\"[&_tr]:border-b\">
                    <tr class=\"border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted\">
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Date</th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Titre</th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Catégorie</th>
                        <th class=\"h-12 px-4 text-right align-middle font-medium text-muted-foreground\">Montant</th>
                    </tr>
                </thead>
                <tbody class=\"[&_tr:last-child]:border-0\">
                ";
        // line 64
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["depenses"]) || array_key_exists("depenses", $context) ? $context["depenses"] : (function () { throw new RuntimeError('Variable "depenses" does not exist.', 64, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["depense"]) {
            // line 65
            yield "                    <tr class=\"border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted\">
                        <td class=\"p-4 align-middle\">";
            // line 66
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["depense"], "date", [], "any", false, false, false, 66), "d/m/Y"), "html", null, true);
            yield "</td>
                        <td class=\"p-4 align-middle font-medium\">";
            // line 67
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["depense"], "titre", [], "any", false, false, false, 67), "html", null, true);
            yield "</td>
                        <td class=\"p-4 align-middle\">
                            <span class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold border-transparent bg-secondary text-secondary-foreground\">
                                ";
            // line 70
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["depense"], "categorie", [], "any", false, false, false, 70)), "html", null, true);
            yield "
                            </span>
                        </td>
                        <td class=\"p-4 align-middle text-right text-destructive font-medium\">
                            -";
            // line 74
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, $context["depense"], "montant", [], "any", false, false, false, 74), 2, ",", " "), "html", null, true);
            yield " €
                        </td>
                    </tr>
                ";
            $context['_iterated'] = true;
        }
        // line 77
        if (!$context['_iterated']) {
            // line 78
            yield "                    <tr>
                        <td colspan=\"4\" class=\"p-4 text-center text-muted-foreground\">Aucune dépense enregistrée.</td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['depense'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 82
        yield "                </tbody>
            </table>
        </div>
    </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "other/finance/index.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  244 => 82,  235 => 78,  233 => 77,  225 => 74,  218 => 70,  212 => 67,  208 => 66,  205 => 65,  200 => 64,  183 => 49,  180 => 47,  174 => 44,  171 => 43,  164 => 39,  157 => 37,  151 => 34,  147 => 33,  142 => 30,  140 => 29,  134 => 26,  130 => 25,  126 => 23,  123 => 22,  114 => 15,  108 => 12,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Finances - LifeOps{% endblock %}

{% block body %}
    <div class=\"flex items-center justify-between mb-8\">
        <div>
            <h1 class=\"text-3xl font-bold tracking-tight text-foreground\">Gestion Financière</h1>
            <p class=\"text-muted-foreground\">Suivez vos budgets et dépenses</p>
        </div>
        <div class=\"flex gap-2\">
            <a href=\"{{ path('app_budget_new') }}\" class=\"inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2\">
                Nouveau Budget
            </a>
            <a href=\"{{ path('app_depense_new') }}\" class=\"inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2\">
                Ajouter Dépense
            </a>
        </div>
    </div>

    {# Budget Summary Card #}
    {% if currentBudget %}
        <div class=\"mb-8 rounded-xl border border-border bg-card text-card-foreground shadow p-6\">
            <div class=\"flex items-center justify-between mb-4\">
                <h2 class=\"text-lg font-semibold\">Budget du Mois ({{ currentBudget.mois }})</h2>
                <span class=\"text-sm text-muted-foreground\">Revenu: {{ currentBudget.revenuMensuel|number_format(2, ',', ' ') }} €</span>
            </div>
            
            {% set percentage = currentBudget.plafond > 0 ? (totalDepensesMonth / currentBudget.plafond) * 100 : 0 %}
            
            <div class=\"space-y-2\">
                <div class=\"flex justify-between text-sm\">
                    <span>Dépenses: {{ totalDepensesMonth|number_format(2, ',', ' ') }} €</span>
                    <span>Plafond: {{ currentBudget.plafond|number_format(2, ',', ' ') }} €</span>
                </div>
                <div class=\"h-2 w-full rounded-full bg-secondary\">
                    <div class=\"h-full rounded-full transition-all duration-500 {{ percentage > 100 ? 'bg-destructive' : (percentage > 80 ? 'bg-[hsl(var(--warning))]' : 'bg-primary') }}\" style=\"width: {{ min(percentage, 100) }}%\"></div>
                </div>
                <p class=\"text-xs text-right text-muted-foreground\">Reste: {{ (currentBudget.plafond - totalDepensesMonth)|number_format(2, ',', ' ') }} €</p>
            </div>
        </div>
    {% else %}
        <div class=\"mb-8 p-6 rounded-xl border border-dashed border-border text-center text-muted-foreground\">
            Pas de budget défini pour ce mois. <a href=\"{{ path('app_budget_new') }}\" class=\"text-primary hover:underline\">Créer un budget</a>
        </div>
    {% endif %}

    {# Expenses List #}
    <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow\">
        <div class=\"p-6 border-b border-border\">
            <h3 class=\"font-semibold\">Historique des dépenses</h3>
        </div>
        <div class=\"relative w-full overflow-auto\">
            <table class=\"w-full caption-bottom text-sm\">
                <thead class=\"[&_tr]:border-b\">
                    <tr class=\"border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted\">
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Date</th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Titre</th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Catégorie</th>
                        <th class=\"h-12 px-4 text-right align-middle font-medium text-muted-foreground\">Montant</th>
                    </tr>
                </thead>
                <tbody class=\"[&_tr:last-child]:border-0\">
                {% for depense in depenses %}
                    <tr class=\"border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted\">
                        <td class=\"p-4 align-middle\">{{ depense.date|date('d/m/Y') }}</td>
                        <td class=\"p-4 align-middle font-medium\">{{ depense.titre }}</td>
                        <td class=\"p-4 align-middle\">
                            <span class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold border-transparent bg-secondary text-secondary-foreground\">
                                {{ depense.categorie|capitalize }}
                            </span>
                        </td>
                        <td class=\"p-4 align-middle text-right text-destructive font-medium\">
                            -{{ depense.montant|number_format(2, ',', ' ') }} €
                        </td>
                    </tr>
                {% else %}
                    <tr>
                        <td colspan=\"4\" class=\"p-4 text-center text-muted-foreground\">Aucune dépense enregistrée.</td>
                    </tr>
                {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
{% endblock %}
", "other/finance/index.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\other\\finance\\index.html.twig");
    }
}
