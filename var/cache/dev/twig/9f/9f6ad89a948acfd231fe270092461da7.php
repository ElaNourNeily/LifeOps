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

/* other/dashboard/index.html.twig */
class __TwigTemplate_d30682796c3cd57d7a57bdb33965297d extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/dashboard/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/dashboard/index.html.twig"));

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

        yield "Tableau de bord - ";
        
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
        yield "    <div class=\"mb-8\">
        <h1 class=\"text-3xl font-bold tracking-tight text-foreground text-balance\">
            Tableau de bord
        </h1>
        <p class=\"mt-1 text-muted-foreground\">
            Vue d'ensemble de votre vie personnelle
        </p>
    </div>

    ";
        // line 16
        yield "    <div class=\"grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4\">

        ";
        // line 19
        yield "        <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow-sm p-6\">
            <div class=\"flex items-center gap-4\">
                <div class=\"p-2 rounded-lg bg-[hsl(var(--chart-2))]/10\">
                    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-6 w-6 text-[hsl(var(--chart-2))]\"><polyline points=\"9 11 12 14 22 4\"/><path d=\"M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11\"/></svg>
                </div>
                <div>
                    <p class=\"text-sm font-medium text-muted-foreground\">Tâches en cours</p>
                    <div class=\"flex items-baseline gap-2\">
                        <h3 class=\"text-2xl font-bold\">";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 27, $this->source); })()), "inProgressTasks", [], "any", false, false, false, 27) + CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 27, $this->source); })()), "todoTasks", [], "any", false, false, false, 27)), "html", null, true);
        yield "</h3>
                    </div>
                    <p class=\"text-xs text-muted-foreground\">";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 29, $this->source); })()), "doneTasks", [], "any", false, false, false, 29), "html", null, true);
        yield " terminées</p>
                </div>
            </div>
        </div>

        ";
        // line 35
        yield "        <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow-sm p-6\">
            <div class=\"flex items-center gap-4\">
                <div class=\"p-2 rounded-lg bg-[hsl(var(--success))]/10\">
                    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-6 w-6 text-[hsl(var(--success))]\"><path d=\"M20 12V8H6a2 2 0 0 1-2-2c0-1.1.9-2 2-2h12v4\"/><path d=\"M4 6v12c0 1.1.9 2 2 2h14v-4\"/><path d=\"M18 12a2 2 0 0 0-2 2c0 1.1.9 2 2 2h4v-4h-4z\"/></svg>
                </div>
                <div>
                    <p class=\"text-sm font-medium text-muted-foreground\">Balance (Mois)</p>
                    <div class=\"flex items-baseline gap-2\">
                        <h3 class=\"text-2xl font-bold\">";
        // line 43
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 43, $this->source); })()), "balance", [], "any", false, false, false, 43), 2, ",", " "), "html", null, true);
        yield " €</h3>
                    </div>
                    <p class=\"text-xs text-muted-foreground\">
                        <span class=\"text-muted-foreground\">Budget: ";
        // line 46
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 46, $this->source); })()), "budget", [], "any", false, false, false, 46), 0), "html", null, true);
        yield " €</span>
                        <span class=\"mx-1\">•</span>
                        <span class=\"text-destructive\">";
        // line 48
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 48, $this->source); })()), "totalDepenses", [], "any", false, false, false, 48), 0), "html", null, true);
        yield " € dép.</span>
                    </p>
                </div>
            </div>
        </div>

        ";
        // line 55
        yield "        <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow-sm p-6\">
             <div class=\"flex items-center gap-4\">
                <div class=\"p-2 rounded-lg bg-[hsl(var(--chart-5))]/10\">
                    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-6 w-6 text-[hsl(var(--chart-5))]\"><path d=\"M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z\"/></svg>
                </div>
                <div>
                    <p class=\"text-sm font-medium text-muted-foreground\">Forme (Bilan)</p>
                    <div class=\"flex items-baseline gap-2\">
                        <h3 class=\"text-2xl font-bold\">
                            ";
        // line 64
        if ((($tmp = (isset($context["latestBilan"]) || array_key_exists("latestBilan", $context) ? $context["latestBilan"] : (function () { throw new RuntimeError('Variable "latestBilan" does not exist.', 64, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 65
            yield "                                ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["latestBilan"]) || array_key_exists("latestBilan", $context) ? $context["latestBilan"] : (function () { throw new RuntimeError('Variable "latestBilan" does not exist.', 65, $this->source); })()), "scoreForme", [], "any", false, false, false, 65), "html", null, true);
            yield "/10
                            ";
        } else {
            // line 67
            yield "                                -/10
                            ";
        }
        // line 69
        yield "                        </h3>
                    </div>
                    <p class=\"text-xs text-muted-foreground\">
                        ";
        // line 72
        if ((($tmp = (isset($context["latestBilan"]) || array_key_exists("latestBilan", $context) ? $context["latestBilan"] : (function () { throw new RuntimeError('Variable "latestBilan" does not exist.', 72, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 73
            yield "                            Stress: ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["latestBilan"]) || array_key_exists("latestBilan", $context) ? $context["latestBilan"] : (function () { throw new RuntimeError('Variable "latestBilan" does not exist.', 73, $this->source); })()), "niveauStress", [], "any", false, false, false, 73), "html", null, true);
            yield "/10
                        ";
        } else {
            // line 75
            yield "                            Aucun bilan
                        ";
        }
        // line 77
        yield "                    </p>
                </div>
            </div>
        </div>

        ";
        // line 83
        yield "        <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow-sm p-6\">
             <div class=\"flex items-center gap-4\">
                <div class=\"p-2 rounded-lg bg-[hsl(var(--warning))]/10\">
                    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-6 w-6 text-[hsl(var(--warning))]\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><circle cx=\"12\" cy=\"12\" r=\"6\"/><circle cx=\"12\" cy=\"12\" r=\"2\"/></svg>
                </div>
                <div>
                    <p class=\"text-sm font-medium text-muted-foreground\">Objectifs actifs</p>
                    <div class=\"flex items-baseline gap-2\">
                        <h3 class=\"text-2xl font-bold\">";
        // line 91
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 91, $this->source); })()), "activeObjectifs", [], "any", false, false, false, 91), "html", null, true);
        yield "</h3>
                    </div>
                    <p class=\"text-xs text-muted-foreground\">en cours</p>
                </div>
            </div>
        </div>
    </div>

    ";
        // line 100
        yield "    <div class=\"mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2\">
        ";
        // line 102
        yield "        <div class=\"rounded-xl border border-border bg-card p-5\">
            <div class=\"mb-4 flex items-center justify-between\">
                <h2 class=\"text-lg font-semibold text-card-foreground\">Tâches récentes</h2>
                <a href=\"#\" class=\"flex items-center gap-1 text-sm text-primary hover:underline\">
                    Voir tout <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-3.5 w-3.5\"><path d=\"M5 12h14\"/><path d=\"m12 5 7 7-7 7\"/></svg>
                </a>
            </div>
            <div class=\"flex flex-col gap-3\">
                ";
        // line 110
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["recentTaches"]) || array_key_exists("recentTaches", $context) ? $context["recentTaches"] : (function () { throw new RuntimeError('Variable "recentTaches" does not exist.', 110, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["tache"]) {
            // line 111
            yield "                    <div class=\"flex items-center justify-between rounded-lg bg-secondary/50 px-4 py-3\">
                        <div class=\"flex items-center gap-3\">
                            <div class=\"h-2 w-2 rounded-full
                                ";
            // line 114
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["tache"], "statut", [], "any", false, false, false, 114) == "done")) {
                yield "bg-[hsl(var(--success))]
                                ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 115
$context["tache"], "statut", [], "any", false, false, false, 115) == "in-progress")) {
                yield "bg-[hsl(var(--warning))]
                                ";
            } else {
                // line 116
                yield "bg-muted-foreground";
            }
            yield "\">
                            </div>
                            <span class=\"text-sm font-medium text-card-foreground\">";
            // line 118
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tache"], "titre", [], "any", false, false, false, 118), "html", null, true);
            yield "</span>
                        </div>
                        <span class=\"rounded-full px-2.5 py-0.5 text-xs font-medium
                            ";
            // line 121
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["tache"], "priorite", [], "any", false, false, false, 121) == "high")) {
                yield "bg-destructive/10 text-destructive
                            ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 122
$context["tache"], "priorite", [], "any", false, false, false, 122) == "medium")) {
                yield "bg-[hsl(var(--warning))]/10 text-[hsl(var(--warning))]
                            ";
            } else {
                // line 123
                yield "bg-muted text-muted-foreground";
            }
            yield "\">
                            ";
            // line 124
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["tache"], "priorite", [], "any", false, false, false, 124)), "html", null, true);
            yield "
                        </span>
                    </div>
                ";
            $context['_iterated'] = true;
        }
        // line 127
        if (!$context['_iterated']) {
            // line 128
            yield "                    <p class=\"py-8 text-center text-sm text-muted-foreground\">Aucune tâche.</p>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['tache'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 130
        yield "            </div>
        </div>

        ";
        // line 134
        yield "        <div class=\"rounded-xl border border-border bg-card p-5\">
            <div class=\"mb-4 flex items-center justify-between\">
                <h2 class=\"text-lg font-semibold text-card-foreground\">Planning du jour</h2>
                <a href=\"#\" class=\"flex items-center gap-1 text-sm text-primary hover:underline\">
                    Voir tout <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-3.5 w-3.5\"><path d=\"M5 12h14\"/><path d=\"m12 5 7 7-7 7\"/></svg>
                </a>
            </div>
            <div class=\"flex flex-col gap-3\">
                ";
        // line 142
        if ((($tmp = (isset($context["planning"]) || array_key_exists("planning", $context) ? $context["planning"] : (function () { throw new RuntimeError('Variable "planning" does not exist.', 142, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 143
            yield "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["planning"]) || array_key_exists("planning", $context) ? $context["planning"] : (function () { throw new RuntimeError('Variable "planning" does not exist.', 143, $this->source); })()), "activites", [], "any", false, false, false, 143));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["activite"]) {
                // line 144
                yield "                        <div class=\"flex items-center gap-3 rounded-lg bg-secondary/50 px-4 py-3\">
                            <div class=\"h-8 w-1 rounded-full bg-primary\"></div>
                             <div class=\"flex-1\">
                                <p class=\"text-sm font-medium text-card-foreground\">";
                // line 147
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["activite"], "titre", [], "any", false, false, false, 147), "html", null, true);
                yield "</p>
                                <p class=\"text-xs text-muted-foreground\">
                                    ";
                // line 149
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["activite"], "heureDebutEstimee", [], "any", false, false, false, 149), "H:i"), "html", null, true);
                yield " - ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["activite"], "heureFinEstimee", [], "any", false, false, false, 149), "H:i"), "html", null, true);
                yield "
                                </p>
                            </div>
                        </div>
                    ";
                $context['_iterated'] = true;
            }
            // line 153
            if (!$context['_iterated']) {
                // line 154
                yield "                         <p class=\"py-8 text-center text-sm text-muted-foreground\">Aucune activité prévue.</p>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['activite'], $context['_parent'], $context['_iterated']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 156
            yield "                ";
        } else {
            // line 157
            yield "                    <p class=\"py-8 text-center text-sm text-muted-foreground\">Pas de planning pour aujourd'hui.</p>
                ";
        }
        // line 159
        yield "            </div>
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
        return "other/dashboard/index.html.twig";
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
        return array (  371 => 159,  367 => 157,  364 => 156,  357 => 154,  355 => 153,  344 => 149,  339 => 147,  334 => 144,  328 => 143,  326 => 142,  316 => 134,  311 => 130,  304 => 128,  302 => 127,  294 => 124,  289 => 123,  284 => 122,  280 => 121,  274 => 118,  268 => 116,  263 => 115,  259 => 114,  254 => 111,  249 => 110,  239 => 102,  236 => 100,  225 => 91,  215 => 83,  208 => 77,  204 => 75,  198 => 73,  196 => 72,  191 => 69,  187 => 67,  181 => 65,  179 => 64,  168 => 55,  159 => 48,  154 => 46,  148 => 43,  138 => 35,  130 => 29,  125 => 27,  115 => 19,  111 => 16,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Tableau de bord - {% endblock %}

{% block body %}
    <div class=\"mb-8\">
        <h1 class=\"text-3xl font-bold tracking-tight text-foreground text-balance\">
            Tableau de bord
        </h1>
        <p class=\"mt-1 text-muted-foreground\">
            Vue d'ensemble de votre vie personnelle
        </p>
    </div>

    {# Stats Grid #}
    <div class=\"grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4\">

        {# Tasks #}
        <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow-sm p-6\">
            <div class=\"flex items-center gap-4\">
                <div class=\"p-2 rounded-lg bg-[hsl(var(--chart-2))]/10\">
                    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-6 w-6 text-[hsl(var(--chart-2))]\"><polyline points=\"9 11 12 14 22 4\"/><path d=\"M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11\"/></svg>
                </div>
                <div>
                    <p class=\"text-sm font-medium text-muted-foreground\">Tâches en cours</p>
                    <div class=\"flex items-baseline gap-2\">
                        <h3 class=\"text-2xl font-bold\">{{ stats.inProgressTasks + stats.todoTasks }}</h3>
                    </div>
                    <p class=\"text-xs text-muted-foreground\">{{ stats.doneTasks }} terminées</p>
                </div>
            </div>
        </div>

        {# Balance #}
        <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow-sm p-6\">
            <div class=\"flex items-center gap-4\">
                <div class=\"p-2 rounded-lg bg-[hsl(var(--success))]/10\">
                    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-6 w-6 text-[hsl(var(--success))]\"><path d=\"M20 12V8H6a2 2 0 0 1-2-2c0-1.1.9-2 2-2h12v4\"/><path d=\"M4 6v12c0 1.1.9 2 2 2h14v-4\"/><path d=\"M18 12a2 2 0 0 0-2 2c0 1.1.9 2 2 2h4v-4h-4z\"/></svg>
                </div>
                <div>
                    <p class=\"text-sm font-medium text-muted-foreground\">Balance (Mois)</p>
                    <div class=\"flex items-baseline gap-2\">
                        <h3 class=\"text-2xl font-bold\">{{ stats.balance|number_format(2, ',', ' ') }} €</h3>
                    </div>
                    <p class=\"text-xs text-muted-foreground\">
                        <span class=\"text-muted-foreground\">Budget: {{ stats.budget|number_format(0) }} €</span>
                        <span class=\"mx-1\">•</span>
                        <span class=\"text-destructive\">{{ stats.totalDepenses|number_format(0) }} € dép.</span>
                    </p>
                </div>
            </div>
        </div>

        {# Health #}
        <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow-sm p-6\">
             <div class=\"flex items-center gap-4\">
                <div class=\"p-2 rounded-lg bg-[hsl(var(--chart-5))]/10\">
                    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-6 w-6 text-[hsl(var(--chart-5))]\"><path d=\"M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z\"/></svg>
                </div>
                <div>
                    <p class=\"text-sm font-medium text-muted-foreground\">Forme (Bilan)</p>
                    <div class=\"flex items-baseline gap-2\">
                        <h3 class=\"text-2xl font-bold\">
                            {% if latestBilan %}
                                {{ latestBilan.scoreForme }}/10
                            {% else %}
                                -/10
                            {% endif %}
                        </h3>
                    </div>
                    <p class=\"text-xs text-muted-foreground\">
                        {% if latestBilan %}
                            Stress: {{ latestBilan.niveauStress }}/10
                        {% else %}
                            Aucun bilan
                        {% endif %}
                    </p>
                </div>
            </div>
        </div>

        {# Goals #}
        <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow-sm p-6\">
             <div class=\"flex items-center gap-4\">
                <div class=\"p-2 rounded-lg bg-[hsl(var(--warning))]/10\">
                    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-6 w-6 text-[hsl(var(--warning))]\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><circle cx=\"12\" cy=\"12\" r=\"6\"/><circle cx=\"12\" cy=\"12\" r=\"2\"/></svg>
                </div>
                <div>
                    <p class=\"text-sm font-medium text-muted-foreground\">Objectifs actifs</p>
                    <div class=\"flex items-baseline gap-2\">
                        <h3 class=\"text-2xl font-bold\">{{ stats.activeObjectifs }}</h3>
                    </div>
                    <p class=\"text-xs text-muted-foreground\">en cours</p>
                </div>
            </div>
        </div>
    </div>

    {# Sections #}
    <div class=\"mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2\">
        {# Recent Tasks #}
        <div class=\"rounded-xl border border-border bg-card p-5\">
            <div class=\"mb-4 flex items-center justify-between\">
                <h2 class=\"text-lg font-semibold text-card-foreground\">Tâches récentes</h2>
                <a href=\"#\" class=\"flex items-center gap-1 text-sm text-primary hover:underline\">
                    Voir tout <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-3.5 w-3.5\"><path d=\"M5 12h14\"/><path d=\"m12 5 7 7-7 7\"/></svg>
                </a>
            </div>
            <div class=\"flex flex-col gap-3\">
                {% for tache in recentTaches %}
                    <div class=\"flex items-center justify-between rounded-lg bg-secondary/50 px-4 py-3\">
                        <div class=\"flex items-center gap-3\">
                            <div class=\"h-2 w-2 rounded-full
                                {% if tache.statut == 'done' %}bg-[hsl(var(--success))]
                                {% elseif tache.statut == 'in-progress' %}bg-[hsl(var(--warning))]
                                {% else %}bg-muted-foreground{% endif %}\">
                            </div>
                            <span class=\"text-sm font-medium text-card-foreground\">{{ tache.titre }}</span>
                        </div>
                        <span class=\"rounded-full px-2.5 py-0.5 text-xs font-medium
                            {% if tache.priorite == 'high' %}bg-destructive/10 text-destructive
                            {% elseif tache.priorite == 'medium' %}bg-[hsl(var(--warning))]/10 text-[hsl(var(--warning))]
                            {% else %}bg-muted text-muted-foreground{% endif %}\">
                            {{ tache.priorite|capitalize }}
                        </span>
                    </div>
                {% else %}
                    <p class=\"py-8 text-center text-sm text-muted-foreground\">Aucune tâche.</p>
                {% endfor %}
            </div>
        </div>

        {# Today's Schedule #}
        <div class=\"rounded-xl border border-border bg-card p-5\">
            <div class=\"mb-4 flex items-center justify-between\">
                <h2 class=\"text-lg font-semibold text-card-foreground\">Planning du jour</h2>
                <a href=\"#\" class=\"flex items-center gap-1 text-sm text-primary hover:underline\">
                    Voir tout <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-3.5 w-3.5\"><path d=\"M5 12h14\"/><path d=\"m12 5 7 7-7 7\"/></svg>
                </a>
            </div>
            <div class=\"flex flex-col gap-3\">
                {% if planning %}
                    {% for activite in planning.activites %}
                        <div class=\"flex items-center gap-3 rounded-lg bg-secondary/50 px-4 py-3\">
                            <div class=\"h-8 w-1 rounded-full bg-primary\"></div>
                             <div class=\"flex-1\">
                                <p class=\"text-sm font-medium text-card-foreground\">{{ activite.titre }}</p>
                                <p class=\"text-xs text-muted-foreground\">
                                    {{ activite.heureDebutEstimee|date('H:i') }} - {{ activite.heureFinEstimee|date('H:i') }}
                                </p>
                            </div>
                        </div>
                    {% else %}
                         <p class=\"py-8 text-center text-sm text-muted-foreground\">Aucune activité prévue.</p>
                    {% endfor %}
                {% else %}
                    <p class=\"py-8 text-center text-sm text-muted-foreground\">Pas de planning pour aujourd'hui.</p>
                {% endif %}
            </div>
        </div>

    </div>
{% endblock %}
", "other/dashboard/index.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\other\\dashboard\\index.html.twig");
    }
}
