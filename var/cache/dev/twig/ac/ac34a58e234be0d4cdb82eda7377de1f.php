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

/* other/health/index.html.twig */
class __TwigTemplate_56ee57d119ee9fd9229eba9179a142d6 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/health/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/health/index.html.twig"));

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

        yield "Santé - LifeOps";
        
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
            <h1 class=\"text-3xl font-bold tracking-tight text-foreground\">Gestion Santé</h1>
            <p class=\"text-muted-foreground\">Suivez votre forme et bien-être</p>
        </div>
        <div class=\"flex gap-2\">
            <a href=\"";
        // line 12
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_bilan_new");
        yield "\" class=\"inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2\">
                Nouveau Bilan
            </a>
            <a href=\"";
        // line 15
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_suivi_new");
        yield "\" class=\"inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2\">
                Ajouter Suivi Quotidien
            </a>
        </div>
    </div>

    <div class=\"grid grid-cols-1 md:grid-cols-3 gap-6 mb-8\">
        ";
        // line 23
        yield "        <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow p-6\">
            <h3 class=\"text-sm font-medium text-muted-foreground\">Moyenne Sommeil (7j)</h3>
            <div class=\"flex items-baseline gap-2 mt-2\">
                <span class=\"text-3xl font-bold\">";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["avgSleep"]) || array_key_exists("avgSleep", $context) ? $context["avgSleep"] : (function () { throw new RuntimeError('Variable "avgSleep" does not exist.', 26, $this->source); })()), 1, ",", " "), "html", null, true);
        yield "</span>
                <span class=\"text-sm text-muted-foreground\">h / nuit</span>
            </div>
        </div>

        ";
        // line 32
        yield "         <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow p-6\">
            <h3 class=\"text-sm font-medium text-muted-foreground\">Moyenne Eau (7j)</h3>
             <div class=\"flex items-baseline gap-2 mt-2\">
                <span class=\"text-3xl font-bold\">";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["avgWater"]) || array_key_exists("avgWater", $context) ? $context["avgWater"] : (function () { throw new RuntimeError('Variable "avgWater" does not exist.', 35, $this->source); })()), 1, ",", " "), "html", null, true);
        yield "</span>
                <span class=\"text-sm text-muted-foreground\">verres / jour</span>
            </div>
        </div>

        ";
        // line 41
        yield "         <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow p-6\">
            <h3 class=\"text-sm font-medium text-muted-foreground\">Dernier Score Forme</h3>
             <div class=\"flex items-baseline gap-2 mt-2\">
                <span class=\"text-3xl font-bold\">
                    ";
        // line 45
        if ((($tmp = (isset($context["latestBilan"]) || array_key_exists("latestBilan", $context) ? $context["latestBilan"] : (function () { throw new RuntimeError('Variable "latestBilan" does not exist.', 45, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 46
            yield "                        ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["latestBilan"]) || array_key_exists("latestBilan", $context) ? $context["latestBilan"] : (function () { throw new RuntimeError('Variable "latestBilan" does not exist.', 46, $this->source); })()), "scoreForme", [], "any", false, false, false, 46), "html", null, true);
            yield "/10
                    ";
        } else {
            // line 48
            yield "                        -
                    ";
        }
        // line 50
        yield "                </span>
            </div>
             ";
        // line 52
        if ((($tmp = (isset($context["latestBilan"]) || array_key_exists("latestBilan", $context) ? $context["latestBilan"] : (function () { throw new RuntimeError('Variable "latestBilan" does not exist.', 52, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 53
            yield "                <p class=\"text-xs text-muted-foreground mt-1\">du ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["latestBilan"]) || array_key_exists("latestBilan", $context) ? $context["latestBilan"] : (function () { throw new RuntimeError('Variable "latestBilan" does not exist.', 53, $this->source); })()), "dateDebut", [], "any", false, false, false, 53), "d/m"), "html", null, true);
            yield " au ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["latestBilan"]) || array_key_exists("latestBilan", $context) ? $context["latestBilan"] : (function () { throw new RuntimeError('Variable "latestBilan" does not exist.', 53, $this->source); })()), "dateFin", [], "any", false, false, false, 53), "d/m"), "html", null, true);
            yield "</p>
            ";
        }
        // line 55
        yield "        </div>
    </div>

    <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow\">
        <div class=\"p-6 border-b border-border\">
            <h3 class=\"font-semibold\">Historique Quotidien</h3>
        </div>
        <div class=\"relative w-full overflow-auto\">
            <table class=\"w-full caption-bottom text-sm\">
                <thead class=\"[&_tr]:border-b\">
                     <tr class=\"border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted\">
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Date</th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Sommeil</th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Eau</th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Humeur</th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Activité</th>
                    </tr>
                </thead>
                 <tbody class=\"[&_tr:last-child]:border-0\">
                ";
        // line 74
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["suivis"]) || array_key_exists("suivis", $context) ? $context["suivis"] : (function () { throw new RuntimeError('Variable "suivis" does not exist.', 74, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["suivi"]) {
            // line 75
            yield "                    <tr class=\"border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted\">
                        <td class=\"p-4 align-middle font-medium\">";
            // line 76
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["suivi"], "date", [], "any", false, false, false, 76), "d/m/Y"), "html", null, true);
            yield "</td>
                        <td class=\"p-4 align-middle\">";
            // line 77
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["suivi"], "heuresSommeil", [], "any", false, false, false, 77), "html", null, true);
            yield "h (";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["suivi"], "qualiteSommeil", [], "any", false, false, false, 77), "html", null, true);
            yield "/10)</td>
                        <td class=\"p-4 align-middle\">";
            // line 78
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["suivi"], "verresEau", [], "any", false, false, false, 78), "html", null, true);
            yield " verres</td>
                        <td class=\"p-4 align-middle\">";
            // line 79
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["suivi"], "humeur", [], "any", false, false, false, 79), "html", null, true);
            yield "/10</td>
                        <td class=\"p-4 align-middle\">";
            // line 80
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["suivi"], "minutesActivite", [], "any", false, false, false, 80), "html", null, true);
            yield " min</td>
                    </tr>
                ";
            $context['_iterated'] = true;
        }
        // line 82
        if (!$context['_iterated']) {
            // line 83
            yield "                    <tr>
                         <td colspan=\"5\" class=\"p-4 text-center text-muted-foreground\">Aucun suivi enregistré.</td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['suivi'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 87
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
        return "other/health/index.html.twig";
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
        return array (  247 => 87,  238 => 83,  236 => 82,  229 => 80,  225 => 79,  221 => 78,  215 => 77,  211 => 76,  208 => 75,  203 => 74,  182 => 55,  174 => 53,  172 => 52,  168 => 50,  164 => 48,  158 => 46,  156 => 45,  150 => 41,  142 => 35,  137 => 32,  129 => 26,  124 => 23,  114 => 15,  108 => 12,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Santé - LifeOps{% endblock %}

{% block body %}
    <div class=\"flex items-center justify-between mb-8\">
        <div>
            <h1 class=\"text-3xl font-bold tracking-tight text-foreground\">Gestion Santé</h1>
            <p class=\"text-muted-foreground\">Suivez votre forme et bien-être</p>
        </div>
        <div class=\"flex gap-2\">
            <a href=\"{{ path('app_bilan_new') }}\" class=\"inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2\">
                Nouveau Bilan
            </a>
            <a href=\"{{ path('app_suivi_new') }}\" class=\"inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2\">
                Ajouter Suivi Quotidien
            </a>
        </div>
    </div>

    <div class=\"grid grid-cols-1 md:grid-cols-3 gap-6 mb-8\">
        {# Average Sleep #}
        <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow p-6\">
            <h3 class=\"text-sm font-medium text-muted-foreground\">Moyenne Sommeil (7j)</h3>
            <div class=\"flex items-baseline gap-2 mt-2\">
                <span class=\"text-3xl font-bold\">{{ avgSleep|number_format(1, ',', ' ') }}</span>
                <span class=\"text-sm text-muted-foreground\">h / nuit</span>
            </div>
        </div>

        {# Average Water #}
         <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow p-6\">
            <h3 class=\"text-sm font-medium text-muted-foreground\">Moyenne Eau (7j)</h3>
             <div class=\"flex items-baseline gap-2 mt-2\">
                <span class=\"text-3xl font-bold\">{{ avgWater|number_format(1, ',', ' ') }}</span>
                <span class=\"text-sm text-muted-foreground\">verres / jour</span>
            </div>
        </div>

        {# Last Bilan Score #}
         <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow p-6\">
            <h3 class=\"text-sm font-medium text-muted-foreground\">Dernier Score Forme</h3>
             <div class=\"flex items-baseline gap-2 mt-2\">
                <span class=\"text-3xl font-bold\">
                    {% if latestBilan %}
                        {{ latestBilan.scoreForme }}/10
                    {% else %}
                        -
                    {% endif %}
                </span>
            </div>
             {% if latestBilan %}
                <p class=\"text-xs text-muted-foreground mt-1\">du {{ latestBilan.dateDebut|date('d/m') }} au {{ latestBilan.dateFin|date('d/m') }}</p>
            {% endif %}
        </div>
    </div>

    <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow\">
        <div class=\"p-6 border-b border-border\">
            <h3 class=\"font-semibold\">Historique Quotidien</h3>
        </div>
        <div class=\"relative w-full overflow-auto\">
            <table class=\"w-full caption-bottom text-sm\">
                <thead class=\"[&_tr]:border-b\">
                     <tr class=\"border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted\">
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Date</th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Sommeil</th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Eau</th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Humeur</th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Activité</th>
                    </tr>
                </thead>
                 <tbody class=\"[&_tr:last-child]:border-0\">
                {% for suivi in suivis %}
                    <tr class=\"border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted\">
                        <td class=\"p-4 align-middle font-medium\">{{ suivi.date|date('d/m/Y') }}</td>
                        <td class=\"p-4 align-middle\">{{ suivi.heuresSommeil }}h ({{ suivi.qualiteSommeil }}/10)</td>
                        <td class=\"p-4 align-middle\">{{ suivi.verresEau }} verres</td>
                        <td class=\"p-4 align-middle\">{{ suivi.humeur }}/10</td>
                        <td class=\"p-4 align-middle\">{{ suivi.minutesActivite }} min</td>
                    </tr>
                {% else %}
                    <tr>
                         <td colspan=\"5\" class=\"p-4 text-center text-muted-foreground\">Aucun suivi enregistré.</td>
                    </tr>
                {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
{% endblock %}
", "other/health/index.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\other\\health\\index.html.twig");
    }
}
