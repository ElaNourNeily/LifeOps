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

/* user/profile/change_password.html.twig */
class __TwigTemplate_fe7a5d02576acede6b9c0af0b08a27ea extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "user/profile/change_password.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "user/profile/change_password.html.twig"));

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

        yield "Changer le mot de passe";
        
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
        yield "    <div class=\"max-w-2xl mx-auto\">
        <div class=\"flex items-center gap-4 mb-8\">
            <a href=\"";
        // line 8
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile_edit");
        yield "\" class=\"text-muted-foreground hover:text-foreground\">
                <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-6 w-6\"><path d=\"m15 18-6-6 6-6\"/></svg>
            </a>
            <h1 class=\"text-3xl font-bold text-foreground\">Changer le mot de passe</h1>
        </div>
        
        ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 14, $this->source); })()), "flashes", ["success"], "method", false, false, false, 14));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 15
            yield "            <div class=\"p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400\" role=\"alert\">
                <span class=\"font-medium\">Succès!</span> ";
            // line 16
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        yield "
        <div class=\"bg-card text-card-foreground rounded-lg border border-border shadow-sm p-6\">
            ";
        // line 21
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 21, $this->source); })()), 'form_start', ["attr" => ["class" => "space-y-6"]]);
        yield "
                
                ";
        // line 23
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "currentPassword", [], "any", true, true, false, 23)) {
            // line 24
            yield "                <div>
                    ";
            // line 25
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 25, $this->source); })()), "currentPassword", [], "any", false, false, false, 25), 'label', ["label_attr" => ["class" => "block text-sm font-medium mb-2 text-foreground"], "label" => "Mot de passe actuel"]);
            yield "
                    ";
            // line 26
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 26, $this->source); })()), "currentPassword", [], "any", false, false, false, 26), 'widget', ["attr" => ["class" => "w-full px-3 py-2 border border-input bg-background rounded-lg focus:ring-2 focus:ring-ring focus:border-input"]]);
            yield "
                    ";
            // line 27
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 27, $this->source); })()), "currentPassword", [], "any", false, false, false, 27), 'errors', ["attr" => ["class" => "text-destructive text-sm mt-1"]]);
            yield "
                </div>
                ";
        }
        // line 30
        yield "
                <div>
                    ";
        // line 32
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 32, $this->source); })()), "newPassword", [], "any", false, false, false, 32), "first", [], "any", false, false, false, 32), 'label', ["label_attr" => ["class" => "block text-sm font-medium mb-2 text-foreground"], "label" => "Nouveau mot de passe"]);
        yield "
                    ";
        // line 33
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 33, $this->source); })()), "newPassword", [], "any", false, false, false, 33), "first", [], "any", false, false, false, 33), 'widget', ["attr" => ["class" => "w-full px-3 py-2 border border-input bg-background rounded-lg focus:ring-2 focus:ring-ring focus:border-input"]]);
        yield "
                    ";
        // line 34
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 34, $this->source); })()), "newPassword", [], "any", false, false, false, 34), "first", [], "any", false, false, false, 34), 'errors', ["attr" => ["class" => "text-destructive text-sm mt-1"]]);
        yield "
                </div>

                <div>
                    ";
        // line 38
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 38, $this->source); })()), "newPassword", [], "any", false, false, false, 38), "second", [], "any", false, false, false, 38), 'label', ["label_attr" => ["class" => "block text-sm font-medium mb-2 text-foreground"], "label" => "Confirmer le mot de passe"]);
        yield "
                    ";
        // line 39
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 39, $this->source); })()), "newPassword", [], "any", false, false, false, 39), "second", [], "any", false, false, false, 39), 'widget', ["attr" => ["class" => "w-full px-3 py-2 border border-input bg-background rounded-lg focus:ring-2 focus:ring-ring focus:border-input"]]);
        yield "
                    ";
        // line 40
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 40, $this->source); })()), "newPassword", [], "any", false, false, false, 40), "second", [], "any", false, false, false, 40), 'errors', ["attr" => ["class" => "text-destructive text-sm mt-1"]]);
        yield "
                </div>

                <div class=\"flex items-center gap-4 pt-4\">
                    <button type=\"submit\" class=\"bg-primary text-primary-foreground hover:bg-primary/90 px-4 py-2 rounded-lg font-medium transition-colors\">
                        Mettre à jour le mot de passe
                    </button>
                    <a href=\"";
        // line 47
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile_edit");
        yield "\" class=\"text-sm font-medium text-muted-foreground hover:text-foreground\">
                        Annuler
                    </a>
                </div>

            ";
        // line 52
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 52, $this->source); })()), 'form_end');
        yield "
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
        return "user/profile/change_password.html.twig";
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
        return array (  202 => 52,  194 => 47,  184 => 40,  180 => 39,  176 => 38,  169 => 34,  165 => 33,  161 => 32,  157 => 30,  151 => 27,  147 => 26,  143 => 25,  140 => 24,  138 => 23,  133 => 21,  129 => 19,  120 => 16,  117 => 15,  113 => 14,  104 => 8,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Changer le mot de passe{% endblock %}

{% block body %}
    <div class=\"max-w-2xl mx-auto\">
        <div class=\"flex items-center gap-4 mb-8\">
            <a href=\"{{ path('app_profile_edit') }}\" class=\"text-muted-foreground hover:text-foreground\">
                <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-6 w-6\"><path d=\"m15 18-6-6 6-6\"/></svg>
            </a>
            <h1 class=\"text-3xl font-bold text-foreground\">Changer le mot de passe</h1>
        </div>
        
        {% for message in app.flashes('success') %}
            <div class=\"p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400\" role=\"alert\">
                <span class=\"font-medium\">Succès!</span> {{ message }}
            </div>
        {% endfor %}

        <div class=\"bg-card text-card-foreground rounded-lg border border-border shadow-sm p-6\">
            {{ form_start(form, {'attr': {'class': 'space-y-6'}}) }}
                
                {% if form.currentPassword is defined %}
                <div>
                    {{ form_label(form.currentPassword, 'Mot de passe actuel', {'label_attr': {'class': 'block text-sm font-medium mb-2 text-foreground'}}) }}
                    {{ form_widget(form.currentPassword, {'attr': {'class': 'w-full px-3 py-2 border border-input bg-background rounded-lg focus:ring-2 focus:ring-ring focus:border-input'}}) }}
                    {{ form_errors(form.currentPassword, {'attr': {'class': 'text-destructive text-sm mt-1'}}) }}
                </div>
                {% endif %}

                <div>
                    {{ form_label(form.newPassword.first, 'Nouveau mot de passe', {'label_attr': {'class': 'block text-sm font-medium mb-2 text-foreground'}}) }}
                    {{ form_widget(form.newPassword.first, {'attr': {'class': 'w-full px-3 py-2 border border-input bg-background rounded-lg focus:ring-2 focus:ring-ring focus:border-input'}}) }}
                    {{ form_errors(form.newPassword.first, {'attr': {'class': 'text-destructive text-sm mt-1'}}) }}
                </div>

                <div>
                    {{ form_label(form.newPassword.second, 'Confirmer le mot de passe', {'label_attr': {'class': 'block text-sm font-medium mb-2 text-foreground'}}) }}
                    {{ form_widget(form.newPassword.second, {'attr': {'class': 'w-full px-3 py-2 border border-input bg-background rounded-lg focus:ring-2 focus:ring-ring focus:border-input'}}) }}
                    {{ form_errors(form.newPassword.second, {'attr': {'class': 'text-destructive text-sm mt-1'}}) }}
                </div>

                <div class=\"flex items-center gap-4 pt-4\">
                    <button type=\"submit\" class=\"bg-primary text-primary-foreground hover:bg-primary/90 px-4 py-2 rounded-lg font-medium transition-colors\">
                        Mettre à jour le mot de passe
                    </button>
                    <a href=\"{{ path('app_profile_edit') }}\" class=\"text-sm font-medium text-muted-foreground hover:text-foreground\">
                        Annuler
                    </a>
                </div>

            {{ form_end(form) }}
        </div>
    </div>
{% endblock %}
", "user/profile/change_password.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\user\\profile\\change_password.html.twig");
    }
}
