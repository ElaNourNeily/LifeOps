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

/* other/transaction/index.html.twig */
class __TwigTemplate_ab4841eefa087379362c2c4fb6096521 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/transaction/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/transaction/index.html.twig"));

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
        yield "    <div class=\"mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between\">
        <div>
            <h1 class=\"text-3xl font-bold tracking-tight text-foreground\">Finances</h1>
            <p class=\"mt-1 text-muted-foreground\">Suivez vos revenus et dépenses</p>
        </div>
        <a href=\"";
        // line 11
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_finances_new");
        yield "\" class=\"flex items-center gap-2 rounded-lg bg-primary px-4 py-2.5 text-sm font-medium text-primary-foreground transition-colors hover:bg-primary/90\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-4 w-4\"><path d=\"M5 12h14\"/><path d=\"M12 5v14\"/></svg>
            Nouvelle transaction
        </a>
    </div>

    ";
        // line 18
        yield "    <div class=\"grid grid-cols-1 gap-4 sm:grid-cols-3 mb-8\">
        <div class=\"rounded-xl border border-border bg-card p-5\">
            <p class=\"text-sm font-medium text-muted-foreground\">Revenus totaux</p>
            <p class=\"text-2xl font-bold text-[hsl(var(--success))]\">+";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["totalIncome"]) || array_key_exists("totalIncome", $context) ? $context["totalIncome"] : (function () { throw new RuntimeError('Variable "totalIncome" does not exist.', 21, $this->source); })()), 0, ".", " "), "html", null, true);
        yield " €</p>
        </div>
        <div class=\"rounded-xl border border-border bg-card p-5\">
            <p class=\"text-sm font-medium text-muted-foreground\">Dépenses totales</p>
            <p class=\"text-2xl font-bold text-destructive\">-";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["totalExpense"]) || array_key_exists("totalExpense", $context) ? $context["totalExpense"] : (function () { throw new RuntimeError('Variable "totalExpense" does not exist.', 25, $this->source); })()), 0, ".", " "), "html", null, true);
        yield " €</p>
        </div>
        <div class=\"rounded-xl border border-border bg-card p-5\">
            <p class=\"text-sm font-medium text-muted-foreground\">Solde</p>
            <p class=\"text-2xl font-bold ";
        // line 29
        yield ((((isset($context["balance"]) || array_key_exists("balance", $context) ? $context["balance"] : (function () { throw new RuntimeError('Variable "balance" does not exist.', 29, $this->source); })()) >= 0)) ? ("text-[hsl(var(--success))]") : ("text-destructive"));
        yield "\">";
        yield ((((isset($context["balance"]) || array_key_exists("balance", $context) ? $context["balance"] : (function () { throw new RuntimeError('Variable "balance" does not exist.', 29, $this->source); })()) >= 0)) ? ("+") : (""));
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["balance"]) || array_key_exists("balance", $context) ? $context["balance"] : (function () { throw new RuntimeError('Variable "balance" does not exist.', 29, $this->source); })()), 0, ".", " "), "html", null, true);
        yield " €</p>
        </div>
    </div>

    ";
        // line 34
        yield "    <div class=\"flex flex-col gap-3\">
        ";
        // line 35
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["transactions"]) || array_key_exists("transactions", $context) ? $context["transactions"] : (function () { throw new RuntimeError('Variable "transactions" does not exist.', 35, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["transaction"]) {
            // line 36
            yield "            <div class=\"flex items-center justify-between rounded-xl border border-border bg-card px-5 py-4 transition-colors hover:bg-secondary/30\">
                <div class=\"flex items-center gap-4\">
                    <div class=\"p-2 rounded-lg ";
            // line 38
            yield (((CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "type", [], "any", false, false, false, 38) == "income")) ? ("bg-[hsl(var(--success))]/10 text-[hsl(var(--success))]") : ("bg-destructive/10 text-destructive"));
            yield "\">
                        ";
            // line 39
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "type", [], "any", false, false, false, 39) == "income")) {
                // line 40
                yield "                            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-5 w-5\"><polyline points=\"23 6 13.5 15.5 8.5 10.5 1 18\"/><polyline points=\"17 6 23 6 23 12\"/></svg>
                        ";
            } else {
                // line 42
                yield "                            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-5 w-5\"><polyline points=\"23 18 13.5 8.5 8.5 13.5 1 6\"/><polyline points=\"17 18 23 18 23 12\"/></svg>
                        ";
            }
            // line 44
            yield "                    </div>
                    <div>
                        <p class=\"text-sm font-medium text-card-foreground\">";
            // line 46
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "title", [], "any", false, false, false, 46), "html", null, true);
            yield "</p>
                        <p class=\"text-xs text-muted-foreground\">";
            // line 47
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "date", [], "any", false, false, false, 47), "d/m/Y"), "html", null, true);
            yield " • ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "category", [], "any", false, false, false, 47), "html", null, true);
            yield "</p>
                    </div>
                </div>
                
                <div class=\"flex items-center gap-4\">
                    <span class=\"text-sm font-bold ";
            // line 52
            yield (((CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "type", [], "any", false, false, false, 52) == "income")) ? ("text-[hsl(var(--success))]") : ("text-destructive"));
            yield "\">
                        ";
            // line 53
            yield (((CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "type", [], "any", false, false, false, 53) == "income")) ? ("+") : ("-"));
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "amount", [], "any", false, false, false, 53), 0, ".", " "), "html", null, true);
            yield " €
                    </span>
                    <div class=\"flex items-center gap-1\">
                        <a href=\"";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_finances_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "id", [], "any", false, false, false, 56)]), "html", null, true);
            yield "\" class=\"rounded-lg p-2 text-muted-foreground hover:bg-secondary hover:text-foreground\">
                            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-4 w-4\"><path d=\"M12 20h9\"/><path d=\"M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z\"/></svg>
                        </a>
                        <form method=\"post\" action=\"";
            // line 59
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_finances_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "id", [], "any", false, false, false, 59)]), "html", null, true);
            yield "\" onsubmit=\"return confirm('Êtes-vous sûr ?');\">
                            <input type=\"hidden\" name=\"_token\" value=\"";
            // line 60
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["transaction"], "id", [], "any", false, false, false, 60))), "html", null, true);
            yield "\">
                            <button class=\"rounded-lg p-2 text-muted-foreground hover:bg-destructive/10 hover:text-destructive\">
                                <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-4 w-4\"><path d=\"M3 6h18\"/><path d=\"M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6\"/><path d=\"M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2\"/><line x1=\"10\" x2=\"10\" y1=\"11\" y2=\"17\"/><line x1=\"14\" x2=\"14\" y1=\"11\" y2=\"17\"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        ";
            $context['_iterated'] = true;
        }
        // line 68
        if (!$context['_iterated']) {
            // line 69
            yield "            <div class=\"py-12 text-center text-muted-foreground\">
                Aucune transaction enregistrée.
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['transaction'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 73
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
        return "other/transaction/index.html.twig";
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
        return array (  234 => 73,  225 => 69,  223 => 68,  210 => 60,  206 => 59,  200 => 56,  193 => 53,  189 => 52,  179 => 47,  175 => 46,  171 => 44,  167 => 42,  163 => 40,  161 => 39,  157 => 38,  153 => 36,  148 => 35,  145 => 34,  135 => 29,  128 => 25,  121 => 21,  116 => 18,  107 => 11,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Finances - LifeOps{% endblock %}

{% block body %}
    <div class=\"mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between\">
        <div>
            <h1 class=\"text-3xl font-bold tracking-tight text-foreground\">Finances</h1>
            <p class=\"mt-1 text-muted-foreground\">Suivez vos revenus et dépenses</p>
        </div>
        <a href=\"{{ path('app_finances_new') }}\" class=\"flex items-center gap-2 rounded-lg bg-primary px-4 py-2.5 text-sm font-medium text-primary-foreground transition-colors hover:bg-primary/90\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-4 w-4\"><path d=\"M5 12h14\"/><path d=\"M12 5v14\"/></svg>
            Nouvelle transaction
        </a>
    </div>

    {# Summary Cards #}
    <div class=\"grid grid-cols-1 gap-4 sm:grid-cols-3 mb-8\">
        <div class=\"rounded-xl border border-border bg-card p-5\">
            <p class=\"text-sm font-medium text-muted-foreground\">Revenus totaux</p>
            <p class=\"text-2xl font-bold text-[hsl(var(--success))]\">+{{ totalIncome|number_format(0, '.', ' ') }} €</p>
        </div>
        <div class=\"rounded-xl border border-border bg-card p-5\">
            <p class=\"text-sm font-medium text-muted-foreground\">Dépenses totales</p>
            <p class=\"text-2xl font-bold text-destructive\">-{{ totalExpense|number_format(0, '.', ' ') }} €</p>
        </div>
        <div class=\"rounded-xl border border-border bg-card p-5\">
            <p class=\"text-sm font-medium text-muted-foreground\">Solde</p>
            <p class=\"text-2xl font-bold {{ balance >= 0 ? 'text-[hsl(var(--success))]' : 'text-destructive' }}\">{{ balance >= 0 ? '+' : '' }}{{ balance|number_format(0, '.', ' ') }} €</p>
        </div>
    </div>

    {# Transaction List #}
    <div class=\"flex flex-col gap-3\">
        {% for transaction in transactions %}
            <div class=\"flex items-center justify-between rounded-xl border border-border bg-card px-5 py-4 transition-colors hover:bg-secondary/30\">
                <div class=\"flex items-center gap-4\">
                    <div class=\"p-2 rounded-lg {{ transaction.type == 'income' ? 'bg-[hsl(var(--success))]/10 text-[hsl(var(--success))]' : 'bg-destructive/10 text-destructive' }}\">
                        {% if transaction.type == 'income' %}
                            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-5 w-5\"><polyline points=\"23 6 13.5 15.5 8.5 10.5 1 18\"/><polyline points=\"17 6 23 6 23 12\"/></svg>
                        {% else %}
                            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-5 w-5\"><polyline points=\"23 18 13.5 8.5 8.5 13.5 1 6\"/><polyline points=\"17 18 23 18 23 12\"/></svg>
                        {% endif %}
                    </div>
                    <div>
                        <p class=\"text-sm font-medium text-card-foreground\">{{ transaction.title }}</p>
                        <p class=\"text-xs text-muted-foreground\">{{ transaction.date|date('d/m/Y') }} • {{ transaction.category }}</p>
                    </div>
                </div>
                
                <div class=\"flex items-center gap-4\">
                    <span class=\"text-sm font-bold {{ transaction.type == 'income' ? 'text-[hsl(var(--success))]' : 'text-destructive' }}\">
                        {{ transaction.type == 'income' ? '+' : '-' }}{{ transaction.amount|number_format(0, '.', ' ') }} €
                    </span>
                    <div class=\"flex items-center gap-1\">
                        <a href=\"{{ path('app_finances_edit', {id: transaction.id}) }}\" class=\"rounded-lg p-2 text-muted-foreground hover:bg-secondary hover:text-foreground\">
                            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-4 w-4\"><path d=\"M12 20h9\"/><path d=\"M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z\"/></svg>
                        </a>
                        <form method=\"post\" action=\"{{ path('app_finances_delete', {'id': transaction.id}) }}\" onsubmit=\"return confirm('Êtes-vous sûr ?');\">
                            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ transaction.id) }}\">
                            <button class=\"rounded-lg p-2 text-muted-foreground hover:bg-destructive/10 hover:text-destructive\">
                                <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-4 w-4\"><path d=\"M3 6h18\"/><path d=\"M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6\"/><path d=\"M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2\"/><line x1=\"10\" x2=\"10\" y1=\"11\" y2=\"17\"/><line x1=\"14\" x2=\"14\" y1=\"11\" y2=\"17\"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        {% else %}
            <div class=\"py-12 text-center text-muted-foreground\">
                Aucune transaction enregistrée.
            </div>
        {% endfor %}
    </div>
{% endblock %}
", "other/transaction/index.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\other\\transaction\\index.html.twig");
    }
}
