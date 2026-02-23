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

/* user/registration/verify_code.html.twig */
class __TwigTemplate_dda9e43a76d0b7152b34a3e8e6bd094b extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "user/registration/verify_code.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "user/registration/verify_code.html.twig"));

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

        yield "Vérification du compte - LifeOps";
        
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
        yield "<div class=\"flex items-center justify-center min-h-screen p-4\">
    <div class=\"w-full max-w-md bg-card border border-border rounded-xl shadow-xl overflow-hidden\">
        <div class=\"p-8\">
            <div class=\"mb-8 text-center\">
                <div class=\"w-16 h-16 bg-primary/20 text-primary rounded-full flex items-center justify-center mx-auto mb-4 text-3xl\">
                    📧
                </div>
                <h1 class=\"text-3xl font-bold text-foreground\">Vérifiez votre email</h1>
                <p class=\"text-muted-foreground mt-2\">Un code de vérification a été envoyé à <strong>";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["email"]) || array_key_exists("email", $context) ? $context["email"] : (function () { throw new RuntimeError('Variable "email" does not exist.', 14, $this->source); })()), "html", null, true);
        yield "</strong></p>
            </div>

            ";
        // line 17
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 17, $this->source); })()), "flashes", ["error"], "method", false, false, false, 17));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 18
            yield "                <div class=\"bg-destructive/10 border border-destructive/20 text-destructive px-4 py-3 rounded-lg mb-6 text-sm\">
                    ";
            // line 19
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 22
        yield "
            <form method=\"post\">
                <div class=\"space-y-4\">
                    <div>
                        <label for=\"code\" class=\"block text-sm font-medium text-muted-foreground mb-1\">Code de vérification (6 chiffres)</label>
                        <input type=\"text\" 
                               id=\"code\" 
                               name=\"code\" 
                               maxlength=\"6\" 
                               placeholder=\"123456\"
                               required 
                               autofocus
                               class=\"w-full bg-background border border-border rounded-lg px-4 py-3 text-lg font-mono tracking-widest text-center focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all\">
                    </div>

                    <button type=\"submit\" 
                            class=\"w-full bg-primary text-primary-foreground font-bold py-3 rounded-lg hover:bg-primary/90 transition shadow-lg shadow-primary/20\">
                        Vérifier mon compte
                    </button>
                </div>
            </form>

            <div class=\"mt-8 pt-6 border-t border-border text-center\">
                <p class=\"text-sm text-muted-foreground\">
                    Vous n'avez pas reçu le code ? 
                    <a href=\"";
        // line 47
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\" class=\"text-primary hover:underline\">Recommencer l'inscription</a>
                </p>
            </div>
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
        return "user/registration/verify_code.html.twig";
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
        return array (  159 => 47,  132 => 22,  123 => 19,  120 => 18,  116 => 17,  110 => 14,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base_public.html.twig' %}

{% block title %}Vérification du compte - LifeOps{% endblock %}

{% block body %}
<div class=\"flex items-center justify-center min-h-screen p-4\">
    <div class=\"w-full max-w-md bg-card border border-border rounded-xl shadow-xl overflow-hidden\">
        <div class=\"p-8\">
            <div class=\"mb-8 text-center\">
                <div class=\"w-16 h-16 bg-primary/20 text-primary rounded-full flex items-center justify-center mx-auto mb-4 text-3xl\">
                    📧
                </div>
                <h1 class=\"text-3xl font-bold text-foreground\">Vérifiez votre email</h1>
                <p class=\"text-muted-foreground mt-2\">Un code de vérification a été envoyé à <strong>{{ email }}</strong></p>
            </div>

            {% for message in app.flashes('error') %}
                <div class=\"bg-destructive/10 border border-destructive/20 text-destructive px-4 py-3 rounded-lg mb-6 text-sm\">
                    {{ message }}
                </div>
            {% endfor %}

            <form method=\"post\">
                <div class=\"space-y-4\">
                    <div>
                        <label for=\"code\" class=\"block text-sm font-medium text-muted-foreground mb-1\">Code de vérification (6 chiffres)</label>
                        <input type=\"text\" 
                               id=\"code\" 
                               name=\"code\" 
                               maxlength=\"6\" 
                               placeholder=\"123456\"
                               required 
                               autofocus
                               class=\"w-full bg-background border border-border rounded-lg px-4 py-3 text-lg font-mono tracking-widest text-center focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all\">
                    </div>

                    <button type=\"submit\" 
                            class=\"w-full bg-primary text-primary-foreground font-bold py-3 rounded-lg hover:bg-primary/90 transition shadow-lg shadow-primary/20\">
                        Vérifier mon compte
                    </button>
                </div>
            </form>

            <div class=\"mt-8 pt-6 border-t border-border text-center\">
                <p class=\"text-sm text-muted-foreground\">
                    Vous n'avez pas reçu le code ? 
                    <a href=\"{{ path('app_register') }}\" class=\"text-primary hover:underline\">Recommencer l'inscription</a>
                </p>
            </div>
        </div>
    </div>
</div>
{% endblock %}
", "user/registration/verify_code.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\user\\registration\\verify_code.html.twig");
    }
}
