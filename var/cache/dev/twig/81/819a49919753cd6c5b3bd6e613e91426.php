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

/* base.html.twig */
class __TwigTemplate_432d7a90ff9bba53cdbd01282f208e1b extends Template
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

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'javascripts' => [$this, 'block_javascripts'],
            'importmap' => [$this, 'block_importmap'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"fr\" class=\"dark\">
    <head>
        <meta charset=\"UTF-8\">
        <title>";
        // line 5
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <link rel=\"icon\" href=\"data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><text y=%221.2em%22 font-size=%2296%22>🧠</text></svg>\">

        ";
        // line 9
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        // line 147
        yield "
        ";
        // line 148
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        // line 152
        yield "    </head>
    <body class=\"font-sans antialiased bg-background text-foreground min-h-screen flex flex-col\">

        ";
        // line 156
        yield "        <header class=\"w-full bg-card border-b border-border sticky top-0 z-50\">
            <div class=\"max-w-7xl mx-auto px-4 md:px-8\">
                <div class=\"flex items-center justify-between h-16\">
                    ";
        // line 160
        yield "                    <div class=\"flex-shrink-0\">
                        <a href=\"";
        // line 161
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dashboard");
        yield "\" class=\"flex items-center gap-3\">
                            <img src=\"";
        // line 162
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("logo.jpeg"), "html", null, true);
        yield "\" alt=\"LifeOps Logo\" class=\"w-10 h-10 rounded-lg object-contain\">
                            <span class=\"text-2xl font-bold tracking-tight text-foreground hidden md:block\">LifeOps</span>
                        </a>
                    </div>

                    ";
        // line 168
        yield "                    <nav class=\"hidden md:flex items-center gap-1 mx-4\">
                        ";
        // line 169
        $context["route"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 169, $this->source); })()), "request", [], "any", false, false, false, 169), "attributes", [], "any", false, false, false, 169), "get", ["_route"], "method", false, false, false, 169);
        // line 170
        yield "
                        <a href=\"";
        // line 171
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dashboard");
        yield "\"
                           class=\"flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors ";
        // line 172
        yield ((((isset($context["route"]) || array_key_exists("route", $context) ? $context["route"] : (function () { throw new RuntimeError('Variable "route" does not exist.', 172, $this->source); })()) == "app_dashboard")) ? ("bg-primary/10 text-primary") : ("text-muted-foreground hover:bg-secondary hover:text-foreground"));
        yield "\">
                           <span>📊</span> Tableau de bord
                        </a>

                        <a href=\"";
        // line 176
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tasks_index");
        yield "\"
                           class=\"flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors ";
        // line 177
        yield (((is_string($_v0 = (isset($context["route"]) || array_key_exists("route", $context) ? $context["route"] : (function () { throw new RuntimeError('Variable "route" does not exist.', 177, $this->source); })())) && is_string($_v1 = "app_tasks") && str_starts_with($_v0, $_v1))) ? ("bg-primary/10 text-primary") : ("text-muted-foreground hover:bg-secondary hover:text-foreground"));
        yield "\">
                           <span>✅</span> Tâches
                        </a>

                        <a href=\"";
        // line 181
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_finance_index");
        yield "\"
                           class=\"flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors ";
        // line 182
        yield (((is_string($_v2 = (isset($context["route"]) || array_key_exists("route", $context) ? $context["route"] : (function () { throw new RuntimeError('Variable "route" does not exist.', 182, $this->source); })())) && is_string($_v3 = "app_finance") && str_starts_with($_v2, $_v3))) ? ("bg-primary/10 text-primary") : ("text-muted-foreground hover:bg-secondary hover:text-foreground"));
        yield "\">
                           <span>💰</span> Finances
                        </a>

                        <a href=\"";
        // line 186
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_goal_index");
        yield "\"
                           class=\"flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors ";
        // line 187
        yield (((is_string($_v4 = (isset($context["route"]) || array_key_exists("route", $context) ? $context["route"] : (function () { throw new RuntimeError('Variable "route" does not exist.', 187, $this->source); })())) && is_string($_v5 = "app_goal") && str_starts_with($_v4, $_v5))) ? ("bg-primary/10 text-primary") : ("text-muted-foreground hover:bg-secondary hover:text-foreground"));
        yield "\">
                           <span>🎯</span> Objectifs
                        </a>

                        <a href=\"";
        // line 191
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_health_index");
        yield "\"
                           class=\"flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors ";
        // line 192
        yield (((is_string($_v6 = (isset($context["route"]) || array_key_exists("route", $context) ? $context["route"] : (function () { throw new RuntimeError('Variable "route" does not exist.', 192, $this->source); })())) && is_string($_v7 = "app_health") && str_starts_with($_v6, $_v7))) ? ("bg-primary/10 text-primary") : ("text-muted-foreground hover:bg-secondary hover:text-foreground"));
        yield "\">
                           <span>❤️</span> Santé
                        </a>

                        <a href=\"";
        // line 196
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_time_index");
        yield "\"
                           class=\"flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors ";
        // line 197
        yield (((is_string($_v8 = (isset($context["route"]) || array_key_exists("route", $context) ? $context["route"] : (function () { throw new RuntimeError('Variable "route" does not exist.', 197, $this->source); })())) && is_string($_v9 = "app_time") && str_starts_with($_v8, $_v9))) ? ("bg-primary/10 text-primary") : ("text-muted-foreground hover:bg-secondary hover:text-foreground"));
        yield "\">
                           <span>⏰</span> Temps
                        </a>
                    </nav>

                    ";
        // line 203
        yield "                    <div class=\"flex items-center gap-4\">
                        <a href=\"";
        // line 204
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile_edit");
        yield "\" class=\"flex items-center gap-2 rounded-full bg-secondary/50 px-3 py-1.5 hover:bg-secondary transition-colors text-sm font-medium\">
                            ";
        // line 205
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 205, $this->source); })()), "user", [], "any", false, false, false, 205) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 205, $this->source); })()), "user", [], "any", false, false, false, 205), "photo", [], "any", false, false, false, 205))) {
            // line 206
            yield "                                <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/profile_pictures/" . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 206, $this->source); })()), "user", [], "any", false, false, false, 206), "photo", [], "any", false, false, false, 206))), "html", null, true);
            yield "\" alt=\"Avatar\" class=\"w-6 h-6 rounded-full object-cover border border-primary/20\">
                            ";
        } else {
            // line 208
            yield "                                <div class=\"w-6 h-6 rounded-full bg-primary/20 text-primary flex items-center justify-center text-[10px] font-bold\">
                                    ";
            // line 209
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 209, $this->source); })()), "user", [], "any", false, false, false, 209)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 209, $this->source); })()), "user", [], "any", false, false, false, 209), "prenom", [], "any", false, false, false, 209))), "html", null, true)) : ("👤"));
            yield "
                                </div>
                            ";
        }
        // line 212
        yield "                            <span class=\"hidden md:block\">
                                ";
        // line 213
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 213, $this->source); })()), "user", [], "any", false, false, false, 213)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 214
            yield "                                    ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 214, $this->source); })()), "user", [], "any", false, false, false, 214), "prenom", [], "any", false, false, false, 214), "html", null, true);
            yield "
                                ";
        } else {
            // line 216
            yield "                                    Mon Compte
                                ";
        }
        // line 218
        yield "                            </span>
                        </a>
                        
                        <form method=\"post\" action=\"";
        // line 221
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
        yield "\">
                            <input type=\"hidden\" name=\"_token\" value=\"";
        // line 222
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("logout"), "html", null, true);
        yield "\">
                            <button type=\"submit\" 
                               class=\"text-muted-foreground hover:text-destructive transition-colors p-2\" title=\"Se déconnecter\">
                                <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4\"/><polyline points=\"16 17 21 12 16 7\"/><line x1=\"21\" y1=\"12\" x2=\"9\" y2=\"12\"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                
                ";
        // line 232
        yield "                <div class=\"md:hidden pb-3 overflow-x-auto flex gap-2 no-scrollbar\">
                    ";
        // line 233
        $context["route"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 233, $this->source); })()), "request", [], "any", false, false, false, 233), "attributes", [], "any", false, false, false, 233), "get", ["_route"], "method", false, false, false, 233);
        // line 234
        yield "                    <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dashboard");
        yield "\"
                       class=\"whitespace-nowrap flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors ";
        // line 235
        yield ((((isset($context["route"]) || array_key_exists("route", $context) ? $context["route"] : (function () { throw new RuntimeError('Variable "route" does not exist.', 235, $this->source); })()) == "app_dashboard")) ? ("bg-primary/10 text-primary") : ("text-muted-foreground hover:bg-secondary hover:text-foreground"));
        yield "\">
                       <span>📊</span> Dashboard
                    </a>
                    <a href=\"";
        // line 238
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_tasks_index");
        yield "\"
                       class=\"whitespace-nowrap flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors ";
        // line 239
        yield (((is_string($_v10 = (isset($context["route"]) || array_key_exists("route", $context) ? $context["route"] : (function () { throw new RuntimeError('Variable "route" does not exist.', 239, $this->source); })())) && is_string($_v11 = "app_tasks") && str_starts_with($_v10, $_v11))) ? ("bg-primary/10 text-primary") : ("text-muted-foreground hover:bg-secondary hover:text-foreground"));
        yield "\">
                       <span>✅</span> Tâches
                    </a>
                    <a href=\"";
        // line 242
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_finance_index");
        yield "\"
                       class=\"whitespace-nowrap flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors ";
        // line 243
        yield (((is_string($_v12 = (isset($context["route"]) || array_key_exists("route", $context) ? $context["route"] : (function () { throw new RuntimeError('Variable "route" does not exist.', 243, $this->source); })())) && is_string($_v13 = "app_finance") && str_starts_with($_v12, $_v13))) ? ("bg-primary/10 text-primary") : ("text-muted-foreground hover:bg-secondary hover:text-foreground"));
        yield "\">
                       <span>💰</span> Finances
                    </a>
                     <a href=\"";
        // line 246
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_goal_index");
        yield "\"
                       class=\"whitespace-nowrap flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors ";
        // line 247
        yield (((is_string($_v14 = (isset($context["route"]) || array_key_exists("route", $context) ? $context["route"] : (function () { throw new RuntimeError('Variable "route" does not exist.', 247, $this->source); })())) && is_string($_v15 = "app_goal") && str_starts_with($_v14, $_v15))) ? ("bg-primary/10 text-primary") : ("text-muted-foreground hover:bg-secondary hover:text-foreground"));
        yield "\">
                       <span>🎯</span> Objectifs
                    </a>
                    <a href=\"";
        // line 250
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_health_index");
        yield "\"
                       class=\"whitespace-nowrap flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors ";
        // line 251
        yield (((is_string($_v16 = (isset($context["route"]) || array_key_exists("route", $context) ? $context["route"] : (function () { throw new RuntimeError('Variable "route" does not exist.', 251, $this->source); })())) && is_string($_v17 = "app_health") && str_starts_with($_v16, $_v17))) ? ("bg-primary/10 text-primary") : ("text-muted-foreground hover:bg-secondary hover:text-foreground"));
        yield "\">
                       <span>❤️</span> Santé
                    </a>
                    <a href=\"";
        // line 254
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_time_index");
        yield "\"
                       class=\"whitespace-nowrap flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors ";
        // line 255
        yield (((is_string($_v18 = (isset($context["route"]) || array_key_exists("route", $context) ? $context["route"] : (function () { throw new RuntimeError('Variable "route" does not exist.', 255, $this->source); })())) && is_string($_v19 = "app_time") && str_starts_with($_v18, $_v19))) ? ("bg-primary/10 text-primary") : ("text-muted-foreground hover:bg-secondary hover:text-foreground"));
        yield "\">
                       <span>⏰</span> Temps
                    </a>
                </div>
            </div>
        </header>

        ";
        // line 263
        yield "        <main class=\"flex-1 overflow-y-auto bg-background p-4 md:p-8\">
            <div class=\"max-w-7xl mx-auto\">
                ";
        // line 265
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 266
        yield "            </div>
        </main>

    </body>
</html>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
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

        yield "LifeOps";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 9
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 10
        yield "            ";
        yield $this->env->getRuntime('Symfony\Bridge\Twig\Extension\ImportMapRuntime')->importmap("app");
        yield "
            ";
        // line 12
        yield "            <script src=\"https://cdn.tailwindcss.com\"></script>
            <script>
                tailwind.config = {
                    darkMode: 'class',
                    theme: {
                        extend: {
                            colors: {
                                background: 'hsl(var(--background))',
                                foreground: 'hsl(var(--foreground))',
                                card: {
                                    DEFAULT: 'hsl(var(--card))',
                                    foreground: 'hsl(var(--card-foreground))',
                                },
                                popover: {
                                    DEFAULT: 'hsl(var(--popover))',
                                    foreground: 'hsl(var(--popover-foreground))',
                                },
                                primary: {
                                    DEFAULT: 'hsl(var(--primary))',
                                    foreground: 'hsl(var(--primary-foreground))',
                                },
                                secondary: {
                                    DEFAULT: 'hsl(var(--secondary))',
                                    foreground: 'hsl(var(--secondary-foreground))',
                                },
                                muted: {
                                    DEFAULT: 'hsl(var(--muted))',
                                    foreground: 'hsl(var(--muted-foreground))',
                                },
                                accent: {
                                    DEFAULT: 'hsl(var(--accent))',
                                    foreground: 'hsl(var(--accent-foreground))',
                                },
                                destructive: {
                                    DEFAULT: 'hsl(var(--destructive))',
                                    foreground: 'hsl(var(--destructive-foreground))',
                                },
                                border: 'hsl(var(--border))',
                                input: 'hsl(var(--input))',
                                ring: 'hsl(var(--ring))',
                                chart: {
                                    '1': 'hsl(var(--chart-1))',
                                    '2': 'hsl(var(--chart-2))',
                                    '3': 'hsl(var(--chart-3))',
                                    '4': 'hsl(var(--chart-4))',
                                    '5': 'hsl(var(--chart-5))',
                                },
                                sidebar: {
                                    DEFAULT: 'hsl(var(--sidebar-background))',
                                    foreground: 'hsl(var(--sidebar-foreground))',
                                    primary: 'hsl(var(--sidebar-primary))',
                                    'primary-foreground': 'hsl(var(--sidebar-primary-foreground))',
                                    accent: 'hsl(var(--sidebar-accent))',
                                    'accent-foreground': 'hsl(var(--sidebar-accent-foreground))',
                                    border: 'hsl(var(--sidebar-border))',
                                    ring: 'hsl(var(--sidebar-ring))',
                                },
                            },
                            borderRadius: {
                                lg: 'var(--radius)',
                                md: 'calc(var(--radius) - 2px)',
                                sm: 'calc(var(--radius) - 4px)',
                            },
                        }
                    }
                }
            </script>
            <style>
                :root {
                    --background: 266 20% 4%;
                    --foreground: 266 10% 98%;
                    --card: 266 20% 7%;
                    --card-foreground: 266 10% 98%;
                    --popover: 266 20% 7%;
                    --popover-foreground: 266 10% 98%;
                    --primary: 266 56% 45%;
                    --primary-foreground: 0 0% 100%;
                    --secondary: 266 15% 12%;
                    --secondary-foreground: 266 10% 85%;
                    --muted: 266 15% 12%;
                    --muted-foreground: 266 10% 60%;
                    --accent: 266 56% 35%;
                    --accent-foreground: 0 0% 100%;
                    --destructive: 0 84% 60%;
                    --destructive-foreground: 0 0% 100%;
                    --border: 266 15% 16%;
                    --input: 266 15% 16%;
                    --ring: 266 56% 45%;
                    --chart-1: 266 56% 45%;
                    --chart-2: 280 65% 60%;
                    --chart-3: 199 89% 48%;
                    --chart-4: 38 92% 50%;
                    --chart-5: 340 75% 55%;
                    --radius: 0.75rem;
                    --sidebar-background: 266 20% 6%;
                    --sidebar-foreground: 266 10% 75%;
                    --sidebar-primary: 266 56% 45%;
                    --sidebar-primary-foreground: 0 0% 100%;
                    --sidebar-accent: 266 15% 10%;
                    --sidebar-accent-foreground: 266 10% 98%;
                    --sidebar-border: 266 15% 14%;
                    --sidebar-ring: 266 56% 45%;
                    --success: 200 100% 45%;
                    --warning: 38 92% 50%;
                    --info: 199 89% 48%;
                }
                * {
                    border-color: hsl(var(--border));
                }
                body {
                    background-color: hsl(var(--background));
                    color: hsl(var(--foreground));
                    visibility: visible;
                }
                
                /* Custom scrollbar */
                ::-webkit-scrollbar {
                    width: 6px;
                }
                ::-webkit-scrollbar-track {
                    background: hsl(228 14% 5%);
                }
                ::-webkit-scrollbar-thumb {
                    background: hsl(228 10% 20%);
                    border-radius: 3px;
                }
                ::-webkit-scrollbar-thumb:hover {
                    background: hsl(228 10% 30%);
                }
                
                .text-balance {
                    text-wrap: balance;
                }
            </style>
        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 148
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 149
        yield "            ";
        yield from $this->unwrap()->yieldBlock('importmap', $context, $blocks);
        // line 150
        yield "            ";
        yield $this->env->getRuntime('Symfony\Bridge\Twig\Extension\ImportMapRuntime')->importmap("app");
        yield "
        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 149
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_importmap(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "importmap"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "importmap"));

        yield $this->env->getRuntime('Symfony\Bridge\Twig\Extension\ImportMapRuntime')->importmap("app");
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 265
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

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "base.html.twig";
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
        return array (  564 => 265,  541 => 149,  527 => 150,  524 => 149,  511 => 148,  366 => 12,  361 => 10,  348 => 9,  325 => 5,  309 => 266,  307 => 265,  303 => 263,  293 => 255,  289 => 254,  283 => 251,  279 => 250,  273 => 247,  269 => 246,  263 => 243,  259 => 242,  253 => 239,  249 => 238,  243 => 235,  238 => 234,  236 => 233,  233 => 232,  221 => 222,  217 => 221,  212 => 218,  208 => 216,  202 => 214,  200 => 213,  197 => 212,  191 => 209,  188 => 208,  182 => 206,  180 => 205,  176 => 204,  173 => 203,  165 => 197,  161 => 196,  154 => 192,  150 => 191,  143 => 187,  139 => 186,  132 => 182,  128 => 181,  121 => 177,  117 => 176,  110 => 172,  106 => 171,  103 => 170,  101 => 169,  98 => 168,  90 => 162,  86 => 161,  83 => 160,  78 => 156,  73 => 152,  71 => 148,  68 => 147,  66 => 9,  59 => 5,  53 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\" class=\"dark\">
    <head>
        <meta charset=\"UTF-8\">
        <title>{% block title %}LifeOps{% endblock %}</title>
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <link rel=\"icon\" href=\"data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><text y=%221.2em%22 font-size=%2296%22>🧠</text></svg>\">

        {% block stylesheets %}
            {{ importmap('app') }}
            {# Falling back to CDN due to local build issues #}
            <script src=\"https://cdn.tailwindcss.com\"></script>
            <script>
                tailwind.config = {
                    darkMode: 'class',
                    theme: {
                        extend: {
                            colors: {
                                background: 'hsl(var(--background))',
                                foreground: 'hsl(var(--foreground))',
                                card: {
                                    DEFAULT: 'hsl(var(--card))',
                                    foreground: 'hsl(var(--card-foreground))',
                                },
                                popover: {
                                    DEFAULT: 'hsl(var(--popover))',
                                    foreground: 'hsl(var(--popover-foreground))',
                                },
                                primary: {
                                    DEFAULT: 'hsl(var(--primary))',
                                    foreground: 'hsl(var(--primary-foreground))',
                                },
                                secondary: {
                                    DEFAULT: 'hsl(var(--secondary))',
                                    foreground: 'hsl(var(--secondary-foreground))',
                                },
                                muted: {
                                    DEFAULT: 'hsl(var(--muted))',
                                    foreground: 'hsl(var(--muted-foreground))',
                                },
                                accent: {
                                    DEFAULT: 'hsl(var(--accent))',
                                    foreground: 'hsl(var(--accent-foreground))',
                                },
                                destructive: {
                                    DEFAULT: 'hsl(var(--destructive))',
                                    foreground: 'hsl(var(--destructive-foreground))',
                                },
                                border: 'hsl(var(--border))',
                                input: 'hsl(var(--input))',
                                ring: 'hsl(var(--ring))',
                                chart: {
                                    '1': 'hsl(var(--chart-1))',
                                    '2': 'hsl(var(--chart-2))',
                                    '3': 'hsl(var(--chart-3))',
                                    '4': 'hsl(var(--chart-4))',
                                    '5': 'hsl(var(--chart-5))',
                                },
                                sidebar: {
                                    DEFAULT: 'hsl(var(--sidebar-background))',
                                    foreground: 'hsl(var(--sidebar-foreground))',
                                    primary: 'hsl(var(--sidebar-primary))',
                                    'primary-foreground': 'hsl(var(--sidebar-primary-foreground))',
                                    accent: 'hsl(var(--sidebar-accent))',
                                    'accent-foreground': 'hsl(var(--sidebar-accent-foreground))',
                                    border: 'hsl(var(--sidebar-border))',
                                    ring: 'hsl(var(--sidebar-ring))',
                                },
                            },
                            borderRadius: {
                                lg: 'var(--radius)',
                                md: 'calc(var(--radius) - 2px)',
                                sm: 'calc(var(--radius) - 4px)',
                            },
                        }
                    }
                }
            </script>
            <style>
                :root {
                    --background: 266 20% 4%;
                    --foreground: 266 10% 98%;
                    --card: 266 20% 7%;
                    --card-foreground: 266 10% 98%;
                    --popover: 266 20% 7%;
                    --popover-foreground: 266 10% 98%;
                    --primary: 266 56% 45%;
                    --primary-foreground: 0 0% 100%;
                    --secondary: 266 15% 12%;
                    --secondary-foreground: 266 10% 85%;
                    --muted: 266 15% 12%;
                    --muted-foreground: 266 10% 60%;
                    --accent: 266 56% 35%;
                    --accent-foreground: 0 0% 100%;
                    --destructive: 0 84% 60%;
                    --destructive-foreground: 0 0% 100%;
                    --border: 266 15% 16%;
                    --input: 266 15% 16%;
                    --ring: 266 56% 45%;
                    --chart-1: 266 56% 45%;
                    --chart-2: 280 65% 60%;
                    --chart-3: 199 89% 48%;
                    --chart-4: 38 92% 50%;
                    --chart-5: 340 75% 55%;
                    --radius: 0.75rem;
                    --sidebar-background: 266 20% 6%;
                    --sidebar-foreground: 266 10% 75%;
                    --sidebar-primary: 266 56% 45%;
                    --sidebar-primary-foreground: 0 0% 100%;
                    --sidebar-accent: 266 15% 10%;
                    --sidebar-accent-foreground: 266 10% 98%;
                    --sidebar-border: 266 15% 14%;
                    --sidebar-ring: 266 56% 45%;
                    --success: 200 100% 45%;
                    --warning: 38 92% 50%;
                    --info: 199 89% 48%;
                }
                * {
                    border-color: hsl(var(--border));
                }
                body {
                    background-color: hsl(var(--background));
                    color: hsl(var(--foreground));
                    visibility: visible;
                }
                
                /* Custom scrollbar */
                ::-webkit-scrollbar {
                    width: 6px;
                }
                ::-webkit-scrollbar-track {
                    background: hsl(228 14% 5%);
                }
                ::-webkit-scrollbar-thumb {
                    background: hsl(228 10% 20%);
                    border-radius: 3px;
                }
                ::-webkit-scrollbar-thumb:hover {
                    background: hsl(228 10% 30%);
                }
                
                .text-balance {
                    text-wrap: balance;
                }
            </style>
        {% endblock %}

        {% block javascripts %}
            {% block importmap %}{{ importmap('app') }}{% endblock %}
            {{ importmap('app') }}
        {% endblock %}
    </head>
    <body class=\"font-sans antialiased bg-background text-foreground min-h-screen flex flex-col\">

        {# Top Navigation Bar #}
        <header class=\"w-full bg-card border-b border-border sticky top-0 z-50\">
            <div class=\"max-w-7xl mx-auto px-4 md:px-8\">
                <div class=\"flex items-center justify-between h-16\">
                    {# Logo #}
                    <div class=\"flex-shrink-0\">
                        <a href=\"{{ path('app_dashboard') }}\" class=\"flex items-center gap-3\">
                            <img src=\"{{ asset('logo.jpeg') }}\" alt=\"LifeOps Logo\" class=\"w-10 h-10 rounded-lg object-contain\">
                            <span class=\"text-2xl font-bold tracking-tight text-foreground hidden md:block\">LifeOps</span>
                        </a>
                    </div>

                    {# Navigation Links - Desktop #}
                    <nav class=\"hidden md:flex items-center gap-1 mx-4\">
                        {% set route = app.request.attributes.get('_route') %}

                        <a href=\"{{ path('app_dashboard') }}\"
                           class=\"flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ route == 'app_dashboard' ? 'bg-primary/10 text-primary' : 'text-muted-foreground hover:bg-secondary hover:text-foreground' }}\">
                           <span>📊</span> Tableau de bord
                        </a>

                        <a href=\"{{ path('app_tasks_index') }}\"
                           class=\"flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ route starts with 'app_tasks' ? 'bg-primary/10 text-primary' : 'text-muted-foreground hover:bg-secondary hover:text-foreground' }}\">
                           <span>✅</span> Tâches
                        </a>

                        <a href=\"{{ path('app_finance_index') }}\"
                           class=\"flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ route starts with 'app_finance' ? 'bg-primary/10 text-primary' : 'text-muted-foreground hover:bg-secondary hover:text-foreground' }}\">
                           <span>💰</span> Finances
                        </a>

                        <a href=\"{{ path('app_goal_index') }}\"
                           class=\"flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ route starts with 'app_goal' ? 'bg-primary/10 text-primary' : 'text-muted-foreground hover:bg-secondary hover:text-foreground' }}\">
                           <span>🎯</span> Objectifs
                        </a>

                        <a href=\"{{ path('app_health_index') }}\"
                           class=\"flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ route starts with 'app_health' ? 'bg-primary/10 text-primary' : 'text-muted-foreground hover:bg-secondary hover:text-foreground' }}\">
                           <span>❤️</span> Santé
                        </a>

                        <a href=\"{{ path('app_time_index') }}\"
                           class=\"flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ route starts with 'app_time' ? 'bg-primary/10 text-primary' : 'text-muted-foreground hover:bg-secondary hover:text-foreground' }}\">
                           <span>⏰</span> Temps
                        </a>
                    </nav>

                    {# User Menu #}
                    <div class=\"flex items-center gap-4\">
                        <a href=\"{{ path('app_profile_edit') }}\" class=\"flex items-center gap-2 rounded-full bg-secondary/50 px-3 py-1.5 hover:bg-secondary transition-colors text-sm font-medium\">
                            {% if app.user and app.user.photo %}
                                <img src=\"{{ asset('uploads/profile_pictures/' ~ app.user.photo) }}\" alt=\"Avatar\" class=\"w-6 h-6 rounded-full object-cover border border-primary/20\">
                            {% else %}
                                <div class=\"w-6 h-6 rounded-full bg-primary/20 text-primary flex items-center justify-center text-[10px] font-bold\">
                                    {{ app.user ? app.user.prenom|first|upper : '👤' }}
                                </div>
                            {% endif %}
                            <span class=\"hidden md:block\">
                                {% if app.user %}
                                    {{ app.user.prenom }}
                                {% else %}
                                    Mon Compte
                                {% endif %}
                            </span>
                        </a>
                        
                        <form method=\"post\" action=\"{{ path('app_logout') }}\">
                            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('logout') }}\">
                            <button type=\"submit\" 
                               class=\"text-muted-foreground hover:text-destructive transition-colors p-2\" title=\"Se déconnecter\">
                                <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4\"/><polyline points=\"16 17 21 12 16 7\"/><line x1=\"21\" y1=\"12\" x2=\"9\" y2=\"12\"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                
                {# Mobile Navigation (Horizontal Scroll) #}
                <div class=\"md:hidden pb-3 overflow-x-auto flex gap-2 no-scrollbar\">
                    {% set route = app.request.attributes.get('_route') %}
                    <a href=\"{{ path('app_dashboard') }}\"
                       class=\"whitespace-nowrap flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ route == 'app_dashboard' ? 'bg-primary/10 text-primary' : 'text-muted-foreground hover:bg-secondary hover:text-foreground' }}\">
                       <span>📊</span> Dashboard
                    </a>
                    <a href=\"{{ path('app_tasks_index') }}\"
                       class=\"whitespace-nowrap flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ route starts with 'app_tasks' ? 'bg-primary/10 text-primary' : 'text-muted-foreground hover:bg-secondary hover:text-foreground' }}\">
                       <span>✅</span> Tâches
                    </a>
                    <a href=\"{{ path('app_finance_index') }}\"
                       class=\"whitespace-nowrap flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ route starts with 'app_finance' ? 'bg-primary/10 text-primary' : 'text-muted-foreground hover:bg-secondary hover:text-foreground' }}\">
                       <span>💰</span> Finances
                    </a>
                     <a href=\"{{ path('app_goal_index') }}\"
                       class=\"whitespace-nowrap flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ route starts with 'app_goal' ? 'bg-primary/10 text-primary' : 'text-muted-foreground hover:bg-secondary hover:text-foreground' }}\">
                       <span>🎯</span> Objectifs
                    </a>
                    <a href=\"{{ path('app_health_index') }}\"
                       class=\"whitespace-nowrap flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ route starts with 'app_health' ? 'bg-primary/10 text-primary' : 'text-muted-foreground hover:bg-secondary hover:text-foreground' }}\">
                       <span>❤️</span> Santé
                    </a>
                    <a href=\"{{ path('app_time_index') }}\"
                       class=\"whitespace-nowrap flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ route starts with 'app_time' ? 'bg-primary/10 text-primary' : 'text-muted-foreground hover:bg-secondary hover:text-foreground' }}\">
                       <span>⏰</span> Temps
                    </a>
                </div>
            </div>
        </header>

        {# Main Content #}
        <main class=\"flex-1 overflow-y-auto bg-background p-4 md:p-8\">
            <div class=\"max-w-7xl mx-auto\">
                {% block body %}{% endblock %}
            </div>
        </main>

    </body>
</html>
", "base.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\base.html.twig");
    }
}
