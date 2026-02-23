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

/* other/transaction/edit.html.twig */
class __TwigTemplate_0a7e9bb45d251b281d398956059cf96f extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/transaction/edit.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/transaction/edit.html.twig"));

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

        yield "Modifier Transaction - LifeOps";
        
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
        <h1 class=\"mb-8 text-3xl font-bold tracking-tight text-foreground\">Modifier la transaction</h1>
        
        <form method=\"post\" class=\"space-y-6\">
            <div>
                <label for=\"title\" class=\"block text-sm font-medium text-foreground\">Titre</label>
                <input type=\"text\" name=\"title\" id=\"title\" required value=\"";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["transaction"]) || array_key_exists("transaction", $context) ? $context["transaction"] : (function () { throw new RuntimeError('Variable "transaction" does not exist.', 12, $this->source); })()), "title", [], "any", false, false, false, 12), "html", null, true);
        yield "\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
            </div>

            <div class=\"grid grid-cols-1 gap-6 sm:grid-cols-2\">
                <div>
                    <label for=\"amount\" class=\"block text-sm font-medium text-foreground\">Montant (€)</label>
                    <input type=\"number\" step=\"0.01\" name=\"amount\" id=\"amount\" required value=\"";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["transaction"]) || array_key_exists("transaction", $context) ? $context["transaction"] : (function () { throw new RuntimeError('Variable "transaction" does not exist.', 18, $this->source); })()), "amount", [], "any", false, false, false, 18), "html", null, true);
        yield "\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
                <div>
                    <label for=\"type\" class=\"block text-sm font-medium text-foreground\">Type</label>
                    <select name=\"type\" id=\"type\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                        <option value=\"expense\" ";
        // line 23
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["transaction"]) || array_key_exists("transaction", $context) ? $context["transaction"] : (function () { throw new RuntimeError('Variable "transaction" does not exist.', 23, $this->source); })()), "type", [], "any", false, false, false, 23) == "expense")) ? ("selected") : (""));
        yield ">Dépense</option>
                        <option value=\"income\" ";
        // line 24
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["transaction"]) || array_key_exists("transaction", $context) ? $context["transaction"] : (function () { throw new RuntimeError('Variable "transaction" does not exist.', 24, $this->source); })()), "type", [], "any", false, false, false, 24) == "income")) ? ("selected") : (""));
        yield ">Revenu</option>
                    </select>
                </div>
            </div>

            <div class=\"grid grid-cols-1 gap-6 sm:grid-cols-2\">
                <div>
                     <label for=\"category\" class=\"block text-sm font-medium text-foreground\">Catégorie</label>
                     <input type=\"text\" name=\"category\" id=\"category\" list=\"categories\" required value=\"";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["transaction"]) || array_key_exists("transaction", $context) ? $context["transaction"] : (function () { throw new RuntimeError('Variable "transaction" does not exist.', 32, $this->source); })()), "category", [], "any", false, false, false, 32), "html", null, true);
        yield "\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
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
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["transaction"]) || array_key_exists("transaction", $context) ? $context["transaction"] : (function () { throw new RuntimeError('Variable "transaction" does not exist.', 45, $this->source); })()), "date", [], "any", false, false, false, 45), "Y-m-d"), "html", null, true);
        yield "\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
            </div>

            <div>
                <label for=\"note\" class=\"block text-sm font-medium text-foreground\">Note (optionnel)</label>
                <textarea name=\"note\" id=\"note\" rows=\"2\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">";
        // line 51
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["transaction"]) || array_key_exists("transaction", $context) ? $context["transaction"] : (function () { throw new RuntimeError('Variable "transaction" does not exist.', 51, $this->source); })()), "note", [], "any", false, false, false, 51), "html", null, true);
        yield "</textarea>
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
        return "other/transaction/edit.html.twig";
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
        return array (  172 => 55,  165 => 51,  156 => 45,  140 => 32,  129 => 24,  125 => 23,  117 => 18,  108 => 12,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Modifier Transaction - LifeOps{% endblock %}

{% block body %}
    <div class=\"mx-auto max-w-2xl\">
        <h1 class=\"mb-8 text-3xl font-bold tracking-tight text-foreground\">Modifier la transaction</h1>
        
        <form method=\"post\" class=\"space-y-6\">
            <div>
                <label for=\"title\" class=\"block text-sm font-medium text-foreground\">Titre</label>
                <input type=\"text\" name=\"title\" id=\"title\" required value=\"{{ transaction.title }}\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
            </div>

            <div class=\"grid grid-cols-1 gap-6 sm:grid-cols-2\">
                <div>
                    <label for=\"amount\" class=\"block text-sm font-medium text-foreground\">Montant (€)</label>
                    <input type=\"number\" step=\"0.01\" name=\"amount\" id=\"amount\" required value=\"{{ transaction.amount }}\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
                <div>
                    <label for=\"type\" class=\"block text-sm font-medium text-foreground\">Type</label>
                    <select name=\"type\" id=\"type\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                        <option value=\"expense\" {{ transaction.type == 'expense' ? 'selected' : '' }}>Dépense</option>
                        <option value=\"income\" {{ transaction.type == 'income' ? 'selected' : '' }}>Revenu</option>
                    </select>
                </div>
            </div>

            <div class=\"grid grid-cols-1 gap-6 sm:grid-cols-2\">
                <div>
                     <label for=\"category\" class=\"block text-sm font-medium text-foreground\">Catégorie</label>
                     <input type=\"text\" name=\"category\" id=\"category\" list=\"categories\" required value=\"{{ transaction.category }}\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
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
                    <input type=\"date\" name=\"date\" id=\"date\" required value=\"{{ transaction.date|date('Y-m-d') }}\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
            </div>

            <div>
                <label for=\"note\" class=\"block text-sm font-medium text-foreground\">Note (optionnel)</label>
                <textarea name=\"note\" id=\"note\" rows=\"2\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">{{ transaction.note }}</textarea>
            </div>

            <div class=\"flex justify-end gap-3\">
                <a href=\"{{ path('app_finances_index') }}\" class=\"rounded-lg px-4 py-2 text-sm font-medium text-muted-foreground hover:bg-secondary\">Annuler</a>
                <button type=\"submit\" class=\"rounded-lg bg-primary px-4 py-2 text-sm font-medium text-primary-foreground hover:bg-primary/90\">Enregistrer</button>
            </div>
        </form>
    </div>
{% endblock %}
", "other/transaction/edit.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\other\\transaction\\edit.html.twig");
    }
}
