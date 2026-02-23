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

/* user/profile/edit.html.twig */
class __TwigTemplate_99e2f593aeec6027ef9c4f028a250e6e extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "user/profile/edit.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "user/profile/edit.html.twig"));

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

        yield "Mon Profil";
        
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
        <h1 class=\"text-3xl font-bold mb-8 text-foreground\">Mon Profil</h1>
        
        ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 9, $this->source); })()), "flashes", ["success"], "method", false, false, false, 9));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 10
            yield "            <div class=\"p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400\" role=\"alert\">
                <span class=\"font-medium\">Succès!</span> ";
            // line 11
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 14
        yield "
        <div class=\"bg-card text-card-foreground rounded-lg border border-border shadow-sm p-6\">
            ";
        // line 16
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 16, $this->source); })()), 'form_start', ["attr" => ["class" => "space-y-6", "enctype" => "multipart/form-data"]]);
        yield "
                
                <div class=\"flex flex-col items-center mb-6\">
                    <div class=\"relative group\">
                        ";
        // line 20
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 20, $this->source); })()), "user", [], "any", false, false, false, 20), "photo", [], "any", false, false, false, 20)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 21
            yield "                            <img id=\"preview-image\" src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/profile_pictures/" . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 21, $this->source); })()), "user", [], "any", false, false, false, 21), "photo", [], "any", false, false, false, 21))), "html", null, true);
            yield "\" alt=\"Photo de profil\" class=\"w-24 h-24 rounded-full object-cover border-4 border-primary/20 group-hover:border-primary/40 transition-all\">
                        ";
        } else {
            // line 23
            yield "                            <div id=\"preview-placeholder\" class=\"w-24 h-24 rounded-full bg-muted flex items-center justify-center border-4 border-primary/10\">
                                <span class=\"text-3xl font-bold text-muted-foreground\">";
            // line 24
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 24, $this->source); })()), "user", [], "any", false, false, false, 24), "prenom", [], "any", false, false, false, 24))), "html", null, true);
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 24, $this->source); })()), "user", [], "any", false, false, false, 24), "nom", [], "any", false, false, false, 24))), "html", null, true);
            yield "</span>
                            </div>
                            <img id=\"preview-image\" src=\"\" alt=\"Photo de profil\" class=\"w-24 h-24 rounded-full object-cover border-4 border-primary/20 transition-all hidden\">
                        ";
        }
        // line 28
        yield "                    </div>
                    <div class=\"mt-4 w-full\">
                        ";
        // line 30
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 30, $this->source); })()), "photo", [], "any", false, false, false, 30), 'label', ["label_attr" => ["class" => "block text-sm font-medium mb-2 text-foreground"], "label" => "Changer la photo de profil"]);
        yield "
                        ";
        // line 31
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 31, $this->source); })()), "photo", [], "any", false, false, false, 31), 'widget', ["attr" => ["onchange" => "previewFile()", "id" => "photo-input"]]);
        yield "
                        ";
        // line 32
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 32, $this->source); })()), "photo", [], "any", false, false, false, 32), 'errors', ["attr" => ["class" => "text-destructive text-sm mt-1"]]);
        yield "
                    </div>
                </div>

                <div class=\"grid grid-cols-1 md:grid-cols-2 gap-6\">
                    <div>
                        ";
        // line 38
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 38, $this->source); })()), "nom", [], "any", false, false, false, 38), 'label', ["label_attr" => ["class" => "block text-sm font-medium mb-2 text-foreground"], "label" => "Nom"]);
        yield "
                        ";
        // line 39
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 39, $this->source); })()), "nom", [], "any", false, false, false, 39), 'widget', ["attr" => ["class" => "w-full px-3 py-2 border border-input bg-background rounded-lg focus:ring-2 focus:ring-ring focus:border-input"]]);
        yield "
                        ";
        // line 40
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 40, $this->source); })()), "nom", [], "any", false, false, false, 40), 'errors', ["attr" => ["class" => "text-destructive text-sm mt-1"]]);
        yield "
                    </div>

                    <div>
                        ";
        // line 44
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 44, $this->source); })()), "prenom", [], "any", false, false, false, 44), 'label', ["label_attr" => ["class" => "block text-sm font-medium mb-2 text-foreground"], "label" => "Prénom"]);
        yield "
                        ";
        // line 45
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 45, $this->source); })()), "prenom", [], "any", false, false, false, 45), 'widget', ["attr" => ["class" => "w-full px-3 py-2 border border-input bg-background rounded-lg focus:ring-2 focus:ring-ring focus:border-input"]]);
        yield "
                        ";
        // line 46
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 46, $this->source); })()), "prenom", [], "any", false, false, false, 46), 'errors', ["attr" => ["class" => "text-destructive text-sm mt-1"]]);
        yield "
                    </div>
                </div>

                <div class=\"grid grid-cols-1 md:grid-cols-2 gap-6\">
                    <div>
                        ";
        // line 52
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 52, $this->source); })()), "age", [], "any", false, false, false, 52), 'label', ["label_attr" => ["class" => "block text-sm font-medium mb-2 text-foreground"], "label" => "Âge"]);
        yield "
                        ";
        // line 53
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 53, $this->source); })()), "age", [], "any", false, false, false, 53), 'widget', ["attr" => ["class" => "w-full px-3 py-2 border border-input bg-background rounded-lg focus:ring-2 focus:ring-ring focus:border-input"]]);
        yield "
                        ";
        // line 54
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 54, $this->source); })()), "age", [], "any", false, false, false, 54), 'errors', ["attr" => ["class" => "text-destructive text-sm mt-1"]]);
        yield "
                    </div>

                    <div>
                        ";
        // line 58
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 58, $this->source); })()), "telephone", [], "any", false, false, false, 58), 'label', ["label_attr" => ["class" => "block text-sm font-medium mb-2 text-foreground"], "label" => "Téléphone"]);
        yield "
                        ";
        // line 59
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 59, $this->source); })()), "telephone", [], "any", false, false, false, 59), 'widget', ["attr" => ["class" => "w-full px-3 py-2 border border-input bg-background rounded-lg focus:ring-2 focus:ring-ring focus:border-input"]]);
        yield "
                        ";
        // line 60
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 60, $this->source); })()), "telephone", [], "any", false, false, false, 60), 'errors', ["attr" => ["class" => "text-destructive text-sm mt-1"]]);
        yield "
                    </div>
                </div>

                <div class=\"flex items-center gap-4 pt-4\">
                    <button type=\"submit\" class=\"bg-primary text-primary-foreground hover:bg-primary/90 px-4 py-2 rounded-lg font-medium transition-colors\">
                        Enregistrer
                    </button>
                    <a href=\"";
        // line 68
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile_change_password");
        yield "\" class=\"text-sm font-medium text-muted-foreground hover:text-foreground underline\">
                        Changer le mot de passe
                    </a>
                </div>

            ";
        // line 73
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 73, $this->source); })()), 'form_end');
        yield "
        </div>
    </div>

    <script>
        function previewFile() {
            const preview = document.getElementById('preview-image');
            const placeholder = document.getElementById('preview-placeholder');
            const file = document.getElementById('photo-input').files[0];
            const reader = new FileReader();

            reader.addEventListener(\"load\", function () {
                // Convert image file to base64 string
                preview.src = reader.result;
                preview.classList.remove('hidden');
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
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
        return "user/profile/edit.html.twig";
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
        return array (  246 => 73,  238 => 68,  227 => 60,  223 => 59,  219 => 58,  212 => 54,  208 => 53,  204 => 52,  195 => 46,  191 => 45,  187 => 44,  180 => 40,  176 => 39,  172 => 38,  163 => 32,  159 => 31,  155 => 30,  151 => 28,  143 => 24,  140 => 23,  134 => 21,  132 => 20,  125 => 16,  121 => 14,  112 => 11,  109 => 10,  105 => 9,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Mon Profil{% endblock %}

{% block body %}
    <div class=\"max-w-2xl mx-auto\">
        <h1 class=\"text-3xl font-bold mb-8 text-foreground\">Mon Profil</h1>
        
        {% for message in app.flashes('success') %}
            <div class=\"p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400\" role=\"alert\">
                <span class=\"font-medium\">Succès!</span> {{ message }}
            </div>
        {% endfor %}

        <div class=\"bg-card text-card-foreground rounded-lg border border-border shadow-sm p-6\">
            {{ form_start(form, {'attr': {'class': 'space-y-6', 'enctype': 'multipart/form-data'}}) }}
                
                <div class=\"flex flex-col items-center mb-6\">
                    <div class=\"relative group\">
                        {% if app.user.photo %}
                            <img id=\"preview-image\" src=\"{{ asset('uploads/profile_pictures/' ~ app.user.photo) }}\" alt=\"Photo de profil\" class=\"w-24 h-24 rounded-full object-cover border-4 border-primary/20 group-hover:border-primary/40 transition-all\">
                        {% else %}
                            <div id=\"preview-placeholder\" class=\"w-24 h-24 rounded-full bg-muted flex items-center justify-center border-4 border-primary/10\">
                                <span class=\"text-3xl font-bold text-muted-foreground\">{{ app.user.prenom|first|upper }}{{ app.user.nom|first|upper }}</span>
                            </div>
                            <img id=\"preview-image\" src=\"\" alt=\"Photo de profil\" class=\"w-24 h-24 rounded-full object-cover border-4 border-primary/20 transition-all hidden\">
                        {% endif %}
                    </div>
                    <div class=\"mt-4 w-full\">
                        {{ form_label(form.photo, 'Changer la photo de profil', {'label_attr': {'class': 'block text-sm font-medium mb-2 text-foreground'}}) }}
                        {{ form_widget(form.photo, {'attr': {'onchange': 'previewFile()', 'id': 'photo-input'}}) }}
                        {{ form_errors(form.photo, {'attr': {'class': 'text-destructive text-sm mt-1'}}) }}
                    </div>
                </div>

                <div class=\"grid grid-cols-1 md:grid-cols-2 gap-6\">
                    <div>
                        {{ form_label(form.nom, 'Nom', {'label_attr': {'class': 'block text-sm font-medium mb-2 text-foreground'}}) }}
                        {{ form_widget(form.nom, {'attr': {'class': 'w-full px-3 py-2 border border-input bg-background rounded-lg focus:ring-2 focus:ring-ring focus:border-input'}}) }}
                        {{ form_errors(form.nom, {'attr': {'class': 'text-destructive text-sm mt-1'}}) }}
                    </div>

                    <div>
                        {{ form_label(form.prenom, 'Prénom', {'label_attr': {'class': 'block text-sm font-medium mb-2 text-foreground'}}) }}
                        {{ form_widget(form.prenom, {'attr': {'class': 'w-full px-3 py-2 border border-input bg-background rounded-lg focus:ring-2 focus:ring-ring focus:border-input'}}) }}
                        {{ form_errors(form.prenom, {'attr': {'class': 'text-destructive text-sm mt-1'}}) }}
                    </div>
                </div>

                <div class=\"grid grid-cols-1 md:grid-cols-2 gap-6\">
                    <div>
                        {{ form_label(form.age, 'Âge', {'label_attr': {'class': 'block text-sm font-medium mb-2 text-foreground'}}) }}
                        {{ form_widget(form.age, {'attr': {'class': 'w-full px-3 py-2 border border-input bg-background rounded-lg focus:ring-2 focus:ring-ring focus:border-input'}}) }}
                        {{ form_errors(form.age, {'attr': {'class': 'text-destructive text-sm mt-1'}}) }}
                    </div>

                    <div>
                        {{ form_label(form.telephone, 'Téléphone', {'label_attr': {'class': 'block text-sm font-medium mb-2 text-foreground'}}) }}
                        {{ form_widget(form.telephone, {'attr': {'class': 'w-full px-3 py-2 border border-input bg-background rounded-lg focus:ring-2 focus:ring-ring focus:border-input'}}) }}
                        {{ form_errors(form.telephone, {'attr': {'class': 'text-destructive text-sm mt-1'}}) }}
                    </div>
                </div>

                <div class=\"flex items-center gap-4 pt-4\">
                    <button type=\"submit\" class=\"bg-primary text-primary-foreground hover:bg-primary/90 px-4 py-2 rounded-lg font-medium transition-colors\">
                        Enregistrer
                    </button>
                    <a href=\"{{ path('app_profile_change_password') }}\" class=\"text-sm font-medium text-muted-foreground hover:text-foreground underline\">
                        Changer le mot de passe
                    </a>
                </div>

            {{ form_end(form) }}
        </div>
    </div>

    <script>
        function previewFile() {
            const preview = document.getElementById('preview-image');
            const placeholder = document.getElementById('preview-placeholder');
            const file = document.getElementById('photo-input').files[0];
            const reader = new FileReader();

            reader.addEventListener(\"load\", function () {
                // Convert image file to base64 string
                preview.src = reader.result;
                preview.classList.remove('hidden');
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
{% endblock %}
", "user/profile/edit.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\user\\profile\\edit.html.twig");
    }
}
