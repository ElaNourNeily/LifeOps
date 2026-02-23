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

/* other/goal/show.html.twig */
class __TwigTemplate_036c83614fc16686bd100a2fdf60669b extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/goal/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/goal/show.html.twig"));

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

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["objectif"]) || array_key_exists("objectif", $context) ? $context["objectif"] : (function () { throw new RuntimeError('Variable "objectif" does not exist.', 3, $this->source); })()), "titre", [], "any", false, false, false, 3), "html", null, true);
        yield " - LifeOps";
        
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
        yield "    <div class=\"mb-6\">
        <a href=\"";
        // line 7
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_goal_index");
        yield "\" class=\"text-sm text-muted-foreground hover:text-foreground flex items-center\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"mr-1 h-4 w-4\"><path d=\"m15 18-6-6 6-6\"/></svg>
            Retour aux objectifs
        </a>
    </div>

    <div class=\"grid grid-cols-1 lg:grid-cols-3 gap-8\">
        ";
        // line 15
        yield "        <div class=\"lg:col-span-2 space-y-6\">
            <div class=\"flex items-start justify-between\">
                <div>
                     <h1 class=\"text-3xl font-bold tracking-tight text-foreground mb-2\">";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["objectif"]) || array_key_exists("objectif", $context) ? $context["objectif"] : (function () { throw new RuntimeError('Variable "objectif" does not exist.', 18, $this->source); })()), "titre", [], "any", false, false, false, 18), "html", null, true);
        yield "</h1>
                     <div class=\"flex gap-2 mb-4\">
                        <span class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold border-transparent bg-secondary text-secondary-foreground\">
                            ";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["objectif"]) || array_key_exists("objectif", $context) ? $context["objectif"] : (function () { throw new RuntimeError('Variable "objectif" does not exist.', 21, $this->source); })()), "categorie", [], "any", false, false, false, 21)), "html", null, true);
        yield "
                        </span>
                        <span class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold
                            ";
        // line 24
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["objectif"]) || array_key_exists("objectif", $context) ? $context["objectif"] : (function () { throw new RuntimeError('Variable "objectif" does not exist.', 24, $this->source); })()), "statut", [], "any", false, false, false, 24) == "achieved")) {
            yield "border-transparent bg-[hsl(var(--success))]/20 text-[hsl(var(--success))]
                            ";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source,         // line 25
(isset($context["objectif"]) || array_key_exists("objectif", $context) ? $context["objectif"] : (function () { throw new RuntimeError('Variable "objectif" does not exist.', 25, $this->source); })()), "statut", [], "any", false, false, false, 25) == "in-progress")) {
            yield "border-transparent bg-[hsl(var(--warning))]/20 text-[hsl(var(--warning))]
                            ";
        } else {
            // line 26
            yield "border-transparent bg-secondary text-secondary-foreground";
        }
        // line 27
        yield "                        \">
                            ";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["objectif"]) || array_key_exists("objectif", $context) ? $context["objectif"] : (function () { throw new RuntimeError('Variable "objectif" does not exist.', 28, $this->source); })()), "statut", [], "any", false, false, false, 28)), "html", null, true);
        yield "
                        </span>
                     </div>
                     <p class=\"text-muted-foreground\">";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["objectif"]) || array_key_exists("objectif", $context) ? $context["objectif"] : (function () { throw new RuntimeError('Variable "objectif" does not exist.', 31, $this->source); })()), "description", [], "any", false, false, false, 31), "html", null, true);
        yield "</p>
                </div>
                <a href=\"";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_goal_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["objectif"]) || array_key_exists("objectif", $context) ? $context["objectif"] : (function () { throw new RuntimeError('Variable "objectif" does not exist.', 33, $this->source); })()), "id", [], "any", false, false, false, 33)]), "html", null, true);
        yield "\" class=\"inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2\">
                    Modifier
                </a>
            </div>

            <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow p-6\">
                 <div class=\"flex justify-between items-center mb-4\">
                    <h2 class=\"text-lg font-semibold\">Plan d'action</h2>
                    <a href=\"";
        // line 41
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_goal_action_new", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["objectif"]) || array_key_exists("objectif", $context) ? $context["objectif"] : (function () { throw new RuntimeError('Variable "objectif" does not exist.', 41, $this->source); })()), "id", [], "any", false, false, false, 41)]), "html", null, true);
        yield "\" class=\"text-sm font-medium text-primary hover:underline flex items-center\">
                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"mr-1 h-4 w-4\"><line x1=\"12\" y1=\"5\" x2=\"12\" y2=\"19\"/><line x1=\"5\" y1=\"12\" x2=\"19\" y2=\"12\"/></svg>
                        Ajouter Étape
                    </a>
                </div>
                
                ";
        // line 47
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["objectif"]) || array_key_exists("objectif", $context) ? $context["objectif"] : (function () { throw new RuntimeError('Variable "objectif" does not exist.', 47, $this->source); })()), "planActions", [], "any", false, false, false, 47)) > 0)) {
            // line 48
            yield "                    <ul class=\"space-y-3\">
                        ";
            // line 49
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["objectif"]) || array_key_exists("objectif", $context) ? $context["objectif"] : (function () { throw new RuntimeError('Variable "objectif" does not exist.', 49, $this->source); })()), "planActions", [], "any", false, false, false, 49));
            foreach ($context['_seq'] as $context["_key"] => $context["action"]) {
                // line 50
                yield "                            <li class=\"flex items-center justify-between p-3 rounded-lg bg-secondary/30 border border-border/50\">
                                <div class=\"flex items-center gap-3\">
                                    <div class=\"h-2 w-2 rounded-full 
                                        ";
                // line 53
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["action"], "statut", [], "any", false, false, false, 53) == "done")) {
                    yield "bg-[hsl(var(--success))]
                                        ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 54
$context["action"], "statut", [], "any", false, false, false, 54) == "in-progress")) {
                    yield "bg-[hsl(var(--warning))]
                                        ";
                } else {
                    // line 55
                    yield "bg-muted-foreground";
                }
                // line 56
                yield "                                    \"></div>
                                    <span class=\"";
                // line 57
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["action"], "statut", [], "any", false, false, false, 57) == "done")) {
                    yield "line-through text-muted-foreground";
                }
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["action"], "titre", [], "any", false, false, false, 57), "html", null, true);
                yield "</span>
                                </div>
                                    <span class=\"text-xs text-muted-foreground\">
                                    ";
                // line 60
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["action"], "dateFin", [], "any", false, false, false, 60)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 61
                    yield "                                        ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["action"], "dateFin", [], "any", false, false, false, 61), "d/m/Y"), "html", null, true);
                    yield "
                                    ";
                }
                // line 63
                yield "                                </span>
                            </li>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['action'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 66
            yield "                    </ul>
                ";
        } else {
            // line 68
            yield "                    <p class=\"text-center text-muted-foreground py-4 text-sm\">Aucune étape définie pour le moment.</p>
                ";
        }
        // line 70
        yield "            </div>
        </div>

        ";
        // line 74
        yield "        <div class=\"space-y-6\">
            <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow p-6\">
                <h3 class=\"text-sm font-medium text-muted-foreground mb-4\">Progression Globale</h3>
                <div class=\"flex items-end gap-2 mb-2\">
                    <span class=\"text-4xl font-bold\">";
        // line 78
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["objectif"]) || array_key_exists("objectif", $context) ? $context["objectif"] : (function () { throw new RuntimeError('Variable "objectif" does not exist.', 78, $this->source); })()), "progression", [], "any", false, false, false, 78), "html", null, true);
        yield "%</span>
                </div>
                <div class=\"h-2 w-full rounded-full bg-secondary\">
                    <div class=\"h-full rounded-full bg-primary transition-all duration-500\" style=\"width: ";
        // line 81
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["objectif"]) || array_key_exists("objectif", $context) ? $context["objectif"] : (function () { throw new RuntimeError('Variable "objectif" does not exist.', 81, $this->source); })()), "progression", [], "any", false, false, false, 81), "html", null, true);
        yield "%\"></div>
                </div>
            </div>

            <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow p-6\">
                <h3 class=\"text-sm font-medium text-muted-foreground mb-2\">Date Limite</h3>
                ";
        // line 87
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["objectif"]) || array_key_exists("objectif", $context) ? $context["objectif"] : (function () { throw new RuntimeError('Variable "objectif" does not exist.', 87, $this->source); })()), "dateFin", [], "any", false, false, false, 87)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 88
            yield "                    <p class=\"text-lg font-semibold flex items-center\">
                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"mr-2 h-5 w-5 text-muted-foreground\"><rect width=\"18\" height=\"18\" x=\"3\" y=\"4\" rx=\"2\" ry=\"2\"/><line x1=\"16\" y1=\"2\" x2=\"16\" y2=\"6\"/><line x1=\"8\" y1=\"2\" x2=\"8\" y2=\"6\"/><line x1=\"3\" y1=\"10\" x2=\"21\" y2=\"10\"/></svg>
                        ";
            // line 90
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["objectif"]) || array_key_exists("objectif", $context) ? $context["objectif"] : (function () { throw new RuntimeError('Variable "objectif" does not exist.', 90, $this->source); })()), "dateFin", [], "any", false, false, false, 90), "d F Y"), "html", null, true);
            yield "
                    </p>
                    ";
            // line 92
            $context["daysLeft"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $this->extensions['Twig\Extension\CoreExtension']->convertDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["objectif"]) || array_key_exists("objectif", $context) ? $context["objectif"] : (function () { throw new RuntimeError('Variable "objectif" does not exist.', 92, $this->source); })()), "dateFin", [], "any", false, false, false, 92)), "diff", [$this->extensions['Twig\Extension\CoreExtension']->convertDate("now")], "method", false, false, false, 92), "days", [], "any", false, false, false, 92);
            // line 93
            yield "                    <p class=\"text-sm text-muted-foreground mt-1\">
                        ";
            // line 94
            if (($this->extensions['Twig\Extension\CoreExtension']->convertDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["objectif"]) || array_key_exists("objectif", $context) ? $context["objectif"] : (function () { throw new RuntimeError('Variable "objectif" does not exist.', 94, $this->source); })()), "dateFin", [], "any", false, false, false, 94)) < $this->extensions['Twig\Extension\CoreExtension']->convertDate("now"))) {
                // line 95
                yield "                            En retard
                        ";
            } else {
                // line 97
                yield "                            J-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["daysLeft"]) || array_key_exists("daysLeft", $context) ? $context["daysLeft"] : (function () { throw new RuntimeError('Variable "daysLeft" does not exist.', 97, $this->source); })()), "html", null, true);
                yield "
                        ";
            }
            // line 99
            yield "                    </p>
                ";
        } else {
            // line 101
            yield "                    <p class=\"text-muted-foreground\">Aucune date limite fixée</p>
                ";
        }
        // line 103
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
        return "other/goal/show.html.twig";
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
        return array (  302 => 103,  298 => 101,  294 => 99,  288 => 97,  284 => 95,  282 => 94,  279 => 93,  277 => 92,  272 => 90,  268 => 88,  266 => 87,  257 => 81,  251 => 78,  245 => 74,  240 => 70,  236 => 68,  232 => 66,  224 => 63,  218 => 61,  216 => 60,  206 => 57,  203 => 56,  200 => 55,  195 => 54,  191 => 53,  186 => 50,  182 => 49,  179 => 48,  177 => 47,  168 => 41,  157 => 33,  152 => 31,  146 => 28,  143 => 27,  140 => 26,  135 => 25,  131 => 24,  125 => 21,  119 => 18,  114 => 15,  104 => 7,  101 => 6,  88 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}{{ objectif.titre }} - LifeOps{% endblock %}

{% block body %}
    <div class=\"mb-6\">
        <a href=\"{{ path('app_goal_index') }}\" class=\"text-sm text-muted-foreground hover:text-foreground flex items-center\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"mr-1 h-4 w-4\"><path d=\"m15 18-6-6 6-6\"/></svg>
            Retour aux objectifs
        </a>
    </div>

    <div class=\"grid grid-cols-1 lg:grid-cols-3 gap-8\">
        {# Goal Details #}
        <div class=\"lg:col-span-2 space-y-6\">
            <div class=\"flex items-start justify-between\">
                <div>
                     <h1 class=\"text-3xl font-bold tracking-tight text-foreground mb-2\">{{ objectif.titre }}</h1>
                     <div class=\"flex gap-2 mb-4\">
                        <span class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold border-transparent bg-secondary text-secondary-foreground\">
                            {{ objectif.categorie|capitalize }}
                        </span>
                        <span class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold
                            {% if objectif.statut == 'achieved' %}border-transparent bg-[hsl(var(--success))]/20 text-[hsl(var(--success))]
                            {% elseif objectif.statut == 'in-progress' %}border-transparent bg-[hsl(var(--warning))]/20 text-[hsl(var(--warning))]
                            {% else %}border-transparent bg-secondary text-secondary-foreground{% endif %}
                        \">
                            {{ objectif.statut|capitalize }}
                        </span>
                     </div>
                     <p class=\"text-muted-foreground\">{{ objectif.description }}</p>
                </div>
                <a href=\"{{ path('app_goal_edit', {'id': objectif.id}) }}\" class=\"inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2\">
                    Modifier
                </a>
            </div>

            <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow p-6\">
                 <div class=\"flex justify-between items-center mb-4\">
                    <h2 class=\"text-lg font-semibold\">Plan d'action</h2>
                    <a href=\"{{ path('app_goal_action_new', {'id': objectif.id}) }}\" class=\"text-sm font-medium text-primary hover:underline flex items-center\">
                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"mr-1 h-4 w-4\"><line x1=\"12\" y1=\"5\" x2=\"12\" y2=\"19\"/><line x1=\"5\" y1=\"12\" x2=\"19\" y2=\"12\"/></svg>
                        Ajouter Étape
                    </a>
                </div>
                
                {% if objectif.planActions|length > 0 %}
                    <ul class=\"space-y-3\">
                        {% for action in objectif.planActions %}
                            <li class=\"flex items-center justify-between p-3 rounded-lg bg-secondary/30 border border-border/50\">
                                <div class=\"flex items-center gap-3\">
                                    <div class=\"h-2 w-2 rounded-full 
                                        {% if action.statut == 'done' %}bg-[hsl(var(--success))]
                                        {% elseif action.statut == 'in-progress' %}bg-[hsl(var(--warning))]
                                        {% else %}bg-muted-foreground{% endif %}
                                    \"></div>
                                    <span class=\"{% if action.statut == 'done' %}line-through text-muted-foreground{% endif %}\">{{ action.titre }}</span>
                                </div>
                                    <span class=\"text-xs text-muted-foreground\">
                                    {% if action.dateFin %}
                                        {{ action.dateFin|date('d/m/Y') }}
                                    {% endif %}
                                </span>
                            </li>
                        {% endfor %}
                    </ul>
                {% else %}
                    <p class=\"text-center text-muted-foreground py-4 text-sm\">Aucune étape définie pour le moment.</p>
                {% endif %}
            </div>
        </div>

        {# Sidebar Stats #}
        <div class=\"space-y-6\">
            <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow p-6\">
                <h3 class=\"text-sm font-medium text-muted-foreground mb-4\">Progression Globale</h3>
                <div class=\"flex items-end gap-2 mb-2\">
                    <span class=\"text-4xl font-bold\">{{ objectif.progression }}%</span>
                </div>
                <div class=\"h-2 w-full rounded-full bg-secondary\">
                    <div class=\"h-full rounded-full bg-primary transition-all duration-500\" style=\"width: {{ objectif.progression }}%\"></div>
                </div>
            </div>

            <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow p-6\">
                <h3 class=\"text-sm font-medium text-muted-foreground mb-2\">Date Limite</h3>
                {% if objectif.dateFin %}
                    <p class=\"text-lg font-semibold flex items-center\">
                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"mr-2 h-5 w-5 text-muted-foreground\"><rect width=\"18\" height=\"18\" x=\"3\" y=\"4\" rx=\"2\" ry=\"2\"/><line x1=\"16\" y1=\"2\" x2=\"16\" y2=\"6\"/><line x1=\"8\" y1=\"2\" x2=\"8\" y2=\"6\"/><line x1=\"3\" y1=\"10\" x2=\"21\" y2=\"10\"/></svg>
                        {{ objectif.dateFin|date('d F Y') }}
                    </p>
                    {% set daysLeft = date(objectif.dateFin).diff(date('now')).days %}
                    <p class=\"text-sm text-muted-foreground mt-1\">
                        {% if date(objectif.dateFin) < date('now') %}
                            En retard
                        {% else %}
                            J-{{ daysLeft }}
                        {% endif %}
                    </p>
                {% else %}
                    <p class=\"text-muted-foreground\">Aucune date limite fixée</p>
                {% endif %}
            </div>
        </div>
    </div>
{% endblock %}
", "other/goal/show.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\other\\goal\\show.html.twig");
    }
}
