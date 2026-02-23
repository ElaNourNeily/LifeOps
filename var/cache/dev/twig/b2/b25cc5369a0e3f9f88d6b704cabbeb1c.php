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

/* other/task/index.html.twig */
class __TwigTemplate_8e432bfae91bc071269341ca739f6f39 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/task/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/task/index.html.twig"));

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

        yield "Tâches - LifeOps";
        
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
        yield "    <div class=\"flex items-center justify-between mb-8\">
        <div>
            <h1 class=\"text-3xl font-bold tracking-tight text-foreground\">Tâches</h1>
            <p class=\"text-muted-foreground\">Gérez vos tâches et priorités</p>
        </div>
        <a href=\"";
        // line 11
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tasks_new");
        yield "\" class=\"inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"mr-2 h-4 w-4\"><line x1=\"12\" y1=\"5\" x2=\"12\" y2=\"19\"/><line x1=\"5\" y1=\"12\" x2=\"19\" y2=\"12\"/></svg>
            Nouvelle Tâche
        </a>
    </div>

    <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow\">
        <div class=\"relative w-full overflow-auto\">
            <table class=\"w-full caption-bottom text-sm\">
                <thead class=\"[&_tr]:border-b\">
                    <tr class=\"border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted\">
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Titre</th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Statut</th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Priorité</th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Date limite</th>
                        <th class=\"h-12 px-4 text-right align-middle font-medium text-muted-foreground\">Actions</th>
                    </tr>
                </thead>
                <tbody class=\"[&_tr:last-child]:border-0\">
                ";
        // line 30
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["taches"]) || array_key_exists("taches", $context) ? $context["taches"] : (function () { throw new RuntimeError('Variable "taches" does not exist.', 30, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["tache"]) {
            // line 31
            yield "                    <tr class=\"border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted\">
                        <td class=\"p-4 align-middle font-medium\">";
            // line 32
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tache"], "titre", [], "any", false, false, false, 32), "html", null, true);
            yield "</td>
                        <td class=\"p-4 align-middle\">
                            <div class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold
                                ";
            // line 35
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["tache"], "statut", [], "any", false, false, false, 35) == "done")) {
                yield "border-transparent bg-[hsl(var(--success))]/20 text-[hsl(var(--success))]
                                ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 36
$context["tache"], "statut", [], "any", false, false, false, 36) == "in-progress")) {
                yield "border-transparent bg-[hsl(var(--warning))]/20 text-[hsl(var(--warning))]
                                ";
            } else {
                // line 37
                yield "border-transparent bg-secondary text-secondary-foreground";
            }
            // line 38
            yield "                            \">
                                ";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["tache"], "statut", [], "any", false, false, false, 39)), "html", null, true);
            yield "
                            </div>
                        </td>
                         <td class=\"p-4 align-middle\">
                            <div class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold
                                ";
            // line 44
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["tache"], "priorite", [], "any", false, false, false, 44) == "high")) {
                yield "border-transparent bg-destructive/20 text-destructive
                                ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 45
$context["tache"], "priorite", [], "any", false, false, false, 45) == "medium")) {
                yield "border-transparent bg-[hsl(var(--warning))]/20 text-[hsl(var(--warning))]
                                ";
            } else {
                // line 46
                yield "border-transparent bg-secondary text-secondary-foreground";
            }
            // line 47
            yield "                            \">
                                ";
            // line 48
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["tache"], "priorite", [], "any", false, false, false, 48)), "html", null, true);
            yield "
                            </div>
                        </td>
                        <td class=\"p-4 align-middle\">
                            ";
            // line 52
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["tache"], "deadline", [], "any", false, false, false, 52)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["tache"], "deadline", [], "any", false, false, false, 52), "d/m/Y H:i"), "html", null, true)) : ("-"));
            yield "
                        </td>
                        <td class=\"p-4 align-middle text-right\">
                             <div class=\"flex justify-end gap-2\">
                                <a href=\"";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tasks_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["tache"], "id", [], "any", false, false, false, 56)]), "html", null, true);
            yield "\" class=\"inline-flex h-8 w-8 items-center justify-center rounded-md border border-input bg-transparent text-sm font-medium shadow-sm transition-colors hover:bg-accent hover:text-accent-foreground disabled:pointer-events-none disabled:opacity-50\">
                                    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-4 w-4\"><path d=\"M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z\"/><path d=\"m15 5 4 4\"/></svg>
                                </a>
                             </div>
                        </td>
                    </tr>
                ";
            $context['_iterated'] = true;
        }
        // line 62
        if (!$context['_iterated']) {
            // line 63
            yield "                    <tr>
                        <td colspan=\"5\" class=\"p-4 text-center text-muted-foreground\">Aucune tâche trouvée</td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['tache'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        yield "                </tbody>
            </table>
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
        return "other/task/index.html.twig";
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
        return array (  217 => 67,  208 => 63,  206 => 62,  195 => 56,  188 => 52,  181 => 48,  178 => 47,  175 => 46,  170 => 45,  166 => 44,  158 => 39,  155 => 38,  152 => 37,  147 => 36,  143 => 35,  137 => 32,  134 => 31,  129 => 30,  107 => 11,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Tâches - LifeOps{% endblock %}

{% block body %}
    <div class=\"flex items-center justify-between mb-8\">
        <div>
            <h1 class=\"text-3xl font-bold tracking-tight text-foreground\">Tâches</h1>
            <p class=\"text-muted-foreground\">Gérez vos tâches et priorités</p>
        </div>
        <a href=\"{{ path('app_tasks_new') }}\" class=\"inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"mr-2 h-4 w-4\"><line x1=\"12\" y1=\"5\" x2=\"12\" y2=\"19\"/><line x1=\"5\" y1=\"12\" x2=\"19\" y2=\"12\"/></svg>
            Nouvelle Tâche
        </a>
    </div>

    <div class=\"rounded-xl border border-border bg-card text-card-foreground shadow\">
        <div class=\"relative w-full overflow-auto\">
            <table class=\"w-full caption-bottom text-sm\">
                <thead class=\"[&_tr]:border-b\">
                    <tr class=\"border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted\">
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Titre</th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Statut</th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Priorité</th>
                        <th class=\"h-12 px-4 text-left align-middle font-medium text-muted-foreground\">Date limite</th>
                        <th class=\"h-12 px-4 text-right align-middle font-medium text-muted-foreground\">Actions</th>
                    </tr>
                </thead>
                <tbody class=\"[&_tr:last-child]:border-0\">
                {% for tache in taches %}
                    <tr class=\"border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted\">
                        <td class=\"p-4 align-middle font-medium\">{{ tache.titre }}</td>
                        <td class=\"p-4 align-middle\">
                            <div class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold
                                {% if tache.statut == 'done' %}border-transparent bg-[hsl(var(--success))]/20 text-[hsl(var(--success))]
                                {% elseif tache.statut == 'in-progress' %}border-transparent bg-[hsl(var(--warning))]/20 text-[hsl(var(--warning))]
                                {% else %}border-transparent bg-secondary text-secondary-foreground{% endif %}
                            \">
                                {{ tache.statut|capitalize }}
                            </div>
                        </td>
                         <td class=\"p-4 align-middle\">
                            <div class=\"inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold
                                {% if tache.priorite == 'high' %}border-transparent bg-destructive/20 text-destructive
                                {% elseif tache.priorite == 'medium' %}border-transparent bg-[hsl(var(--warning))]/20 text-[hsl(var(--warning))]
                                {% else %}border-transparent bg-secondary text-secondary-foreground{% endif %}
                            \">
                                {{ tache.priorite|capitalize }}
                            </div>
                        </td>
                        <td class=\"p-4 align-middle\">
                            {{ tache.deadline ? tache.deadline|date('d/m/Y H:i') : '-' }}
                        </td>
                        <td class=\"p-4 align-middle text-right\">
                             <div class=\"flex justify-end gap-2\">
                                <a href=\"{{ path('app_tasks_edit', {'id': tache.id}) }}\" class=\"inline-flex h-8 w-8 items-center justify-center rounded-md border border-input bg-transparent text-sm font-medium shadow-sm transition-colors hover:bg-accent hover:text-accent-foreground disabled:pointer-events-none disabled:opacity-50\">
                                    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"h-4 w-4\"><path d=\"M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z\"/><path d=\"m15 5 4 4\"/></svg>
                                </a>
                             </div>
                        </td>
                    </tr>
                {% else %}
                    <tr>
                        <td colspan=\"5\" class=\"p-4 text-center text-muted-foreground\">Aucune tâche trouvée</td>
                    </tr>
                {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
{% endblock %}
", "other/task/index.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\other\\task\\index.html.twig");
    }
}
