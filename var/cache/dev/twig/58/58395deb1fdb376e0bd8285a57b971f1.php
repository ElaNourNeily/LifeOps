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

/* user/security/login.html.twig */
class __TwigTemplate_9e2b654c835e2777c05869b8bfd910bc extends Template
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
        return "base_public.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "user/security/login.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "user/security/login.html.twig"));

        $this->parent = $this->load("base_public.html.twig", 1);
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

        yield "Connexion - LifeOps";
        
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
        yield "<div class=\"flex items-center justify-center min-h-[calc(100vh-4rem)]\">
    <div class=\"w-full max-w-md p-8 space-y-8 bg-card rounded-xl border border-border shadow-lg\">
        <div class=\"text-center\">
            <div class=\"flex justify-center mb-4\">
                <img src=\"";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("logo.jpeg"), "html", null, true);
        yield "\" alt=\"LifeOps Logo\" style=\"width: 56px; height: 56px; object-fit: contain;\">
            </div>
            <h1 class=\"text-3xl font-bold text-foreground\">Bienvenue</h1>
            <p class=\"mt-2 text-muted-foreground\">Connectez-vous à votre espace LifeOps</p>
        </div>

        <form method=\"post\" class=\"mt-8 space-y-6\">
            ";
        // line 17
        if ((($tmp = (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 17, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 18
            yield "                <div class=\"p-4 mb-4 text-sm text-red-500 rounded-lg bg-red-500/10 border border-red-500/20\" role=\"alert\">
                    ";
            // line 19
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 19, $this->source); })()), "messageKey", [], "any", false, false, false, 19), CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 19, $this->source); })()), "messageData", [], "any", false, false, false, 19), "security"), "html", null, true);
            yield "
                </div>
            ";
        }
        // line 22
        yield "
            ";
        // line 23
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 23, $this->source); })()), "user", [], "any", false, false, false, 23)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 24
            yield "                <div class=\"mb-3 text-muted-foreground\">
                    Vous êtes connecté en tant que <span class=\"font-semibold text-primary\">";
            // line 25
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 25, $this->source); })()), "user", [], "any", false, false, false, 25), "userIdentifier", [], "any", false, false, false, 25), "html", null, true);
            yield "</span>, <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            yield "\" class=\"text-primary hover:underline\">Déconnexion</a>
                </div>
            ";
        }
        // line 28
        yield "
            <div class=\"space-y-4\">
                <div>
                    <label for=\"username\" class=\"block text-sm font-medium text-foreground\">Email</label>
                    <input type=\"email\" value=\"";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["last_username"]) || array_key_exists("last_username", $context) ? $context["last_username"] : (function () { throw new RuntimeError('Variable "last_username" does not exist.', 32, $this->source); })()), "html", null, true);
        yield "\" name=\"_username\" id=\"username\" class=\"mt-1 block w-full px-3 py-2 bg-background border border-border rounded-md text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent\" autocomplete=\"email\" required autofocus placeholder=\"nom@exemple.com\">
                </div>
                <div>
                    <div class=\"flex items-center justify-between\">
                        <label for=\"password\" class=\"block text-sm font-medium text-foreground\">Mot de passe</label>
                        <a href=\"";
        // line 37
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forgot_password_request");
        yield "\" class=\"text-xs text-primary hover:underline\">Mot de passe oublié ?</a>
                    </div>
                    <div class=\"relative mt-1\">
                        <input type=\"password\" name=\"_password\" id=\"password\" class=\"block w-full px-3 py-2 pr-10 bg-background border border-border rounded-md text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent\" autocomplete=\"off\" required placeholder=\"••••••••\">
                        <button type=\"button\" onclick=\"togglePassword('password')\" class=\"absolute right-3 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground transition\">
                            <svg id=\"password-eye\" xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
                                <path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class=\"flex items-center\">
                <input type=\"checkbox\" name=\"_remember_me\" id=\"remember_me\" class=\"h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary cursor-pointer\">
                <label for=\"remember_me\" class=\"ml-2 block text-sm text-muted-foreground cursor-pointer hover:text-foreground transition\">Se souvenir de moi pendant 30 jours</label>
            </div>

            <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 55
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("authenticate"), "html", null, true);
        yield "\">

            <button type=\"submit\" class=\"w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-primary-foreground bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors\">
                Se connecter
            </button>
            
            <div class=\"relative py-4\">
                <div class=\"absolute inset-0 flex items-center\">
                    <span class=\"w-full border-t border-border\"></span>
                </div>
                <div class=\"relative flex justify-center text-xs uppercase\">
                    <span class=\"bg-card px-2 text-muted-foreground uppercase\">Ou continuer avec</span>
                </div>
            </div>

            <div class=\"grid grid-cols-3 gap-3\">
                <a href=\"";
        // line 71
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("connect_google_start");
        yield "\" class=\"flex items-center justify-center py-2 px-4 border border-border rounded-md bg-background hover:bg-muted transition-colors shadow-sm\" title=\"Google\">
                    <svg class=\"w-5 h-5\" viewBox=\"0 0 24 24\" xmlns=\"http://www.w3.org/2000/svg\">
                        <path d=\"M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z\" fill=\"#4285F4\"/><path d=\"M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z\" fill=\"#34A853\"/><path d=\"M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z\" fill=\"#FBBC05\"/><path d=\"M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z\" fill=\"#EA4335\"/>
                    </svg>
                </a>
                <a href=\"";
        // line 76
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("connect_facebook_start");
        yield "\" class=\"flex items-center justify-center py-2 px-4 border border-border rounded-md bg-background hover:bg-muted transition-colors shadow-sm\" title=\"Facebook\">
                    <svg class=\"w-5 h-5 text-[#1877F2]\" fill=\"currentColor\" viewBox=\"0 0 24 24\" xmlns=\"http://www.w3.org/2000/svg\">
                        <path d=\"M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z\"/>
                    </svg>
                </a>
                <a href=\"";
        // line 81
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("connect_github_start");
        yield "\" class=\"flex items-center justify-center py-2 px-4 border border-border rounded-md bg-background hover:bg-muted transition-colors shadow-sm\" title=\"GitHub\">
                    <svg class=\"w-5 h-5 text-foreground\" fill=\"currentColor\" viewBox=\"0 0 24 24\" xmlns=\"http://www.w3.org/2000/svg\">
                        <path d=\"M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12\"/>
                    </svg>
                </a>
            </div>

            <div class=\"text-center text-sm\">
                <span class=\"text-muted-foreground\">Pas encore de compte ?</span>
                <a href=\"";
        // line 90
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\" class=\"font-medium text-primary hover:text-primary/90 hover:underline\">S'inscrire</a>
            </div>
        </form>

        <script>
            function togglePassword(inputId) {
                const input = document.getElementById(inputId);
                const icon = document.getElementById(inputId + '-eye');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.innerHTML = '<path d=\"M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24\"/><line x1=\"1\" y1=\"1\" x2=\"23\" y2=\"23\"/>';
                } else {
                    input.type = 'password';
                    icon.innerHTML = '<path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/>';
                }
            }
        </script>
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
        return "user/security/login.html.twig";
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
        return array (  225 => 90,  213 => 81,  205 => 76,  197 => 71,  178 => 55,  157 => 37,  149 => 32,  143 => 28,  135 => 25,  132 => 24,  130 => 23,  127 => 22,  121 => 19,  118 => 18,  116 => 17,  106 => 10,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base_public.html.twig' %}

{% block title %}Connexion - LifeOps{% endblock %}

{% block body %}
<div class=\"flex items-center justify-center min-h-[calc(100vh-4rem)]\">
    <div class=\"w-full max-w-md p-8 space-y-8 bg-card rounded-xl border border-border shadow-lg\">
        <div class=\"text-center\">
            <div class=\"flex justify-center mb-4\">
                <img src=\"{{ asset('logo.jpeg') }}\" alt=\"LifeOps Logo\" style=\"width: 56px; height: 56px; object-fit: contain;\">
            </div>
            <h1 class=\"text-3xl font-bold text-foreground\">Bienvenue</h1>
            <p class=\"mt-2 text-muted-foreground\">Connectez-vous à votre espace LifeOps</p>
        </div>

        <form method=\"post\" class=\"mt-8 space-y-6\">
            {% if error %}
                <div class=\"p-4 mb-4 text-sm text-red-500 rounded-lg bg-red-500/10 border border-red-500/20\" role=\"alert\">
                    {{ error.messageKey|trans(error.messageData, 'security') }}
                </div>
            {% endif %}

            {% if app.user %}
                <div class=\"mb-3 text-muted-foreground\">
                    Vous êtes connecté en tant que <span class=\"font-semibold text-primary\">{{ app.user.userIdentifier }}</span>, <a href=\"{{ path('app_logout') }}\" class=\"text-primary hover:underline\">Déconnexion</a>
                </div>
            {% endif %}

            <div class=\"space-y-4\">
                <div>
                    <label for=\"username\" class=\"block text-sm font-medium text-foreground\">Email</label>
                    <input type=\"email\" value=\"{{ last_username }}\" name=\"_username\" id=\"username\" class=\"mt-1 block w-full px-3 py-2 bg-background border border-border rounded-md text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent\" autocomplete=\"email\" required autofocus placeholder=\"nom@exemple.com\">
                </div>
                <div>
                    <div class=\"flex items-center justify-between\">
                        <label for=\"password\" class=\"block text-sm font-medium text-foreground\">Mot de passe</label>
                        <a href=\"{{ path('app_forgot_password_request') }}\" class=\"text-xs text-primary hover:underline\">Mot de passe oublié ?</a>
                    </div>
                    <div class=\"relative mt-1\">
                        <input type=\"password\" name=\"_password\" id=\"password\" class=\"block w-full px-3 py-2 pr-10 bg-background border border-border rounded-md text-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent\" autocomplete=\"off\" required placeholder=\"••••••••\">
                        <button type=\"button\" onclick=\"togglePassword('password')\" class=\"absolute right-3 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground transition\">
                            <svg id=\"password-eye\" xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
                                <path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class=\"flex items-center\">
                <input type=\"checkbox\" name=\"_remember_me\" id=\"remember_me\" class=\"h-4 w-4 rounded border-border bg-background text-primary focus:ring-primary cursor-pointer\">
                <label for=\"remember_me\" class=\"ml-2 block text-sm text-muted-foreground cursor-pointer hover:text-foreground transition\">Se souvenir de moi pendant 30 jours</label>
            </div>

            <input type=\"hidden\" name=\"_csrf_token\" value=\"{{ csrf_token('authenticate') }}\">

            <button type=\"submit\" class=\"w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-primary-foreground bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors\">
                Se connecter
            </button>
            
            <div class=\"relative py-4\">
                <div class=\"absolute inset-0 flex items-center\">
                    <span class=\"w-full border-t border-border\"></span>
                </div>
                <div class=\"relative flex justify-center text-xs uppercase\">
                    <span class=\"bg-card px-2 text-muted-foreground uppercase\">Ou continuer avec</span>
                </div>
            </div>

            <div class=\"grid grid-cols-3 gap-3\">
                <a href=\"{{ path('connect_google_start') }}\" class=\"flex items-center justify-center py-2 px-4 border border-border rounded-md bg-background hover:bg-muted transition-colors shadow-sm\" title=\"Google\">
                    <svg class=\"w-5 h-5\" viewBox=\"0 0 24 24\" xmlns=\"http://www.w3.org/2000/svg\">
                        <path d=\"M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z\" fill=\"#4285F4\"/><path d=\"M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z\" fill=\"#34A853\"/><path d=\"M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z\" fill=\"#FBBC05\"/><path d=\"M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z\" fill=\"#EA4335\"/>
                    </svg>
                </a>
                <a href=\"{{ path('connect_facebook_start') }}\" class=\"flex items-center justify-center py-2 px-4 border border-border rounded-md bg-background hover:bg-muted transition-colors shadow-sm\" title=\"Facebook\">
                    <svg class=\"w-5 h-5 text-[#1877F2]\" fill=\"currentColor\" viewBox=\"0 0 24 24\" xmlns=\"http://www.w3.org/2000/svg\">
                        <path d=\"M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z\"/>
                    </svg>
                </a>
                <a href=\"{{ path('connect_github_start') }}\" class=\"flex items-center justify-center py-2 px-4 border border-border rounded-md bg-background hover:bg-muted transition-colors shadow-sm\" title=\"GitHub\">
                    <svg class=\"w-5 h-5 text-foreground\" fill=\"currentColor\" viewBox=\"0 0 24 24\" xmlns=\"http://www.w3.org/2000/svg\">
                        <path d=\"M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12\"/>
                    </svg>
                </a>
            </div>

            <div class=\"text-center text-sm\">
                <span class=\"text-muted-foreground\">Pas encore de compte ?</span>
                <a href=\"{{ path('app_register') }}\" class=\"font-medium text-primary hover:text-primary/90 hover:underline\">S'inscrire</a>
            </div>
        </form>

        <script>
            function togglePassword(inputId) {
                const input = document.getElementById(inputId);
                const icon = document.getElementById(inputId + '-eye');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.innerHTML = '<path d=\"M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24\"/><line x1=\"1\" y1=\"1\" x2=\"23\" y2=\"23\"/>';
                } else {
                    input.type = 'password';
                    icon.innerHTML = '<path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/>';
                }
            }
        </script>
    </div>
</div>
{% endblock %}
", "user/security/login.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\user\\security\\login.html.twig");
    }
}
