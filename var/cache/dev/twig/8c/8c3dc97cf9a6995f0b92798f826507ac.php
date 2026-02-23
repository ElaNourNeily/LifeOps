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

/* admin/module/list_feedbacks.html.twig */
class __TwigTemplate_cc538d37abe2fd3d56b6e9ca1c8d16bc extends Template
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
        return "admin/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/module/list_feedbacks.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/module/list_feedbacks.html.twig"));

        $this->parent = $this->load("admin/base.html.twig", 1);
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

        yield "Gestion des Feedbacks";
        
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
        yield "<div class=\"flex flex-col gap-8\">
    <div>
        <h1 class=\"text-2xl font-bold text-card-foreground\">Feedbacks</h1>
        <p class=\"text-sm text-muted-foreground\">Retours des utilisateurs du Front Office</p>
    </div>

    <div class=\"rounded-lg border border-border bg-card shadow-sm overflow-hidden\">
        <div class=\"overflow-x-auto\">
            <table class=\"w-full text-left text-sm\">
                <thead class=\"bg-secondary/50 text-muted-foreground\">
                    <tr>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Utilisateur</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Message</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Date</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Actions</th>
                    </tr>
                </thead>
                <tbody class=\"divide-y divide-border\">
                    ";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["feedbacks"]) || array_key_exists("feedbacks", $context) ? $context["feedbacks"] : (function () { throw new RuntimeError('Variable "feedbacks" does not exist.', 24, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["feedback"]) {
            // line 25
            yield "                        <tr class=\"hover:bg-secondary/30 transition-colors\">
                            <td class=\"px-6 py-4\">
                                <span class=\"font-medium text-card-foreground\">
                                    ";
            // line 28
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["feedback"], "utilisateur", [], "any", false, false, false, 28)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["feedback"], "utilisateur", [], "any", false, false, false, 28), "nom", [], "any", false, false, false, 28) . " ") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["feedback"], "utilisateur", [], "any", false, false, false, 28), "prenom", [], "any", false, false, false, 28)), "html", null, true)) : ("Anonyme"));
            yield "
                                </span>
                            </td>
                            <td class=\"px-6 py-4 text-muted-foreground max-w-md truncate\">";
            // line 31
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["feedback"], "message", [], "any", false, false, false, 31), "html", null, true);
            yield "</td>
                            <td class=\"px-6 py-4 text-muted-foreground text-xs\">
                                ";
            // line 33
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["feedback"], "created_at", [], "any", false, false, false, 33)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["feedback"], "created_at", [], "any", false, false, false, 33), "d/m/Y H:i"), "html", null, true)) : ("N/A"));
            yield "
                            </td>
                            <td class=\"px-6 py-4\">
                                <button class=\"text-primary hover:text-primary/80 transition-colors\">Détails</button>
                            </td>
                        </tr>
                    ";
            $context['_iterated'] = true;
        }
        // line 39
        if (!$context['_iterated']) {
            // line 40
            yield "                        <tr>
                            <td colspan=\"4\" class=\"px-6 py-8 text-center text-muted-foreground\">Aucun feedback trouvé.</td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['feedback'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        yield "                </tbody>
            </table>
        </div>
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
        return "admin/module/list_feedbacks.html.twig";
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
        return array (  163 => 44,  154 => 40,  152 => 39,  141 => 33,  136 => 31,  130 => 28,  125 => 25,  120 => 24,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'admin/base.html.twig' %}

{% block title %}Gestion des Feedbacks{% endblock %}

{% block body %}
<div class=\"flex flex-col gap-8\">
    <div>
        <h1 class=\"text-2xl font-bold text-card-foreground\">Feedbacks</h1>
        <p class=\"text-sm text-muted-foreground\">Retours des utilisateurs du Front Office</p>
    </div>

    <div class=\"rounded-lg border border-border bg-card shadow-sm overflow-hidden\">
        <div class=\"overflow-x-auto\">
            <table class=\"w-full text-left text-sm\">
                <thead class=\"bg-secondary/50 text-muted-foreground\">
                    <tr>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Utilisateur</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Message</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Date</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Actions</th>
                    </tr>
                </thead>
                <tbody class=\"divide-y divide-border\">
                    {% for feedback in feedbacks %}
                        <tr class=\"hover:bg-secondary/30 transition-colors\">
                            <td class=\"px-6 py-4\">
                                <span class=\"font-medium text-card-foreground\">
                                    {{ feedback.utilisateur ? feedback.utilisateur.nom ~ ' ' ~ feedback.utilisateur.prenom : 'Anonyme' }}
                                </span>
                            </td>
                            <td class=\"px-6 py-4 text-muted-foreground max-w-md truncate\">{{ feedback.message }}</td>
                            <td class=\"px-6 py-4 text-muted-foreground text-xs\">
                                {{ feedback.created_at ? feedback.created_at|date('d/m/Y H:i') : 'N/A' }}
                            </td>
                            <td class=\"px-6 py-4\">
                                <button class=\"text-primary hover:text-primary/80 transition-colors\">Détails</button>
                            </td>
                        </tr>
                    {% else %}
                        <tr>
                            <td colspan=\"4\" class=\"px-6 py-8 text-center text-muted-foreground\">Aucun feedback trouvé.</td>
                        </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>
{% endblock %}
", "admin/module/list_feedbacks.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\admin\\module\\list_feedbacks.html.twig");
    }
}
