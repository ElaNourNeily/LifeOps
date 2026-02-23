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

/* other/health/edit.html.twig */
class __TwigTemplate_a22e4aab08d6f8e26b7111ed8de99f7f extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/health/edit.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/health/edit.html.twig"));

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

        yield "Modifier Entrée Santé - LifeOps";
        
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
        yield "    <div class=\"mx-auto max-w-2xl\">
        <h1 class=\"mb-8 text-3xl font-bold tracking-tight text-foreground\">Modifier l'entrée santé</h1>
        
        <form method=\"post\" class=\"space-y-6\">
            <div>
                <label for=\"date\" class=\"block text-sm font-medium text-foreground\">Date</label>
                <input type=\"date\" name=\"date\" id=\"date\" required value=\"";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["health_entry"]) || array_key_exists("health_entry", $context) ? $context["health_entry"] : (function () { throw new RuntimeError('Variable "health_entry" does not exist.', 12, $this->source); })()), "date", [], "any", false, false, false, 12), "Y-m-d"), "html", null, true);
        yield "\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
            </div>

            <div class=\"grid grid-cols-1 gap-6 sm:grid-cols-2\">
                <div>
                    <label for=\"sleep\" class=\"block text-sm font-medium text-foreground\">Sommeil (heures)</label>
                    <input type=\"number\" step=\"0.1\" name=\"sleep\" id=\"sleep\" required value=\"";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["health_entry"]) || array_key_exists("health_entry", $context) ? $context["health_entry"] : (function () { throw new RuntimeError('Variable "health_entry" does not exist.', 18, $this->source); })()), "sleep", [], "any", false, false, false, 18), "html", null, true);
        yield "\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
                <div>
                    <label for=\"water\" class=\"block text-sm font-medium text-foreground\">Eau (verres)</label>
                    <input type=\"number\" name=\"water\" id=\"water\" required value=\"";
        // line 22
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["health_entry"]) || array_key_exists("health_entry", $context) ? $context["health_entry"] : (function () { throw new RuntimeError('Variable "health_entry" does not exist.', 22, $this->source); })()), "water", [], "any", false, false, false, 22), "html", null, true);
        yield "\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
            </div>

            <div class=\"grid grid-cols-1 gap-6 sm:grid-cols-2\">
                <div>
                    <label for=\"exercise\" class=\"block text-sm font-medium text-foreground\">Exercice (minutes)</label>
                    <input type=\"number\" name=\"exercise\" id=\"exercise\" required value=\"";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["health_entry"]) || array_key_exists("health_entry", $context) ? $context["health_entry"] : (function () { throw new RuntimeError('Variable "health_entry" does not exist.', 29, $this->source); })()), "exercise", [], "any", false, false, false, 29), "html", null, true);
        yield "\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
                <div>
                    <label for=\"mood\" class=\"block text-sm font-medium text-foreground\">Humeur (1-5)</label>
                    <input type=\"range\" min=\"1\" max=\"5\" name=\"mood\" id=\"mood\" required value=\"";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["health_entry"]) || array_key_exists("health_entry", $context) ? $context["health_entry"] : (function () { throw new RuntimeError('Variable "health_entry" does not exist.', 33, $this->source); })()), "mood", [], "any", false, false, false, 33), "html", null, true);
        yield "\" class=\"mt-1 block w-full accent-primary\">
                    <div class=\"flex justify-between text-xs text-muted-foreground mt-1\">
                        <span>Mauvaise</span>
                        <span>Excellente</span>
                    </div>
                </div>
            </div>

            <div>
                <label for=\"notes\" class=\"block text-sm font-medium text-foreground\">Notes (optionnel)</label>
                <textarea name=\"notes\" id=\"notes\" rows=\"3\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">";
        // line 43
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["health_entry"]) || array_key_exists("health_entry", $context) ? $context["health_entry"] : (function () { throw new RuntimeError('Variable "health_entry" does not exist.', 43, $this->source); })()), "notes", [], "any", false, false, false, 43), "html", null, true);
        yield "</textarea>
            </div>

            <div class=\"flex justify-end gap-3\">
                <a href=\"";
        // line 47
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_health_index");
        yield "\" class=\"rounded-lg px-4 py-2 text-sm font-medium text-muted-foreground hover:bg-secondary\">Annuler</a>
                <button type=\"submit\" class=\"rounded-lg bg-primary px-4 py-2 text-sm font-medium text-primary-foreground hover:bg-primary/90\">Enregistrer</button>
            </div>
        </form>
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
        return "other/health/edit.html.twig";
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
        return array (  161 => 47,  154 => 43,  141 => 33,  134 => 29,  124 => 22,  117 => 18,  108 => 12,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Modifier Entrée Santé - LifeOps{% endblock %}

{% block body %}
    <div class=\"mx-auto max-w-2xl\">
        <h1 class=\"mb-8 text-3xl font-bold tracking-tight text-foreground\">Modifier l'entrée santé</h1>
        
        <form method=\"post\" class=\"space-y-6\">
            <div>
                <label for=\"date\" class=\"block text-sm font-medium text-foreground\">Date</label>
                <input type=\"date\" name=\"date\" id=\"date\" required value=\"{{ health_entry.date|date('Y-m-d') }}\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
            </div>

            <div class=\"grid grid-cols-1 gap-6 sm:grid-cols-2\">
                <div>
                    <label for=\"sleep\" class=\"block text-sm font-medium text-foreground\">Sommeil (heures)</label>
                    <input type=\"number\" step=\"0.1\" name=\"sleep\" id=\"sleep\" required value=\"{{ health_entry.sleep }}\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
                <div>
                    <label for=\"water\" class=\"block text-sm font-medium text-foreground\">Eau (verres)</label>
                    <input type=\"number\" name=\"water\" id=\"water\" required value=\"{{ health_entry.water }}\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
            </div>

            <div class=\"grid grid-cols-1 gap-6 sm:grid-cols-2\">
                <div>
                    <label for=\"exercise\" class=\"block text-sm font-medium text-foreground\">Exercice (minutes)</label>
                    <input type=\"number\" name=\"exercise\" id=\"exercise\" required value=\"{{ health_entry.exercise }}\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
                <div>
                    <label for=\"mood\" class=\"block text-sm font-medium text-foreground\">Humeur (1-5)</label>
                    <input type=\"range\" min=\"1\" max=\"5\" name=\"mood\" id=\"mood\" required value=\"{{ health_entry.mood }}\" class=\"mt-1 block w-full accent-primary\">
                    <div class=\"flex justify-between text-xs text-muted-foreground mt-1\">
                        <span>Mauvaise</span>
                        <span>Excellente</span>
                    </div>
                </div>
            </div>

            <div>
                <label for=\"notes\" class=\"block text-sm font-medium text-foreground\">Notes (optionnel)</label>
                <textarea name=\"notes\" id=\"notes\" rows=\"3\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">{{ health_entry.notes }}</textarea>
            </div>

            <div class=\"flex justify-end gap-3\">
                <a href=\"{{ path('app_health_index') }}\" class=\"rounded-lg px-4 py-2 text-sm font-medium text-muted-foreground hover:bg-secondary\">Annuler</a>
                <button type=\"submit\" class=\"rounded-lg bg-primary px-4 py-2 text-sm font-medium text-primary-foreground hover:bg-primary/90\">Enregistrer</button>
            </div>
        </form>
    </div>
{% endblock %}
", "other/health/edit.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\other\\health\\edit.html.twig");
    }
}
