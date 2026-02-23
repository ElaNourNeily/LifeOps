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

/* other/time/edit.html.twig */
class __TwigTemplate_2ad437047ae34443b5af33f2cd0daaf7 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/time/edit.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "other/time/edit.html.twig"));

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

        yield "Modifier Bloc de Temps - LifeOps";
        
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
        <h1 class=\"mb-8 text-3xl font-bold tracking-tight text-foreground\">Modifier le bloc de temps</h1>
        
        <form method=\"post\" class=\"space-y-6\">
            <div>
                <label for=\"title\" class=\"block text-sm font-medium text-foreground\">Titre</label>
                <input type=\"text\" name=\"title\" id=\"title\" required value=\"";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["time_block"]) || array_key_exists("time_block", $context) ? $context["time_block"] : (function () { throw new RuntimeError('Variable "time_block" does not exist.', 12, $this->source); })()), "title", [], "any", false, false, false, 12), "html", null, true);
        yield "\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
            </div>

            <div class=\"grid grid-cols-1 gap-6 sm:grid-cols-2\">
                <div>
                     <label for=\"category\" class=\"block text-sm font-medium text-foreground\">Catégorie</label>
                     <select name=\"category\" id=\"category\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                        <option value=\"Etudes\" ";
        // line 19
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["time_block"]) || array_key_exists("time_block", $context) ? $context["time_block"] : (function () { throw new RuntimeError('Variable "time_block" does not exist.', 19, $this->source); })()), "category", [], "any", false, false, false, 19) == "Etudes")) ? ("selected") : (""));
        yield ">Etudes</option>
                        <option value=\"Travail\" ";
        // line 20
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["time_block"]) || array_key_exists("time_block", $context) ? $context["time_block"] : (function () { throw new RuntimeError('Variable "time_block" does not exist.', 20, $this->source); })()), "category", [], "any", false, false, false, 20) == "Travail")) ? ("selected") : (""));
        yield ">Travail</option>
                        <option value=\"Personnel\" ";
        // line 21
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["time_block"]) || array_key_exists("time_block", $context) ? $context["time_block"] : (function () { throw new RuntimeError('Variable "time_block" does not exist.', 21, $this->source); })()), "category", [], "any", false, false, false, 21) == "Personnel")) ? ("selected") : (""));
        yield ">Personnel</option>
                        <option value=\"Sante\" ";
        // line 22
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["time_block"]) || array_key_exists("time_block", $context) ? $context["time_block"] : (function () { throw new RuntimeError('Variable "time_block" does not exist.', 22, $this->source); })()), "category", [], "any", false, false, false, 22) == "Sante")) ? ("selected") : (""));
        yield ">Sante</option>
                        <option value=\"Loisirs\" ";
        // line 23
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["time_block"]) || array_key_exists("time_block", $context) ? $context["time_block"] : (function () { throw new RuntimeError('Variable "time_block" does not exist.', 23, $this->source); })()), "category", [], "any", false, false, false, 23) == "Loisirs")) ? ("selected") : (""));
        yield ">Loisirs</option>
                     </select>
                </div>
                <div>
                    <label for=\"date\" class=\"block text-sm font-medium text-foreground\">Date</label>
                    <input type=\"date\" name=\"date\" id=\"date\" required value=\"";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["time_block"]) || array_key_exists("time_block", $context) ? $context["time_block"] : (function () { throw new RuntimeError('Variable "time_block" does not exist.', 28, $this->source); })()), "date", [], "any", false, false, false, 28), "Y-m-d"), "html", null, true);
        yield "\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
            </div>

            <div class=\"grid grid-cols-1 gap-6 sm:grid-cols-2\">
                <div>
                    <label for=\"startTime\" class=\"block text-sm font-medium text-foreground\">Heure de début</label>
                    <input type=\"time\" name=\"startTime\" id=\"startTime\" required value=\"";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["time_block"]) || array_key_exists("time_block", $context) ? $context["time_block"] : (function () { throw new RuntimeError('Variable "time_block" does not exist.', 35, $this->source); })()), "startTime", [], "any", false, false, false, 35), "html", null, true);
        yield "\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
                <div>
                    <label for=\"endTime\" class=\"block text-sm font-medium text-foreground\">Heure de fin</label>
                    <input type=\"time\" name=\"endTime\" id=\"endTime\" required value=\"";
        // line 39
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["time_block"]) || array_key_exists("time_block", $context) ? $context["time_block"] : (function () { throw new RuntimeError('Variable "time_block" does not exist.', 39, $this->source); })()), "endTime", [], "any", false, false, false, 39), "html", null, true);
        yield "\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
            </div>
            
            <div>
                 <label for=\"color\" class=\"block text-sm font-medium text-foreground\">Couleur</label>
                 <div class=\"mt-2 flex gap-3\">
                    <label class=\"cursor-pointer\">
                        <input type=\"radio\" name=\"color\" value=\"hsl(160 84% 39%)\" class=\"peer sr-only\" ";
        // line 47
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["time_block"]) || array_key_exists("time_block", $context) ? $context["time_block"] : (function () { throw new RuntimeError('Variable "time_block" does not exist.', 47, $this->source); })()), "color", [], "any", false, false, false, 47) == "hsl(160 84% 39%)")) ? ("checked") : (""));
        yield ">
                        <div class=\"h-8 w-8 rounded-full bg-[hsl(160,84%,39%)] ring-2 ring-transparent peer-checked:ring-offset-2 peer-checked:ring-foreground\"></div>
                    </label>
                    <label class=\"cursor-pointer\">
                        <input type=\"radio\" name=\"color\" value=\"hsl(199 89% 48%)\" class=\"peer sr-only\" ";
        // line 51
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["time_block"]) || array_key_exists("time_block", $context) ? $context["time_block"] : (function () { throw new RuntimeError('Variable "time_block" does not exist.', 51, $this->source); })()), "color", [], "any", false, false, false, 51) == "hsl(199 89% 48%)")) ? ("checked") : (""));
        yield ">
                        <div class=\"h-8 w-8 rounded-full bg-[hsl(199,89%,48%)] ring-2 ring-transparent peer-checked:ring-offset-2 peer-checked:ring-foreground\"></div>
                    </label>
                    <label class=\"cursor-pointer\">
                        <input type=\"radio\" name=\"color\" value=\"hsl(38 92% 50%)\" class=\"peer sr-only\" ";
        // line 55
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["time_block"]) || array_key_exists("time_block", $context) ? $context["time_block"] : (function () { throw new RuntimeError('Variable "time_block" does not exist.', 55, $this->source); })()), "color", [], "any", false, false, false, 55) == "hsl(38 92% 50%)")) ? ("checked") : (""));
        yield ">
                        <div class=\"h-8 w-8 rounded-full bg-[hsl(38,92%,50%)] ring-2 ring-transparent peer-checked:ring-offset-2 peer-checked:ring-foreground\"></div>
                    </label>
                    <label class=\"cursor-pointer\">
                        <input type=\"radio\" name=\"color\" value=\"hsl(340 75% 55%)\" class=\"peer sr-only\" ";
        // line 59
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["time_block"]) || array_key_exists("time_block", $context) ? $context["time_block"] : (function () { throw new RuntimeError('Variable "time_block" does not exist.', 59, $this->source); })()), "color", [], "any", false, false, false, 59) == "hsl(340 75% 55%)")) ? ("checked") : (""));
        yield ">
                        <div class=\"h-8 w-8 rounded-full bg-[hsl(340,75%,55%)] ring-2 ring-transparent peer-checked:ring-offset-2 peer-checked:ring-foreground\"></div>
                    </label>
                    <label class=\"cursor-pointer\">
                        <input type=\"radio\" name=\"color\" value=\"hsl(280 65% 60%)\" class=\"peer sr-only\" ";
        // line 63
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["time_block"]) || array_key_exists("time_block", $context) ? $context["time_block"] : (function () { throw new RuntimeError('Variable "time_block" does not exist.', 63, $this->source); })()), "color", [], "any", false, false, false, 63) == "hsl(280 65% 60%)")) ? ("checked") : (""));
        yield ">
                        <div class=\"h-8 w-8 rounded-full bg-[hsl(280,65%,60%)] ring-2 ring-transparent peer-checked:ring-offset-2 peer-checked:ring-foreground\"></div>
                    </label>
                 </div>
            </div>

            <div class=\"flex justify-end gap-3\">
                <a href=\"";
        // line 70
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_time_index");
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
        return "other/time/edit.html.twig";
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
        return array (  208 => 70,  198 => 63,  191 => 59,  184 => 55,  177 => 51,  170 => 47,  159 => 39,  152 => 35,  142 => 28,  134 => 23,  130 => 22,  126 => 21,  122 => 20,  118 => 19,  108 => 12,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Modifier Bloc de Temps - LifeOps{% endblock %}

{% block body %}
    <div class=\"mx-auto max-w-2xl\">
        <h1 class=\"mb-8 text-3xl font-bold tracking-tight text-foreground\">Modifier le bloc de temps</h1>
        
        <form method=\"post\" class=\"space-y-6\">
            <div>
                <label for=\"title\" class=\"block text-sm font-medium text-foreground\">Titre</label>
                <input type=\"text\" name=\"title\" id=\"title\" required value=\"{{ time_block.title }}\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
            </div>

            <div class=\"grid grid-cols-1 gap-6 sm:grid-cols-2\">
                <div>
                     <label for=\"category\" class=\"block text-sm font-medium text-foreground\">Catégorie</label>
                     <select name=\"category\" id=\"category\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                        <option value=\"Etudes\" {{ time_block.category == 'Etudes' ? 'selected' : '' }}>Etudes</option>
                        <option value=\"Travail\" {{ time_block.category == 'Travail' ? 'selected' : '' }}>Travail</option>
                        <option value=\"Personnel\" {{ time_block.category == 'Personnel' ? 'selected' : '' }}>Personnel</option>
                        <option value=\"Sante\" {{ time_block.category == 'Sante' ? 'selected' : '' }}>Sante</option>
                        <option value=\"Loisirs\" {{ time_block.category == 'Loisirs' ? 'selected' : '' }}>Loisirs</option>
                     </select>
                </div>
                <div>
                    <label for=\"date\" class=\"block text-sm font-medium text-foreground\">Date</label>
                    <input type=\"date\" name=\"date\" id=\"date\" required value=\"{{ time_block.date|date('Y-m-d') }}\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
            </div>

            <div class=\"grid grid-cols-1 gap-6 sm:grid-cols-2\">
                <div>
                    <label for=\"startTime\" class=\"block text-sm font-medium text-foreground\">Heure de début</label>
                    <input type=\"time\" name=\"startTime\" id=\"startTime\" required value=\"{{ time_block.startTime }}\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
                <div>
                    <label for=\"endTime\" class=\"block text-sm font-medium text-foreground\">Heure de fin</label>
                    <input type=\"time\" name=\"endTime\" id=\"endTime\" required value=\"{{ time_block.endTime }}\" class=\"mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-foreground shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm\">
                </div>
            </div>
            
            <div>
                 <label for=\"color\" class=\"block text-sm font-medium text-foreground\">Couleur</label>
                 <div class=\"mt-2 flex gap-3\">
                    <label class=\"cursor-pointer\">
                        <input type=\"radio\" name=\"color\" value=\"hsl(160 84% 39%)\" class=\"peer sr-only\" {{ time_block.color == 'hsl(160 84% 39%)' ? 'checked' : '' }}>
                        <div class=\"h-8 w-8 rounded-full bg-[hsl(160,84%,39%)] ring-2 ring-transparent peer-checked:ring-offset-2 peer-checked:ring-foreground\"></div>
                    </label>
                    <label class=\"cursor-pointer\">
                        <input type=\"radio\" name=\"color\" value=\"hsl(199 89% 48%)\" class=\"peer sr-only\" {{ time_block.color == 'hsl(199 89% 48%)' ? 'checked' : '' }}>
                        <div class=\"h-8 w-8 rounded-full bg-[hsl(199,89%,48%)] ring-2 ring-transparent peer-checked:ring-offset-2 peer-checked:ring-foreground\"></div>
                    </label>
                    <label class=\"cursor-pointer\">
                        <input type=\"radio\" name=\"color\" value=\"hsl(38 92% 50%)\" class=\"peer sr-only\" {{ time_block.color == 'hsl(38 92% 50%)' ? 'checked' : '' }}>
                        <div class=\"h-8 w-8 rounded-full bg-[hsl(38,92%,50%)] ring-2 ring-transparent peer-checked:ring-offset-2 peer-checked:ring-foreground\"></div>
                    </label>
                    <label class=\"cursor-pointer\">
                        <input type=\"radio\" name=\"color\" value=\"hsl(340 75% 55%)\" class=\"peer sr-only\" {{ time_block.color == 'hsl(340 75% 55%)' ? 'checked' : '' }}>
                        <div class=\"h-8 w-8 rounded-full bg-[hsl(340,75%,55%)] ring-2 ring-transparent peer-checked:ring-offset-2 peer-checked:ring-foreground\"></div>
                    </label>
                    <label class=\"cursor-pointer\">
                        <input type=\"radio\" name=\"color\" value=\"hsl(280 65% 60%)\" class=\"peer sr-only\" {{ time_block.color == 'hsl(280 65% 60%)' ? 'checked' : '' }}>
                        <div class=\"h-8 w-8 rounded-full bg-[hsl(280,65%,60%)] ring-2 ring-transparent peer-checked:ring-offset-2 peer-checked:ring-foreground\"></div>
                    </label>
                 </div>
            </div>

            <div class=\"flex justify-end gap-3\">
                <a href=\"{{ path('app_time_index') }}\" class=\"rounded-lg px-4 py-2 text-sm font-medium text-muted-foreground hover:bg-secondary\">Annuler</a>
                <button type=\"submit\" class=\"rounded-lg bg-primary px-4 py-2 text-sm font-medium text-primary-foreground hover:bg-primary/90\">Enregistrer</button>
            </div>
        </form>
    </div>
{% endblock %}
", "other/time/edit.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\other\\time\\edit.html.twig");
    }
}
