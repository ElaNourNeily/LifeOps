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

/* admin/dashboard/index.html.twig */
class __TwigTemplate_5b579873ad7aff241e1da3b703ffeef6 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/dashboard/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/dashboard/index.html.twig"));

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

        yield "Dashboard Admin";
        
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
    <!-- Header -->
    <div>
        <h1 class=\"text-2xl font-bold text-card-foreground text-balance\">Dashboard Admin</h1>
        <p class=\"text-sm text-muted-foreground\">
            Gestion des utilisateurs
        </p>
    </div>

    <!-- Users Stats -->
    <div class=\"grid grid-cols-1 gap-4 sm:grid-cols-2\">
        <!-- Utilisateurs -->
        <a href=\"";
        // line 18
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_admin_users");
        yield "\">
            <div class=\"border-border bg-card transition-colors hover:bg-secondary/50 rounded-lg border shadow-sm\">
                <div class=\"p-5\">
                    <div class=\"flex items-start justify-between\">
                        <div class=\"flex flex-col gap-1\">
                            <p class=\"text-sm text-muted-foreground\">Total Utilisateurs</p>
                            <p class=\"text-3xl font-bold text-card-foreground\">";
        // line 24
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["total_users"]) || array_key_exists("total_users", $context) ? $context["total_users"] : (function () { throw new RuntimeError('Variable "total_users" does not exist.', 24, $this->source); })()), "html", null, true);
        yield "</p>
                            <p class=\"text-xs text-muted-foreground\">";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["admin_users"]) || array_key_exists("admin_users", $context) ? $context["admin_users"] : (function () { throw new RuntimeError('Variable "admin_users" does not exist.', 25, $this->source); })()), "html", null, true);
        yield " admin</p>
                        </div>
                        <div class=\"flex h-11 w-11 items-center justify-center rounded-xl bg-[hsl(199,89%,48%)]/15 text-[hsl(199,89%,48%)]\">
                            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-5 w-5\"><path d=\"M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2\"/><circle cx=\"9\" cy=\"7\" r=\"4\"/><path d=\"M23 21v-2a4 4 0 0 0-3-3.87\"/><path d=\"M16 3.13a4 4 0 0 1 0 7.75\"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Users List Section -->
    <div class=\"rounded-lg border border-border bg-card shadow-sm\">
        <div class=\"p-6 border-b border-border flex justify-between items-center\">
            <h2 class=\"text-lg font-semibold text-card-foreground\">Liste des utilisateurs</h2>
            ";
        // line 40
        if (((isset($context["filtered_count"]) || array_key_exists("filtered_count", $context) ? $context["filtered_count"] : (function () { throw new RuntimeError('Variable "filtered_count" does not exist.', 40, $this->source); })()) != (isset($context["total_users"]) || array_key_exists("total_users", $context) ? $context["total_users"] : (function () { throw new RuntimeError('Variable "total_users" does not exist.', 40, $this->source); })()))) {
            // line 41
            yield "                <span class=\"text-sm text-muted-foreground\">Résultats filtrés : ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["filtered_count"]) || array_key_exists("filtered_count", $context) ? $context["filtered_count"] : (function () { throw new RuntimeError('Variable "filtered_count" does not exist.', 41, $this->source); })()), "html", null, true);
            yield " / ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["total_users"]) || array_key_exists("total_users", $context) ? $context["total_users"] : (function () { throw new RuntimeError('Variable "total_users" does not exist.', 41, $this->source); })()), "html", null, true);
            yield "</span>
            ";
        }
        // line 43
        yield "        </div>
        <div class=\"p-6 border-b border-border\">
            <form method=\"get\" class=\"flex flex-col sm:flex-row sm:items-center sm:gap-3\">
                <input type=\"search\" name=\"q\" placeholder=\"Rechercher par nom ou email\" value=\"";
        // line 46
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("search", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 46, $this->source); })()), "")) : ("")), "html", null, true);
        yield "\" class=\"w-full sm:w-1/3 px-3 py-2 rounded border border-border bg-background text-foreground focus:outline-none\" />
                
                <div class=\"flex items-center gap-2 mt-2 sm:mt-0 sm:ml-2\">
                    <input type=\"number\" name=\"minAge\" placeholder=\"Age min\" value=\"";
        // line 49
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("minAge", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["minAge"]) || array_key_exists("minAge", $context) ? $context["minAge"] : (function () { throw new RuntimeError('Variable "minAge" does not exist.', 49, $this->source); })()), "")) : ("")), "html", null, true);
        yield "\" class=\"w-20 px-3 py-2 rounded border border-border bg-background text-foreground focus:outline-none\" />
                    <span class=\"text-muted-foreground\">-</span>
                    <input type=\"number\" name=\"maxAge\" placeholder=\"Age max\" value=\"";
        // line 51
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("maxAge", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["maxAge"]) || array_key_exists("maxAge", $context) ? $context["maxAge"] : (function () { throw new RuntimeError('Variable "maxAge" does not exist.', 51, $this->source); })()), "")) : ("")), "html", null, true);
        yield "\" class=\"w-20 px-3 py-2 rounded border border-border bg-background text-foreground focus:outline-none\" />
                </div>

                <select name=\"sort\" class=\"mt-2 sm:mt-0 sm:ml-2 px-2 py-2 rounded border border-border bg-background text-foreground\">
                    <option value=\"created\" ";
        // line 55
        yield ((((isset($context["sort"]) || array_key_exists("sort", $context) ? $context["sort"] : (function () { throw new RuntimeError('Variable "sort" does not exist.', 55, $this->source); })()) == "created")) ? ("selected") : (""));
        yield ">| Date création</option>
                    <option value=\"name\" ";
        // line 56
        yield ((((isset($context["sort"]) || array_key_exists("sort", $context) ? $context["sort"] : (function () { throw new RuntimeError('Variable "sort" does not exist.', 56, $this->source); })()) == "name")) ? ("selected") : (""));
        yield ">Nom</option>
                    <option value=\"email\" ";
        // line 57
        yield ((((isset($context["sort"]) || array_key_exists("sort", $context) ? $context["sort"] : (function () { throw new RuntimeError('Variable "sort" does not exist.', 57, $this->source); })()) == "email")) ? ("selected") : (""));
        yield ">Email</option>
                </select>

                <select name=\"order\" class=\"mt-2 sm:mt-0 sm:ml-2 px-2 py-2 rounded border border-border bg-background text-foreground\">
                    <option value=\"desc\" ";
        // line 61
        yield ((((isset($context["order"]) || array_key_exists("order", $context) ? $context["order"] : (function () { throw new RuntimeError('Variable "order" does not exist.', 61, $this->source); })()) == "desc")) ? ("selected") : (""));
        yield ">Décroissant</option>
                    <option value=\"asc\" ";
        // line 62
        yield ((((isset($context["order"]) || array_key_exists("order", $context) ? $context["order"] : (function () { throw new RuntimeError('Variable "order" does not exist.', 62, $this->source); })()) == "asc")) ? ("selected") : (""));
        yield ">Croissant</option>
                </select>

                <div class=\"mt-2 sm:mt-0 sm:ml-2\">
                    <button type=\"submit\" class=\"px-3 py-2 rounded bg-[hsl(160,84%,39%)] text-[hsl(220,20%,7%)] font-medium\">Filtrer</button>
                    <a href=\"";
        // line 67
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_admin_dashboard");
        yield "\" class=\"ml-2 px-3 py-2 rounded border border-border text-muted-foreground\">Réinitialiser</a>
                </div>
            </form>
        </div>
        <div class=\"overflow-x-auto\">
            <table class=\"w-full text-left text-sm\">
                <thead class=\"bg-secondary/50 text-muted-foreground\">
                    <tr>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Nom / Prénom</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Créé le</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Email</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Age</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Rôle</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Actions</th>
                    </tr>
                </thead>
                <tbody class=\"divide-y divide-border\">
                    ";
        // line 84
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["users"]) || array_key_exists("users", $context) ? $context["users"] : (function () { throw new RuntimeError('Variable "users" does not exist.', 84, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 85
            yield "                        <tr class=\"hover:bg-secondary/30 transition-colors\">
                            <td class=\"px-6 py-4\">
                                <span class=\"font-medium text-card-foreground\">";
            // line 87
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "nom", [], "any", false, false, false, 87), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "prenom", [], "any", false, false, false, 87), "html", null, true);
            yield "</span>
                            </td>
                            <td class=\"px-6 py-4 text-muted-foreground\">";
            // line 89
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "createdAt", [], "any", false, false, false, 89)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "createdAt", [], "any", false, false, false, 89), "Y-m-d"), "html", null, true)) : (""));
            yield "</td>
                            <td class=\"px-6 py-4 text-muted-foreground\">";
            // line 90
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "email", [], "any", false, false, false, 90), "html", null, true);
            yield "</td>
                            <td class=\"px-6 py-4 text-muted-foreground\">";
            // line 91
            yield (((CoreExtension::getAttribute($this->env, $this->source, $context["user"], "age", [], "any", true, true, false, 91) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["user"], "age", [], "any", false, false, false, 91)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "age", [], "any", false, false, false, 91), "html", null, true)) : ("-"));
            yield " ans</td>
                            <td class=\"px-6 py-4\">
                                <span class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors ";
            // line 93
            yield ((CoreExtension::inFilter("ROLE_ADMIN", CoreExtension::getAttribute($this->env, $this->source, $context["user"], "roles", [], "any", false, false, false, 93))) ? ("bg-primary/15 text-primary border-primary/30") : ("bg-secondary text-muted-foreground border-border"));
            yield "\">
                                    ";
            // line 94
            yield ((CoreExtension::inFilter("ROLE_ADMIN", CoreExtension::getAttribute($this->env, $this->source, $context["user"], "roles", [], "any", false, false, false, 94))) ? ("Administrateur") : ("Utilisateur"));
            yield "
                                </span>
                            </td>
                            <td class=\"px-6 py-4\">
                                <div class=\"flex gap-2\">
                                    ";
            // line 99
            if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["user"], "isBanned", [], "method", false, false, false, 99)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 100
                yield "                                        <button 
                                            onclick=\"banUser(";
                // line 101
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 101), "html", null, true);
                yield ", 30)\"
                                            class=\"px-3 py-1.5 text-xs font-medium rounded bg-yellow-500/20 text-yellow-600 hover:bg-yellow-500/30 transition-colors border border-yellow-500/30\"
                                            title=\"Ban pour 30 jours\">
                                            <span>Bannir 30j</span>
                                        </button>
                                    ";
            } else {
                // line 107
                yield "                                        <button 
                                            onclick=\"unbanUser(";
                // line 108
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 108), "html", null, true);
                yield ")\"
                                            class=\"px-3 py-1.5 text-xs font-medium rounded bg-green-500/20 text-green-600 hover:bg-green-500/30 transition-colors border border-green-500/30\"
                                            title=\"Débannir l'utilisateur\">
                                            <span>Débannir</span>
                                        </button>
                                    ";
            }
            // line 114
            yield "                                    <button 
                                        onclick=\"if(confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) { deleteUser(";
            // line 115
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 115), "html", null, true);
            yield "); }\"
                                        class=\"px-3 py-1.5 text-xs font-medium rounded bg-red-500/20 text-red-600 hover:bg-red-500/30 transition-colors border border-red-500/30\"
                                        title=\"Supprimer l'utilisateur\">
                                        <span>Supprimer</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    ";
            $context['_iterated'] = true;
        }
        // line 123
        if (!$context['_iterated']) {
            // line 124
            yield "                        <tr>
                            <td colspan=\"4\" class=\"px-6 py-8 text-center text-muted-foreground\">Aucun utilisateur trouvé.</td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['user'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 128
        yield "                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function deleteUser(userId) {
    fetch(`/admin/users/\${userId}/delete`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
    .then(response => {
        if (response.ok) {
            location.reload();
        } else {
            alert('Erreur lors de la suppression');
        }
    })
    .catch(error => console.error('Error:', error));
}

function banUser(userId, days) {
    fetch(`/admin/users/\${userId}/ban`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify({ days: days }),
    })
    .then(response => {
        if (response.ok) {
            location.reload();
        } else {
            alert('Erreur lors du bannissement');
        }
    })
    .catch(error => console.error('Error:', error));
}

function unbanUser(userId) {
    fetch(`/admin/users/\${userId}/unban`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
    .then(response => {
        if (response.ok) {
            location.reload();
        } else {
            alert('Erreur lors du débannissement');
        }
    })
    .catch(error => console.error('Error:', error));
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
        return "admin/dashboard/index.html.twig";
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
        return array (  319 => 128,  310 => 124,  308 => 123,  295 => 115,  292 => 114,  283 => 108,  280 => 107,  271 => 101,  268 => 100,  266 => 99,  258 => 94,  254 => 93,  249 => 91,  245 => 90,  241 => 89,  234 => 87,  230 => 85,  225 => 84,  205 => 67,  197 => 62,  193 => 61,  186 => 57,  182 => 56,  178 => 55,  171 => 51,  166 => 49,  160 => 46,  155 => 43,  147 => 41,  145 => 40,  127 => 25,  123 => 24,  114 => 18,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'admin/base.html.twig' %}

{% block title %}Dashboard Admin{% endblock %}

{% block body %}
<div class=\"flex flex-col gap-8\">
    <!-- Header -->
    <div>
        <h1 class=\"text-2xl font-bold text-card-foreground text-balance\">Dashboard Admin</h1>
        <p class=\"text-sm text-muted-foreground\">
            Gestion des utilisateurs
        </p>
    </div>

    <!-- Users Stats -->
    <div class=\"grid grid-cols-1 gap-4 sm:grid-cols-2\">
        <!-- Utilisateurs -->
        <a href=\"{{ path('app_admin_users') }}\">
            <div class=\"border-border bg-card transition-colors hover:bg-secondary/50 rounded-lg border shadow-sm\">
                <div class=\"p-5\">
                    <div class=\"flex items-start justify-between\">
                        <div class=\"flex flex-col gap-1\">
                            <p class=\"text-sm text-muted-foreground\">Total Utilisateurs</p>
                            <p class=\"text-3xl font-bold text-card-foreground\">{{ total_users }}</p>
                            <p class=\"text-xs text-muted-foreground\">{{ admin_users }} admin</p>
                        </div>
                        <div class=\"flex h-11 w-11 items-center justify-center rounded-xl bg-[hsl(199,89%,48%)]/15 text-[hsl(199,89%,48%)]\">
                            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-5 w-5\"><path d=\"M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2\"/><circle cx=\"9\" cy=\"7\" r=\"4\"/><path d=\"M23 21v-2a4 4 0 0 0-3-3.87\"/><path d=\"M16 3.13a4 4 0 0 1 0 7.75\"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Users List Section -->
    <div class=\"rounded-lg border border-border bg-card shadow-sm\">
        <div class=\"p-6 border-b border-border flex justify-between items-center\">
            <h2 class=\"text-lg font-semibold text-card-foreground\">Liste des utilisateurs</h2>
            {% if filtered_count != total_users %}
                <span class=\"text-sm text-muted-foreground\">Résultats filtrés : {{ filtered_count }} / {{ total_users }}</span>
            {% endif %}
        </div>
        <div class=\"p-6 border-b border-border\">
            <form method=\"get\" class=\"flex flex-col sm:flex-row sm:items-center sm:gap-3\">
                <input type=\"search\" name=\"q\" placeholder=\"Rechercher par nom ou email\" value=\"{{ search|default('') }}\" class=\"w-full sm:w-1/3 px-3 py-2 rounded border border-border bg-background text-foreground focus:outline-none\" />
                
                <div class=\"flex items-center gap-2 mt-2 sm:mt-0 sm:ml-2\">
                    <input type=\"number\" name=\"minAge\" placeholder=\"Age min\" value=\"{{ minAge|default('') }}\" class=\"w-20 px-3 py-2 rounded border border-border bg-background text-foreground focus:outline-none\" />
                    <span class=\"text-muted-foreground\">-</span>
                    <input type=\"number\" name=\"maxAge\" placeholder=\"Age max\" value=\"{{ maxAge|default('') }}\" class=\"w-20 px-3 py-2 rounded border border-border bg-background text-foreground focus:outline-none\" />
                </div>

                <select name=\"sort\" class=\"mt-2 sm:mt-0 sm:ml-2 px-2 py-2 rounded border border-border bg-background text-foreground\">
                    <option value=\"created\" {{ sort == 'created' ? 'selected' }}>| Date création</option>
                    <option value=\"name\" {{ sort == 'name' ? 'selected' }}>Nom</option>
                    <option value=\"email\" {{ sort == 'email' ? 'selected' }}>Email</option>
                </select>

                <select name=\"order\" class=\"mt-2 sm:mt-0 sm:ml-2 px-2 py-2 rounded border border-border bg-background text-foreground\">
                    <option value=\"desc\" {{ order == 'desc' ? 'selected' }}>Décroissant</option>
                    <option value=\"asc\" {{ order == 'asc' ? 'selected' }}>Croissant</option>
                </select>

                <div class=\"mt-2 sm:mt-0 sm:ml-2\">
                    <button type=\"submit\" class=\"px-3 py-2 rounded bg-[hsl(160,84%,39%)] text-[hsl(220,20%,7%)] font-medium\">Filtrer</button>
                    <a href=\"{{ path('app_admin_dashboard') }}\" class=\"ml-2 px-3 py-2 rounded border border-border text-muted-foreground\">Réinitialiser</a>
                </div>
            </form>
        </div>
        <div class=\"overflow-x-auto\">
            <table class=\"w-full text-left text-sm\">
                <thead class=\"bg-secondary/50 text-muted-foreground\">
                    <tr>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Nom / Prénom</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Créé le</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Email</th>
                        <th class=\"px-6 py-4 font-medium uppercase tracking-wider\">Age</th>
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
                            <td class=\"px-6 py-4 text-muted-foreground\">{{ user.createdAt ? user.createdAt|date('Y-m-d') : '' }}</td>
                            <td class=\"px-6 py-4 text-muted-foreground\">{{ user.email }}</td>
                            <td class=\"px-6 py-4 text-muted-foreground\">{{ user.age ?? '-' }} ans</td>
                            <td class=\"px-6 py-4\">
                                <span class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors {{ 'ROLE_ADMIN' in user.roles ? 'bg-primary/15 text-primary border-primary/30' : 'bg-secondary text-muted-foreground border-border' }}\">
                                    {{ 'ROLE_ADMIN' in user.roles ? 'Administrateur' : 'Utilisateur' }}
                                </span>
                            </td>
                            <td class=\"px-6 py-4\">
                                <div class=\"flex gap-2\">
                                    {% if not user.isBanned() %}
                                        <button 
                                            onclick=\"banUser({{ user.id }}, 30)\"
                                            class=\"px-3 py-1.5 text-xs font-medium rounded bg-yellow-500/20 text-yellow-600 hover:bg-yellow-500/30 transition-colors border border-yellow-500/30\"
                                            title=\"Ban pour 30 jours\">
                                            <span>Bannir 30j</span>
                                        </button>
                                    {% else %}
                                        <button 
                                            onclick=\"unbanUser({{ user.id }})\"
                                            class=\"px-3 py-1.5 text-xs font-medium rounded bg-green-500/20 text-green-600 hover:bg-green-500/30 transition-colors border border-green-500/30\"
                                            title=\"Débannir l'utilisateur\">
                                            <span>Débannir</span>
                                        </button>
                                    {% endif %}
                                    <button 
                                        onclick=\"if(confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) { deleteUser({{ user.id }}); }\"
                                        class=\"px-3 py-1.5 text-xs font-medium rounded bg-red-500/20 text-red-600 hover:bg-red-500/30 transition-colors border border-red-500/30\"
                                        title=\"Supprimer l'utilisateur\">
                                        <span>Supprimer</span>
                                    </button>
                                </div>
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

<script>
function deleteUser(userId) {
    fetch(`/admin/users/\${userId}/delete`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
    .then(response => {
        if (response.ok) {
            location.reload();
        } else {
            alert('Erreur lors de la suppression');
        }
    })
    .catch(error => console.error('Error:', error));
}

function banUser(userId, days) {
    fetch(`/admin/users/\${userId}/ban`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify({ days: days }),
    })
    .then(response => {
        if (response.ok) {
            location.reload();
        } else {
            alert('Erreur lors du bannissement');
        }
    })
    .catch(error => console.error('Error:', error));
}

function unbanUser(userId) {
    fetch(`/admin/users/\${userId}/unban`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
    .then(response => {
        if (response.ok) {
            location.reload();
        } else {
            alert('Erreur lors du débannissement');
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
{% endblock %}
", "admin/dashboard/index.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\admin\\dashboard\\index.html.twig");
    }
}
