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

/* other/time/index.html.twig */
class __TwigTemplate_5aba0aa89f2ee8635a50f9820e03b06b extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/time/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/time/index.html.twig"));

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

        yield "Planning - LifeOps";
        
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
            <h1 class=\"text-3xl font-bold tracking-tight text-foreground\">Planning du Jour</h1>
            <p class=\"text-muted-foreground\">";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate((isset($context["today"]) || array_key_exists("today", $context) ? $context["today"] : (function () { throw new RuntimeError('Variable "today" does not exist.', 9, $this->source); })()), "d/m/Y"), "html", null, true);
        yield "</p>
        </div>
        <a href=\"";
        // line 11
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_activite_new");
        yield "\" class=\"inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"mr-2 h-4 w-4\"><line x1=\"12\" y1=\"5\" x2=\"12\" y2=\"19\"/><line x1=\"5\" y1=\"12\" x2=\"19\" y2=\"12\"/></svg>
            Ajouter Activité
        </a>
    </div>

    <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow p-6\">
        ";
        // line 18
        if (((isset($context["planning"]) || array_key_exists("planning", $context) ? $context["planning"] : (function () { throw new RuntimeError('Variable "planning" does not exist.', 18, $this->source); })()) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["planning"]) || array_key_exists("planning", $context) ? $context["planning"] : (function () { throw new RuntimeError('Variable "planning" does not exist.', 18, $this->source); })()), "activites", [], "any", false, false, false, 18)) > 0))) {
            // line 19
            yield "            <div class=\"space-y-4\">
                ";
            // line 20
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["planning"]) || array_key_exists("planning", $context) ? $context["planning"] : (function () { throw new RuntimeError('Variable "planning" does not exist.', 20, $this->source); })()), "activites", [], "any", false, false, false, 20));
            foreach ($context['_seq'] as $context["_key"] => $context["activite"]) {
                // line 21
                yield "                    <div class=\"flex items-center gap-4 rounded-lg bg-secondary/50 p-4 border border-border/50 transition-colors hover:bg-secondary/70\">
                         <div class=\"flex-shrink-0 w-24 text-center\">
                            <span class=\"block text-sm font-bold text-foreground\">";
                // line 23
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["activite"], "heureDebutEstimee", [], "any", false, false, false, 23), "H:i"), "html", null, true);
                yield "</span>
                            <span class=\"block text-xs text-muted-foreground\">";
                // line 24
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["activite"], "heureFinEstimee", [], "any", false, false, false, 24), "H:i"), "html", null, true);
                yield "</span>
                        </div>
                        
                        <div class=\"w-1 h-12 rounded-full self-stretch bg-primary\"></div>
                        
                        <div class=\"flex-1\">
                            <h3 class=\"font-semibold text-foreground\">";
                // line 30
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["activite"], "titre", [], "any", false, false, false, 30), "html", null, true);
                yield "</h3>
                             <div class=\"flex gap-2 mt-1\">
                                <span class=\"inline-flex items-center rounded-full border px-2 py-0.5 text-xs font-semibold
                                    ";
                // line 33
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["activite"], "priorite", [], "any", false, false, false, 33) == "high")) {
                    yield "border-transparent bg-destructive/20 text-destructive
                                    ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 34
$context["activite"], "priorite", [], "any", false, false, false, 34) == "medium")) {
                    yield "border-transparent bg-[hsl(var(--warning))]/20 text-[hsl(var(--warning))]
                                    ";
                } else {
                    // line 35
                    yield "border-transparent bg-secondary text-secondary-foreground";
                }
                // line 36
                yield "                                \">
                                    ";
                // line 37
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["activite"], "priorite", [], "any", false, false, false, 37)), "html", null, true);
                yield "
                                </span>
                                 <span class=\"inline-flex items-center rounded-full border px-2 py-0.5 text-xs font-semibold border-transparent bg-secondary text-secondary-foreground\">
                                    Urgence: ";
                // line 40
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["activite"], "niveauUrgence", [], "any", false, false, false, 40), "html", null, true);
                yield "/5
                                </span>
                            </div>
                        </div>

                         <div class=\"flex-shrink-0\">
                             <div class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold
                                ";
                // line 47
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["activite"], "etat", [], "any", false, false, false, 47) == "done")) {
                    yield "border-transparent bg-[hsl(var(--success))]/20 text-[hsl(var(--success))]
                                ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 48
$context["activite"], "etat", [], "any", false, false, false, 48) == "in-progress")) {
                    yield "border-transparent bg-[hsl(var(--warning))]/20 text-[hsl(var(--warning))]
                                ";
                } else {
                    // line 49
                    yield "border-transparent bg-secondary text-secondary-foreground";
                }
                // line 50
                yield "                            \">
                                ";
                // line 51
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["activite"], "etat", [], "any", false, false, false, 51)), "html", null, true);
                yield "
                            </div>
                        </div>
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['activite'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 56
            yield "            </div>
        ";
        } else {
            // line 58
            yield "            <div class=\"text-center py-12\">
                <div class=\"p-4 rounded-full bg-secondary inline-block mb-4\">
                     <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-8 w-8 text-muted-foreground\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><polyline points=\"12 6 12 12 16 14\"/></svg>
                </div>
                <h3 class=\"text-lg font-medium text-foreground\">Rien de prévu</h3>
                <p class=\"text-muted-foreground mt-1\">Votre planning pour aujourd'hui est vide.</p>
                <div class=\"mt-6\">
                     <a href=\"";
            // line 65
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_activite_new");
            yield "\" class=\"text-primary hover:underline\">Commencer à planifier</a>
                </div>
            </div>
        ";
        }
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
        return "other/time/index.html.twig";
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
        return array (  229 => 69,  222 => 65,  213 => 58,  209 => 56,  198 => 51,  195 => 50,  192 => 49,  187 => 48,  183 => 47,  173 => 40,  167 => 37,  164 => 36,  161 => 35,  156 => 34,  152 => 33,  146 => 30,  137 => 24,  133 => 23,  129 => 21,  125 => 20,  122 => 19,  120 => 18,  110 => 11,  105 => 9,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Planning - LifeOps{% endblock %}

{% block body %}
    <div class=\"flex items-center justify-between mb-8\">
        <div>
            <h1 class=\"text-3xl font-bold tracking-tight text-foreground\">Planning du Jour</h1>
            <p class=\"text-muted-foreground\">{{ today|date('d/m/Y') }}</p>
        </div>
        <a href=\"{{ path('app_activite_new') }}\" class=\"inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"mr-2 h-4 w-4\"><line x1=\"12\" y1=\"5\" x2=\"12\" y2=\"19\"/><line x1=\"5\" y1=\"12\" x2=\"19\" y2=\"12\"/></svg>
            Ajouter Activité
        </a>
    </div>

    <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow p-6\">
        {% if planning and planning.activites|length > 0 %}
            <div class=\"space-y-4\">
                {% for activite in planning.activites %}
                    <div class=\"flex items-center gap-4 rounded-lg bg-secondary/50 p-4 border border-border/50 transition-colors hover:bg-secondary/70\">
                         <div class=\"flex-shrink-0 w-24 text-center\">
                            <span class=\"block text-sm font-bold text-foreground\">{{ activite.heureDebutEstimee|date('H:i') }}</span>
                            <span class=\"block text-xs text-muted-foreground\">{{ activite.heureFinEstimee|date('H:i') }}</span>
                        </div>
                        
                        <div class=\"w-1 h-12 rounded-full self-stretch bg-primary\"></div>
                        
                        <div class=\"flex-1\">
                            <h3 class=\"font-semibold text-foreground\">{{ activite.titre }}</h3>
                             <div class=\"flex gap-2 mt-1\">
                                <span class=\"inline-flex items-center rounded-full border px-2 py-0.5 text-xs font-semibold
                                    {% if activite.priorite == 'high' %}border-transparent bg-destructive/20 text-destructive
                                    {% elseif activite.priorite == 'medium' %}border-transparent bg-[hsl(var(--warning))]/20 text-[hsl(var(--warning))]
                                    {% else %}border-transparent bg-secondary text-secondary-foreground{% endif %}
                                \">
                                    {{ activite.priorite|capitalize }}
                                </span>
                                 <span class=\"inline-flex items-center rounded-full border px-2 py-0.5 text-xs font-semibold border-transparent bg-secondary text-secondary-foreground\">
                                    Urgence: {{ activite.niveauUrgence }}/5
                                </span>
                            </div>
                        </div>

                         <div class=\"flex-shrink-0\">
                             <div class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold
                                {% if activite.etat == 'done' %}border-transparent bg-[hsl(var(--success))]/20 text-[hsl(var(--success))]
                                {% elseif activite.etat == 'in-progress' %}border-transparent bg-[hsl(var(--warning))]/20 text-[hsl(var(--warning))]
                                {% else %}border-transparent bg-secondary text-secondary-foreground{% endif %}
                            \">
                                {{ activite.etat|capitalize }}
                            </div>
                        </div>
                    </div>
                {% endfor %}
            </div>
        {% else %}
            <div class=\"text-center py-12\">
                <div class=\"p-4 rounded-full bg-secondary inline-block mb-4\">
                     <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-8 w-8 text-muted-foreground\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><polyline points=\"12 6 12 12 16 14\"/></svg>
                </div>
                <h3 class=\"text-lg font-medium text-foreground\">Rien de prévu</h3>
                <p class=\"text-muted-foreground mt-1\">Votre planning pour aujourd'hui est vide.</p>
                <div class=\"mt-6\">
                     <a href=\"{{ path('app_activite_new') }}\" class=\"text-primary hover:underline\">Commencer à planifier</a>
                </div>
            </div>
        {% endif %}
    </div>
{% endblock %}
", "other/time/index.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\other\\time\\index.html.twig");
    }
}
