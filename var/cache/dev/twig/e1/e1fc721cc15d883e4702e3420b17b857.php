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

/* other/goal/index.html.twig */
class __TwigTemplate_0a50615570b48b84e18fd9126929811b extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/goal/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/goal/index.html.twig"));

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

        yield "Objectifs - LifeOps";
        
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
            <h1 class=\"text-3xl font-bold tracking-tight text-foreground\">Mes Objectifs</h1>
            <p class=\"text-muted-foreground\">Suivez vos ambitions à long terme</p>
        </div>
        <a href=\"";
        // line 11
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_goal_new");
        yield "\" class=\"inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"mr-2 h-4 w-4\"><line x1=\"12\" y1=\"5\" x2=\"12\" y2=\"19\"/><line x1=\"5\" y1=\"12\" x2=\"19\" y2=\"12\"/></svg>
            Nouvel Objectif
        </a>
    </div>

    <div class=\"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6\">
        ";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["objectifs"]) || array_key_exists("objectifs", $context) ? $context["objectifs"] : (function () { throw new RuntimeError('Variable "objectifs" does not exist.', 18, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["objectif"]) {
            // line 19
            yield "            <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow transition-all hover:shadow-md\">
                <div class=\"p-6\">
                    <div class=\"flex items-center justify-between mb-2\">
                        <span class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold border-transparent bg-secondary text-secondary-foreground\">
                            ";
            // line 23
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["objectif"], "categorie", [], "any", false, false, false, 23)), "html", null, true);
            yield "
                        </span>
                        <div class=\"dropdown relative\">
                           <a href=\"";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_goal_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["objectif"], "id", [], "any", false, false, false, 26)]), "html", null, true);
            yield "\" class=\"text-sm font-medium text-primary hover:underline\">Voir détails &rarr;</a>
                        </div>
                    </div>
                    
                    <h3 class=\"text-xl font-semibold mb-2\">";
            // line 30
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["objectif"], "titre", [], "any", false, false, false, 30), "html", null, true);
            yield "</h3>
                    <p class=\"text-muted-foreground text-sm line-clamp-2 mb-4\">";
            // line 31
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["objectif"], "description", [], "any", false, false, false, 31), "html", null, true);
            yield "</p>
                    
                    <div class=\"space-y-2\">
                        <div class=\"flex justify-between text-sm\">
                            <span class=\"text-muted-foreground\">Progression</span>
                            <span class=\"font-medium\">";
            // line 36
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["objectif"], "progression", [], "any", false, false, false, 36), "html", null, true);
            yield "%</span>
                        </div>
                        <div class=\"h-2 w-full rounded-full bg-secondary\">
                            <div class=\"h-full rounded-full bg-primary transition-all duration-500\" style=\"width: ";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["objectif"], "progression", [], "any", false, false, false, 39), "html", null, true);
            yield "%\"></div>
                        </div>
                    </div>

                    <div class=\"mt-4 flex items-center justify-between text-xs text-muted-foreground\">
                        <span class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold
                            ";
            // line 45
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["objectif"], "statut", [], "any", false, false, false, 45) == "achieved")) {
                yield "border-transparent bg-[hsl(var(--success))]/20 text-[hsl(var(--success))]
                            ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 46
$context["objectif"], "statut", [], "any", false, false, false, 46) == "in-progress")) {
                yield "border-transparent bg-[hsl(var(--warning))]/20 text-[hsl(var(--warning))]
                            ";
            } else {
                // line 47
                yield "border-transparent bg-secondary text-secondary-foreground";
            }
            // line 48
            yield "                        \">
                            ";
            // line 49
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["objectif"], "statut", [], "any", false, false, false, 49)), "html", null, true);
            yield "
                        </span>
                        ";
            // line 51
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["objectif"], "dateFin", [], "any", false, false, false, 51)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 52
                yield "                            <span>Échéance: ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["objectif"], "dateFin", [], "any", false, false, false, 52), "d/m/Y"), "html", null, true);
                yield "</span>
                        ";
            }
            // line 54
            yield "                    </div>
                </div>
            </div>
        ";
            $context['_iterated'] = true;
        }
        // line 57
        if (!$context['_iterated']) {
            // line 58
            yield "            <div class=\"col-span-full text-center py-12\">
                <div class=\"p-4 rounded-full bg-secondary inline-block mb-4\">
                     <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-8 w-8 text-muted-foreground\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><path d=\"m9 12 2 2 4-4\"/></svg>
                </div>
                <h3 class=\"text-lg font-medium text-foreground\">Aucun objectif</h3>
                <p class=\"text-muted-foreground mt-1\">Définissez vos premiers objectifs pour commencer.</p>
                <div class=\"mt-6\">
                     <a href=\"";
            // line 65
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_goal_new");
            yield "\" class=\"text-primary hover:underline\">Créer un objectif</a>
                </div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['objectif'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 69
        yield "    </div>
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
        return "other/goal/index.html.twig";
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
        return array (  224 => 69,  214 => 65,  205 => 58,  203 => 57,  196 => 54,  190 => 52,  188 => 51,  183 => 49,  180 => 48,  177 => 47,  172 => 46,  168 => 45,  159 => 39,  153 => 36,  145 => 31,  141 => 30,  134 => 26,  128 => 23,  122 => 19,  117 => 18,  107 => 11,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Objectifs - LifeOps{% endblock %}

{% block body %}
    <div class=\"flex items-center justify-between mb-8\">
        <div>
            <h1 class=\"text-3xl font-bold tracking-tight text-foreground\">Mes Objectifs</h1>
            <p class=\"text-muted-foreground\">Suivez vos ambitions à long terme</p>
        </div>
        <a href=\"{{ path('app_goal_new') }}\" class=\"inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"mr-2 h-4 w-4\"><line x1=\"12\" y1=\"5\" x2=\"12\" y2=\"19\"/><line x1=\"5\" y1=\"12\" x2=\"19\" y2=\"12\"/></svg>
            Nouvel Objectif
        </a>
    </div>

    <div class=\"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6\">
        {% for objectif in objectifs %}
            <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow transition-all hover:shadow-md\">
                <div class=\"p-6\">
                    <div class=\"flex items-center justify-between mb-2\">
                        <span class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold border-transparent bg-secondary text-secondary-foreground\">
                            {{ objectif.categorie|capitalize }}
                        </span>
                        <div class=\"dropdown relative\">
                           <a href=\"{{ path('app_goal_show', {'id': objectif.id}) }}\" class=\"text-sm font-medium text-primary hover:underline\">Voir détails &rarr;</a>
                        </div>
                    </div>
                    
                    <h3 class=\"text-xl font-semibold mb-2\">{{ objectif.titre }}</h3>
                    <p class=\"text-muted-foreground text-sm line-clamp-2 mb-4\">{{ objectif.description }}</p>
                    
                    <div class=\"space-y-2\">
                        <div class=\"flex justify-between text-sm\">
                            <span class=\"text-muted-foreground\">Progression</span>
                            <span class=\"font-medium\">{{ objectif.progression }}%</span>
                        </div>
                        <div class=\"h-2 w-full rounded-full bg-secondary\">
                            <div class=\"h-full rounded-full bg-primary transition-all duration-500\" style=\"width: {{ objectif.progression }}%\"></div>
                        </div>
                    </div>

                    <div class=\"mt-4 flex items-center justify-between text-xs text-muted-foreground\">
                        <span class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold
                            {% if objectif.statut == 'achieved' %}border-transparent bg-[hsl(var(--success))]/20 text-[hsl(var(--success))]
                            {% elseif objectif.statut == 'in-progress' %}border-transparent bg-[hsl(var(--warning))]/20 text-[hsl(var(--warning))]
                            {% else %}border-transparent bg-secondary text-secondary-foreground{% endif %}
                        \">
                            {{ objectif.statut|capitalize }}
                        </span>
                        {% if objectif.dateFin %}
                            <span>Échéance: {{ objectif.dateFin|date('d/m/Y') }}</span>
                        {% endif %}
                    </div>
                </div>
            </div>
        {% else %}
            <div class=\"col-span-full text-center py-12\">
                <div class=\"p-4 rounded-full bg-secondary inline-block mb-4\">
                     <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-8 w-8 text-muted-foreground\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><path d=\"m9 12 2 2 4-4\"/></svg>
                </div>
                <h3 class=\"text-lg font-medium text-foreground\">Aucun objectif</h3>
                <p class=\"text-muted-foreground mt-1\">Définissez vos premiers objectifs pour commencer.</p>
                <div class=\"mt-6\">
                     <a href=\"{{ path('app_goal_new') }}\" class=\"text-primary hover:underline\">Créer un objectif</a>
                </div>
            </div>
        {% endfor %}
    </div>
{% endblock %}
", "other/goal/index.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\other\\goal\\index.html.twig");
    }
}
