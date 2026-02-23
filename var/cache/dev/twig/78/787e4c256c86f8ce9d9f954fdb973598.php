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

/* other/transaction/new.html.twig */
class __TwigTemplate_7f6eeb2251966cccdfe4c48b0509a4f5 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/transaction/new.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/transaction/new.html.twig"));

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

        yield "Nouvelle Transaction - LifeOps";
        
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
        <h1 class=\"mb-8 text-3xl font-bold tracking-tight text-foreground\">Nouvelle transaction</h1>
        
        <form method=\"post\" class=\"space-y-6\">
            <div>
                <label for=\"title\" class=\"block text-sm font-medium text-foreground\">Titre</label>
                <input type=\"text\" name=\"title\" id=\"title\" required class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
            </div>

            <div class=\"grid grid-cols-1 gap-6 sm:grid-cols-2\">
                <div>
                    <label for=\"amount\" class=\"block text-sm font-medium text-foreground\">Montant (€)</label>
                    <input type=\"number\" step=\"0.01\" name=\"amount\" id=\"amount\" required class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
                <div>
                    <label for=\"type\" class=\"block text-sm font-medium text-foreground\">Type</label>
                    <select name=\"type\" id=\"type\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                        <option value=\"expense\">Dépense</option>
                        <option value=\"income\">Revenu</option>
                    </select>
                </div>
            </div>

            <div class=\"grid grid-cols-1 gap-6 sm:grid-cols-2\">
                <div>
                     <label for=\"category\" class=\"block text-sm font-medium text-foreground\">Catégorie</label>
                     <input type=\"text\" name=\"category\" id=\"category\" list=\"categories\" required class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                     <datalist id=\"categories\">
                        <option value=\"Nourriture\">
                        <option value=\"Logement\">
                        <option value=\"Transport\">
                        <option value=\"Loisirs\">
                        <option value=\"Salaire\">
                        <option value=\"Freelance\">
                        <option value=\"Sante\">
                     </datalist>
                </div>
                 <div>
                    <label for=\"date\" class=\"block text-sm font-medium text-foreground\">Date</label>
                    <input type=\"date\" name=\"date\" id=\"date\" required value=\"";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y-m-d"), "html", null, true);
        yield "\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
            </div>

            <div>
                <label for=\"note\" class=\"block text-sm font-medium text-foreground\">Note (optionnel)</label>
                <textarea name=\"note\" id=\"note\" rows=\"2\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\"></textarea>
            </div>

            <div class=\"flex justify-end gap-3\">
                <a href=\"";
        // line 55
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_finances_index");
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
        return "other/transaction/new.html.twig";
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
        return array (  154 => 55,  141 => 45,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Nouvelle Transaction - LifeOps{% endblock %}

{% block body %}
    <div class=\"mx-auto max-w-2xl\">
        <h1 class=\"mb-8 text-3xl font-bold tracking-tight text-foreground\">Nouvelle transaction</h1>
        
        <form method=\"post\" class=\"space-y-6\">
            <div>
                <label for=\"title\" class=\"block text-sm font-medium text-foreground\">Titre</label>
                <input type=\"text\" name=\"title\" id=\"title\" required class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
            </div>

            <div class=\"grid grid-cols-1 gap-6 sm:grid-cols-2\">
                <div>
                    <label for=\"amount\" class=\"block text-sm font-medium text-foreground\">Montant (€)</label>
                    <input type=\"number\" step=\"0.01\" name=\"amount\" id=\"amount\" required class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
                <div>
                    <label for=\"type\" class=\"block text-sm font-medium text-foreground\">Type</label>
                    <select name=\"type\" id=\"type\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                        <option value=\"expense\">Dépense</option>
                        <option value=\"income\">Revenu</option>
                    </select>
                </div>
            </div>

            <div class=\"grid grid-cols-1 gap-6 sm:grid-cols-2\">
                <div>
                     <label for=\"category\" class=\"block text-sm font-medium text-foreground\">Catégorie</label>
                     <input type=\"text\" name=\"category\" id=\"category\" list=\"categories\" required class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                     <datalist id=\"categories\">
                        <option value=\"Nourriture\">
                        <option value=\"Logement\">
                        <option value=\"Transport\">
                        <option value=\"Loisirs\">
                        <option value=\"Salaire\">
                        <option value=\"Freelance\">
                        <option value=\"Sante\">
                     </datalist>
                </div>
                 <div>
                    <label for=\"date\" class=\"block text-sm font-medium text-foreground\">Date</label>
                    <input type=\"date\" name=\"date\" id=\"date\" required value=\"{{ \"now\"|date(\"Y-m-d\") }}\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
            </div>

            <div>
                <label for=\"note\" class=\"block text-sm font-medium text-foreground\">Note (optionnel)</label>
                <textarea name=\"note\" id=\"note\" rows=\"2\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\"></textarea>
            </div>

            <div class=\"flex justify-end gap-3\">
                <a href=\"{{ path('app_finances_index') }}\" class=\"rounded-lg px-4 py-2 text-sm font-medium text-muted-foreground hover:bg-secondary\">Annuler</a>
                <button type=\"submit\" class=\"rounded-lg bg-primary px-4 py-2 text-sm font-medium text-primary-foreground hover:bg-primary/90\">Enregistrer</button>
            </div>
        </form>
    </div>
{% endblock %}
", "other/transaction/new.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\other\\transaction\\new.html.twig");
    }
}
