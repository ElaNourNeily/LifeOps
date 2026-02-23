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

/* base_public.html.twig */
class __TwigTemplate_b0b94d0cab3b63a5c991a771e6ba6501 extends Template
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
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base_public.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base_public.html.twig"));

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
        // line 204
        yield "    </head>

    <body class=\"bg-background text-foreground\">

        ";
        // line 209
        yield "        <header class=\"navbar\">
            <nav class=\"navbar-inner\">
                <a href=\"";
        // line 211
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\" class=\"navbar-logo\">
                    <img src=\"";
        // line 212
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("logo.jpeg"), "html", null, true);
        yield "\" alt=\"LifeOps Logo\" style=\"width: 40px; height: 40px; object-fit: contain;\" />
                    <span>LifeOps</span>
                </a>

                <div class=\"navbar-links\">
                    <a href=\"";
        // line 217
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "#features\">Fonctionnalités</a>
                    <a href=\"";
        // line 218
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "#modules\">Modules</a>
                    <a href=\"";
        // line 219
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "#stats\">Statistiques</a>
                    <a href=\"";
        // line 220
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "#cta\">Contact</a>
                </div>

                <div class=\"navbar-actions\">
                    <a href=\"";
        // line 224
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\" class=\"btn-outline\">Connexion</a>
                    <a href=\"";
        // line 225
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\" class=\"btn-primary\">S'inscrire</a>
                </div>

                <button class=\"hamburger\" id=\"hamburger\" aria-label=\"Menu\">
                    <svg width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
                        <line x1=\"3\" y1=\"6\" x2=\"21\" y2=\"6\" />
                        <line x1=\"3\" y1=\"12\" x2=\"21\" y2=\"12\" />
                        <line x1=\"3\" y1=\"18\" x2=\"21\" y2=\"18\" />
                    </svg>
                </button>
            </nav>
            <div class=\"mobile-menu\" id=\"mobileMenu\">
                <a href=\"";
        // line 237
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "#features\">Fonctionnalités</a>
                <a href=\"";
        // line 238
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "#modules\">Modules</a>
                <a href=\"";
        // line 239
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "#stats\">Statistiques</a>
                <a href=\"";
        // line 240
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "#cta\">Contact</a>
                <a href=\"";
        // line 241
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\" class=\"btn-outline\" style=\"text-align:center;margin-top:8px;\">Connexion</a>
                <a href=\"";
        // line 242
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\" class=\"btn-primary\" style=\"text-align:center;\">S'inscrire</a>
            </div>
        </header>
        <script>
            document.getElementById('hamburger').addEventListener('click', function() {
                document.getElementById('mobileMenu').classList.toggle('open');
            });
        </script>

        ";
        // line 252
        yield "        <main class=\"flex-1 overflow-y-auto bg-background\">
            <div class=\"max-w-7xl mx-auto\">
                ";
        // line 254
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 255
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
                    --background: 0 0% 3.6%;
                    --foreground: 0 0% 98.3%;

                    --card: 0 0% 8.5%;
                    --card-foreground: 0 0% 98.3%;

                    --popover: 0 0% 8.5%;
                    --popover-foreground: 0 0% 98.3%;

                    --primary: 0 0% 98.3%;
                    --primary-foreground: 0 0% 3.6%;

                    --secondary: 0 0% 14.9%;
                    --secondary-foreground: 0 0% 98.3%;

                    --muted: 0 0% 14.9%;
                    --muted-foreground: 0 0% 63.9%;

                    --accent: 0 0% 98.3%;
                    --accent-foreground: 0 0% 3.6%;

                    --destructive: 0 84.6% 60.2%;
                    --destructive-foreground: 0 0% 98.3%;

                    --border: 0 0% 14.9%;
                    --input: 0 0% 14.9%;
                    --ring: 0 0% 83.1%;

                    --radius: 0.5rem;

                    --chart-1: 12 100% 50%;
                    --chart-2: 160 82% 46%;
                    --chart-3: 197 100% 63%;
                    --chart-4: 43 74% 66%;
                    --chart-5: 27 87% 67%;

                    --sidebar-background: 0 0% 8.5%;
                    --sidebar-foreground: 0 0% 98.3%;
                    --sidebar-primary: 0 0% 98.3%;
                    --sidebar-primary-foreground: 0 0% 3.6%;
                    --sidebar-accent: 0 0% 14.9%;
                    --sidebar-accent-foreground: 0 0% 98.3%;
                    --sidebar-border: 0 0% 14.9%;
                    --sidebar-ring: 0 0% 83.1%;
                }

                /* ========== NAVBAR ========== */
                *, *::before, *::after { box-sizing: border-box; }
                a { text-decoration: none; color: inherit; }
                :root {
                    --bg: #0a0c10;
                    --fg: #eaeaf0;
                    --muted-c: #71717a;
                    --primary-c: #3d1d66;
                    --primary-light-c: #5a2d8a;
                    --primary-fg-c: #ffffff;
                    --border-c: #1e2028;
                }
                .navbar {
                    position: fixed; top: 0; left: 0; right: 0; z-index: 100;
                    border-bottom: 1px solid rgba(30,32,40,0.5);
                    background: rgba(10,12,16,0.85);
                    backdrop-filter: blur(12px);
                    -webkit-backdrop-filter: blur(12px);
                }
                .navbar-inner {
                    max-width: 1152px; margin: 0 auto;
                    display: flex; align-items: center; justify-content: space-between;
                    padding: 16px 24px;
                }
                .navbar-logo {
                    display: flex; align-items: center; gap: 10px;
                }
                .navbar-logo img { width: 36px; height: 36px; border-radius: 6px; object-fit: contain; }
                .navbar-logo span { font-size: 20px; font-weight: 700; letter-spacing: -0.5px; color: var(--fg); font-family: 'Inter', system-ui, sans-serif; }
                .navbar-links {
                    display: flex; align-items: center; gap: 32px;
                }
                .navbar-links a {
                    font-size: 14px; font-weight: 500; color: var(--muted-c);
                    transition: color 0.2s; font-family: 'Inter', system-ui, sans-serif;
                }
                .navbar-links a:hover { color: var(--fg); }
                .navbar-actions {
                    display: flex; align-items: center; gap: 12px;
                }
                .btn-outline {
                    padding: 10px 20px; font-size: 14px; font-weight: 500;
                    border: 1px solid var(--border-c); border-radius: 8px;
                    background: transparent; color: var(--fg); cursor: pointer;
                    transition: background 0.2s; font-family: 'Inter', system-ui, sans-serif;
                    display: inline-block;
                }
                .btn-outline:hover { background: rgba(255,255,255,0.05); }
                .btn-primary {
                    padding: 10px 20px; font-size: 14px; font-weight: 600;
                    border: none; border-radius: 8px;
                    background: var(--primary-c); color: var(--primary-fg-c); cursor: pointer;
                    transition: background 0.2s; font-family: 'Inter', system-ui, sans-serif;
                    display: inline-block;
                }
                .btn-primary:hover { background: var(--primary-light-c); }
                .hamburger {
                    display: none; background: none; border: none; color: var(--fg);
                    cursor: pointer; width: 40px; height: 40px;
                    align-items: center; justify-content: center;
                }
                .mobile-menu {
                    display: none; flex-direction: column; gap: 16px;
                    padding: 16px 24px 24px; border-top: 1px solid rgba(30,32,40,0.5);
                    background: var(--bg);
                }
                .mobile-menu a { font-size: 14px; font-weight: 500; color: var(--muted-c); font-family: 'Inter', system-ui, sans-serif; }
                .mobile-menu a:hover { color: var(--fg); }
                .mobile-menu.open { display: flex; }
                @media (max-width: 768px) {
                    .navbar-links, .navbar-actions { display: none; }
                    .hamburger { display: flex; }
                }
                /* Push content below fixed navbar */
                body > main { padding-top: 73px; }
            </style>
        ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 254
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
        return "base_public.html.twig";
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
        return array (  423 => 254,  221 => 12,  216 => 10,  203 => 9,  180 => 5,  164 => 255,  162 => 254,  158 => 252,  146 => 242,  142 => 241,  138 => 240,  134 => 239,  130 => 238,  126 => 237,  111 => 225,  107 => 224,  100 => 220,  96 => 219,  92 => 218,  88 => 217,  80 => 212,  76 => 211,  72 => 209,  66 => 204,  64 => 9,  57 => 5,  51 => 1,);
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
                    --background: 0 0% 3.6%;
                    --foreground: 0 0% 98.3%;

                    --card: 0 0% 8.5%;
                    --card-foreground: 0 0% 98.3%;

                    --popover: 0 0% 8.5%;
                    --popover-foreground: 0 0% 98.3%;

                    --primary: 0 0% 98.3%;
                    --primary-foreground: 0 0% 3.6%;

                    --secondary: 0 0% 14.9%;
                    --secondary-foreground: 0 0% 98.3%;

                    --muted: 0 0% 14.9%;
                    --muted-foreground: 0 0% 63.9%;

                    --accent: 0 0% 98.3%;
                    --accent-foreground: 0 0% 3.6%;

                    --destructive: 0 84.6% 60.2%;
                    --destructive-foreground: 0 0% 98.3%;

                    --border: 0 0% 14.9%;
                    --input: 0 0% 14.9%;
                    --ring: 0 0% 83.1%;

                    --radius: 0.5rem;

                    --chart-1: 12 100% 50%;
                    --chart-2: 160 82% 46%;
                    --chart-3: 197 100% 63%;
                    --chart-4: 43 74% 66%;
                    --chart-5: 27 87% 67%;

                    --sidebar-background: 0 0% 8.5%;
                    --sidebar-foreground: 0 0% 98.3%;
                    --sidebar-primary: 0 0% 98.3%;
                    --sidebar-primary-foreground: 0 0% 3.6%;
                    --sidebar-accent: 0 0% 14.9%;
                    --sidebar-accent-foreground: 0 0% 98.3%;
                    --sidebar-border: 0 0% 14.9%;
                    --sidebar-ring: 0 0% 83.1%;
                }

                /* ========== NAVBAR ========== */
                *, *::before, *::after { box-sizing: border-box; }
                a { text-decoration: none; color: inherit; }
                :root {
                    --bg: #0a0c10;
                    --fg: #eaeaf0;
                    --muted-c: #71717a;
                    --primary-c: #3d1d66;
                    --primary-light-c: #5a2d8a;
                    --primary-fg-c: #ffffff;
                    --border-c: #1e2028;
                }
                .navbar {
                    position: fixed; top: 0; left: 0; right: 0; z-index: 100;
                    border-bottom: 1px solid rgba(30,32,40,0.5);
                    background: rgba(10,12,16,0.85);
                    backdrop-filter: blur(12px);
                    -webkit-backdrop-filter: blur(12px);
                }
                .navbar-inner {
                    max-width: 1152px; margin: 0 auto;
                    display: flex; align-items: center; justify-content: space-between;
                    padding: 16px 24px;
                }
                .navbar-logo {
                    display: flex; align-items: center; gap: 10px;
                }
                .navbar-logo img { width: 36px; height: 36px; border-radius: 6px; object-fit: contain; }
                .navbar-logo span { font-size: 20px; font-weight: 700; letter-spacing: -0.5px; color: var(--fg); font-family: 'Inter', system-ui, sans-serif; }
                .navbar-links {
                    display: flex; align-items: center; gap: 32px;
                }
                .navbar-links a {
                    font-size: 14px; font-weight: 500; color: var(--muted-c);
                    transition: color 0.2s; font-family: 'Inter', system-ui, sans-serif;
                }
                .navbar-links a:hover { color: var(--fg); }
                .navbar-actions {
                    display: flex; align-items: center; gap: 12px;
                }
                .btn-outline {
                    padding: 10px 20px; font-size: 14px; font-weight: 500;
                    border: 1px solid var(--border-c); border-radius: 8px;
                    background: transparent; color: var(--fg); cursor: pointer;
                    transition: background 0.2s; font-family: 'Inter', system-ui, sans-serif;
                    display: inline-block;
                }
                .btn-outline:hover { background: rgba(255,255,255,0.05); }
                .btn-primary {
                    padding: 10px 20px; font-size: 14px; font-weight: 600;
                    border: none; border-radius: 8px;
                    background: var(--primary-c); color: var(--primary-fg-c); cursor: pointer;
                    transition: background 0.2s; font-family: 'Inter', system-ui, sans-serif;
                    display: inline-block;
                }
                .btn-primary:hover { background: var(--primary-light-c); }
                .hamburger {
                    display: none; background: none; border: none; color: var(--fg);
                    cursor: pointer; width: 40px; height: 40px;
                    align-items: center; justify-content: center;
                }
                .mobile-menu {
                    display: none; flex-direction: column; gap: 16px;
                    padding: 16px 24px 24px; border-top: 1px solid rgba(30,32,40,0.5);
                    background: var(--bg);
                }
                .mobile-menu a { font-size: 14px; font-weight: 500; color: var(--muted-c); font-family: 'Inter', system-ui, sans-serif; }
                .mobile-menu a:hover { color: var(--fg); }
                .mobile-menu.open { display: flex; }
                @media (max-width: 768px) {
                    .navbar-links, .navbar-actions { display: none; }
                    .hamburger { display: flex; }
                }
                /* Push content below fixed navbar */
                body > main { padding-top: 73px; }
            </style>
        {% endblock %}
    </head>

    <body class=\"bg-background text-foreground\">

        {# Navbar — identique à la landing page #}
        <header class=\"navbar\">
            <nav class=\"navbar-inner\">
                <a href=\"{{ path('app_home') }}\" class=\"navbar-logo\">
                    <img src=\"{{ asset('logo.jpeg') }}\" alt=\"LifeOps Logo\" style=\"width: 40px; height: 40px; object-fit: contain;\" />
                    <span>LifeOps</span>
                </a>

                <div class=\"navbar-links\">
                    <a href=\"{{ path('app_home') }}#features\">Fonctionnalités</a>
                    <a href=\"{{ path('app_home') }}#modules\">Modules</a>
                    <a href=\"{{ path('app_home') }}#stats\">Statistiques</a>
                    <a href=\"{{ path('app_home') }}#cta\">Contact</a>
                </div>

                <div class=\"navbar-actions\">
                    <a href=\"{{ path('app_login') }}\" class=\"btn-outline\">Connexion</a>
                    <a href=\"{{ path('app_register') }}\" class=\"btn-primary\">S'inscrire</a>
                </div>

                <button class=\"hamburger\" id=\"hamburger\" aria-label=\"Menu\">
                    <svg width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
                        <line x1=\"3\" y1=\"6\" x2=\"21\" y2=\"6\" />
                        <line x1=\"3\" y1=\"12\" x2=\"21\" y2=\"12\" />
                        <line x1=\"3\" y1=\"18\" x2=\"21\" y2=\"18\" />
                    </svg>
                </button>
            </nav>
            <div class=\"mobile-menu\" id=\"mobileMenu\">
                <a href=\"{{ path('app_home') }}#features\">Fonctionnalités</a>
                <a href=\"{{ path('app_home') }}#modules\">Modules</a>
                <a href=\"{{ path('app_home') }}#stats\">Statistiques</a>
                <a href=\"{{ path('app_home') }}#cta\">Contact</a>
                <a href=\"{{ path('app_login') }}\" class=\"btn-outline\" style=\"text-align:center;margin-top:8px;\">Connexion</a>
                <a href=\"{{ path('app_register') }}\" class=\"btn-primary\" style=\"text-align:center;\">S'inscrire</a>
            </div>
        </header>
        <script>
            document.getElementById('hamburger').addEventListener('click', function() {
                document.getElementById('mobileMenu').classList.toggle('open');
            });
        </script>

        {# Main Content #}
        <main class=\"flex-1 overflow-y-auto bg-background\">
            <div class=\"max-w-7xl mx-auto\">
                {% block body %}{% endblock %}
            </div>
        </main>

    </body>
</html>
", "base_public.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\base_public.html.twig");
    }
}
