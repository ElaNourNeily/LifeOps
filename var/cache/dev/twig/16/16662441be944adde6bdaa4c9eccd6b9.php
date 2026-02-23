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

/* admin/module/list_users.html.twig */
class __TwigTemplate_e5779d1c64a7e7addcc2cea1746ade8b extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/module/list_users.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/module/list_users.html.twig"));

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

        yield "Gestion des Utilisateurs";
        
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
    <div class=\"flex items-center justify-between\">
        <div>
            <h1 class=\"text-2xl font-bold text-card-foreground\">Utilisateurs</h1>
            <p class=\"text-sm text-muted-foreground\">Liste complète des utilisateurs du Front Office</p>
        </div>
    </div>

    <div class=\"rounded-lg border border-border bg-card shadow-sm overflow-hidden\">
        <div class=\"overflow-x-auto\">
            <table class=\"w-full text-left text-sm\">
                <thead class=\"bg-secondary/50 text-muted-foreground\">
                    <tr>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Nom / Prénom</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Email</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Rôle</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Actions</th>
                    </tr>
                </thead>
                <tbody class=\"divide-y divide-border\">
                    ";
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["users"]) || array_key_exists("users", $context) ? $context["users"] : (function () { throw new RuntimeError('Variable "users" does not exist.', 26, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 27
            yield "                        <tr class=\"hover:bg-secondary/30 transition-colors\">
                            <td class=\"px-6 py-4\">
                                <span class=\"font-medium text-card-foreground\">";
            // line 29
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "nom", [], "any", false, false, false, 29), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "prenom", [], "any", false, false, false, 29), "html", null, true);
            yield "</span>
                            </td>
                            <td class=\"px-6 py-4 text-muted-foreground\">";
            // line 31
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "email", [], "any", false, false, false, 31), "html", null, true);
            yield "</td>
                            <td class=\"px-6 py-4\">
                                <span class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 ";
            // line 33
            yield ((CoreExtension::inFilter("ROLE_ADMIN", CoreExtension::getAttribute($this->env, $this->source, $context["user"], "roles", [], "any", false, false, false, 33))) ? ("bg-primary/15 text-primary border-primary/30") : ("bg-secondary text-muted-foreground border-border"));
            yield "\">
                                    ";
            // line 34
            yield ((CoreExtension::inFilter("ROLE_ADMIN", CoreExtension::getAttribute($this->env, $this->source, $context["user"], "roles", [], "any", false, false, false, 34))) ? ("Administrateur") : ("Utilisateur"));
            yield "
                                </span>
                            </td>
                            <td class=\"px-6 py-4\">
                                <button class=\"text-primary hover:text-primary/80 transition-colors\">Modifier</button>
                            </td>
                        </tr>
                    ";
            $context['_iterated'] = true;
        }
        // line 41
        if (!$context['_iterated']) {
            // line 42
            yield "                        <tr>
                            <td colspan=\"4\" class=\"px-6 py-8 text-center text-muted-foreground\">Aucun utilisateur trouvé.</td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['user'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 46
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
        return "admin/module/list_users.html.twig";
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
        return array (  170 => 46,  161 => 42,  159 => 41,  147 => 34,  143 => 33,  138 => 31,  131 => 29,  127 => 27,  122 => 26,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'admin/base.html.twig' %}

{% block title %}Gestion des Utilisateurs{% endblock %}

{% block body %}
<div class=\"flex flex-col gap-8\">
    <div class=\"flex items-center justify-between\">
        <div>
            <h1 class=\"text-2xl font-bold text-card-foreground\">Utilisateurs</h1>
            <p class=\"text-sm text-muted-foreground\">Liste complète des utilisateurs du Front Office</p>
        </div>
    </div>

    <div class=\"rounded-lg border border-border bg-card shadow-sm overflow-hidden\">
        <div class=\"overflow-x-auto\">
            <table class=\"w-full text-left text-sm\">
                <thead class=\"bg-secondary/50 text-muted-foreground\">
                    <tr>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Nom / Prénom</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Email</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Rôle</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Actions</th>
                    </tr>
                </thead>
                <tbody class=\"divide-y divide-border\">
                    {% for user in users %}
                        <tr class=\"hover:bg-secondary/30 transition-colors\">
                            <td class=\"px-6 py-4\">
                                <span class=\"font-medium text-card-foreground\">{{ user.nom }} {{ user.prenom }}</span>
                            </td>
                            <td class=\"px-6 py-4 text-muted-foreground\">{{ user.email }}</td>
                            <td class=\"px-6 py-4\">
                                <span class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 {{ 'ROLE_ADMIN' in user.roles ? 'bg-primary/15 text-primary border-primary/30' : 'bg-secondary text-muted-foreground border-border' }}\">
                                    {{ 'ROLE_ADMIN' in user.roles ? 'Administrateur' : 'Utilisateur' }}
                                </span>
                            </td>
                            <td class=\"px-6 py-4\">
                                <button class=\"text-primary hover:text-primary/80 transition-colors\">Modifier</button>
                            </td>
                        </tr>
                    {% else %}
                        <tr>
                            <td colspan=\"4\" class=\"px-6 py-8 text-center text-muted-foreground\">Aucun utilisateur trouvé.</td>
                        </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>
{% endblock %}
", "admin/module/list_users.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\admin\\module\\list_users.html.twig");
    }
}
