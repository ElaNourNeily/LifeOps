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

/* admin/components/sidebar.html.twig */
class __TwigTemplate_646c6add828dd0e67bbeca2289b5c184 extends Template
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
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/components/sidebar.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/components/sidebar.html.twig"));

        // line 1
        yield "<aside class=\"flex h-screen flex-col border-r border-border bg-[hsl(220,20%,5%)] transition-all duration-300 w-[250px]\" id=\"sidebar\">
    <!-- Brand -->
    <div class=\"flex h-16 items-center gap-3 border-b border-border px-4\">
        <div class=\"flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[hsl(160,84%,39%)]\">
            <i data-lucide=\"sparkles\" class=\"h-5 w-5 text-[hsl(220,20%,7%)]\"></i>
        </div>
        <div class=\"flex flex-col sidebar-text\">
            <span class=\"text-sm font-semibold text-[hsl(210,20%,95%)]\">LifeOps</span>
            <span class=\"text-xs text-[hsl(215,14%,55%)]\">Admin Panel</span>
        </div>
    </div>

    <!-- Nav -->
    <nav class=\"flex-1 overflow-y-auto px-3 py-4\">
        ";
        // line 15
        $context["navSections"] = [["label" => "Admin", "items" => [["label" => "Dashboard", "href" => $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_admin_dashboard"), "icon" => "layout-dashboard"], ["label" => "Utilisateurs", "href" => $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_admin_users"), "icon" => "users"]]]];
        // line 24
        yield "
        ";
        // line 25
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["navSections"]) || array_key_exists("navSections", $context) ? $context["navSections"] : (function () { throw new RuntimeError('Variable "navSections" does not exist.', 25, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["section"]) {
            // line 26
            yield "            <div class=\"mb-6\">
                <p class=\"mb-2 px-3 text-xs font-medium uppercase tracking-wider text-[hsl(215,14%,45%)] sidebar-text\">
                    ";
            // line 28
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "label", [], "any", false, false, false, 28), "html", null, true);
            yield "
                </p>
                <ul class=\"flex flex-col gap-1\">
                    ";
            // line 31
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "items", [], "any", false, false, false, 31));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 32
                yield "                        ";
                $context["isActive"] = (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 32, $this->source); })()), "request", [], "any", false, false, false, 32), "pathinfo", [], "any", false, false, false, 32) == CoreExtension::getAttribute($this->env, $this->source, $context["item"], "href", [], "any", false, false, false, 32));
                // line 33
                yield "                        <li>
                            <a href=\"";
                // line 34
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "href", [], "any", false, false, false, 34), "html", null, true);
                yield "\"
                               class=\"flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors ";
                // line 35
                yield (((($tmp = (isset($context["isActive"]) || array_key_exists("isActive", $context) ? $context["isActive"] : (function () { throw new RuntimeError('Variable "isActive" does not exist.', 35, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("bg-[hsl(160,84%,39%)]/10 text-[hsl(160,84%,39%)]") : ("text-[hsl(215,14%,55%)] hover:bg-[hsl(220,16%,12%)] hover:text-[hsl(210,20%,95%)]"));
                yield "\">
                                <i data-lucide=\"";
                // line 36
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "icon", [], "any", false, false, false, 36), "html", null, true);
                yield "\" class=\"h-5 w-5 shrink-0 ";
                yield (((($tmp = (isset($context["isActive"]) || array_key_exists("isActive", $context) ? $context["isActive"] : (function () { throw new RuntimeError('Variable "isActive" does not exist.', 36, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("text-[hsl(160,84%,39%)]") : (""));
                yield "\"></i>
                                <span class=\"sidebar-text\">";
                // line 37
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 37), "html", null, true);
                yield "</span>
                            </a>
                        </li>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 41
            yield "                </ul>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['section'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        yield "    </nav>

    <!-- Collapse toggle -->
    <div class=\"border-t border-border p-3 space-y-2\">
        <form action=\"";
        // line 48
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
        yield "\" method=\"POST\" class=\"w-full\">
            <input type=\"hidden\" name=\"_token\" value=\"";
        // line 49
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("logout"), "html", null, true);
        yield "\">
            <button type=\"submit\"
                    class=\"flex w-full items-center justify-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-red-500/80 hover:bg-red-500/10 hover:text-red-500 transition-colors\">
                <i data-lucide=\"log-out\" class=\"h-5 w-5\"></i>
                <span class=\"sidebar-text\">Déconnexion</span>
            </button>
        </form>
        <button id=\"sidebar-toggle\"
                class=\"flex w-full items-center justify-center rounded-lg p-2 text-[hsl(215,14%,55%)] transition-colors hover:bg-[hsl(220,16%,12%)] hover:text-[hsl(210,20%,95%)]\">
            <i data-lucide=\"chevron-left\" class=\"h-5 w-5\"></i>
        </button>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebar-toggle');
        const sidebarTexts = document.querySelectorAll('.sidebar-text');
        if (!toggleBtn) return;
        const toggleIcon = toggleBtn.querySelector('i');
        let collapsed = false;

        toggleBtn.addEventListener('click', () => {
            collapsed = !collapsed;
            if (collapsed) {
                sidebar.classList.remove('w-[250px]');
                sidebar.classList.add('w-[68px]');
                sidebarTexts.forEach(el => el.style.display = 'none');
                toggleIcon.setAttribute('data-lucide', 'chevron-right');
            } else {
                sidebar.classList.remove('w-[68px]');
                sidebar.classList.add('w-[250px]');
                sidebarTexts.forEach(el => el.style.display = 'block');
                toggleIcon.setAttribute('data-lucide', 'chevron-left');
            }
            if (window.lucide) {
                lucide.createIcons();
            }
        });
    });
</script>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "admin/components/sidebar.html.twig";
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
        return array (  135 => 49,  131 => 48,  125 => 44,  117 => 41,  107 => 37,  101 => 36,  97 => 35,  93 => 34,  90 => 33,  87 => 32,  83 => 31,  77 => 28,  73 => 26,  69 => 25,  66 => 24,  64 => 15,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<aside class=\"flex h-screen flex-col border-r border-border bg-[hsl(220,20%,5%)] transition-all duration-300 w-[250px]\" id=\"sidebar\">
    <!-- Brand -->
    <div class=\"flex h-16 items-center gap-3 border-b border-border px-4\">
        <div class=\"flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[hsl(160,84%,39%)]\">
            <i data-lucide=\"sparkles\" class=\"h-5 w-5 text-[hsl(220,20%,7%)]\"></i>
        </div>
        <div class=\"flex flex-col sidebar-text\">
            <span class=\"text-sm font-semibold text-[hsl(210,20%,95%)]\">LifeOps</span>
            <span class=\"text-xs text-[hsl(215,14%,55%)]\">Admin Panel</span>
        </div>
    </div>

    <!-- Nav -->
    <nav class=\"flex-1 overflow-y-auto px-3 py-4\">
        {% set navSections = [
            {
                'label': 'Admin',
                'items': [
                    {'label': 'Dashboard', 'href': path('app_admin_dashboard'), 'icon': 'layout-dashboard'},
                    {'label': 'Utilisateurs', 'href': path('app_admin_users'), 'icon': 'users'}
                ]
            }
        ] %}

        {% for section in navSections %}
            <div class=\"mb-6\">
                <p class=\"mb-2 px-3 text-xs font-medium uppercase tracking-wider text-[hsl(215,14%,45%)] sidebar-text\">
                    {{ section.label }}
                </p>
                <ul class=\"flex flex-col gap-1\">
                    {% for item in section.items %}
                        {% set isActive = app.request.pathinfo == item.href %}
                        <li>
                            <a href=\"{{ item.href }}\"
                               class=\"flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors {{ isActive ? 'bg-[hsl(160,84%,39%)]/10 text-[hsl(160,84%,39%)]' : 'text-[hsl(215,14%,55%)] hover:bg-[hsl(220,16%,12%)] hover:text-[hsl(210,20%,95%)]' }}\">
                                <i data-lucide=\"{{ item.icon }}\" class=\"h-5 w-5 shrink-0 {{ isActive ? 'text-[hsl(160,84%,39%)]' : '' }}\"></i>
                                <span class=\"sidebar-text\">{{ item.label }}</span>
                            </a>
                        </li>
                    {% endfor %}
                </ul>
            </div>
        {% endfor %}
    </nav>

    <!-- Collapse toggle -->
    <div class=\"border-t border-border p-3 space-y-2\">
        <form action=\"{{ path('app_logout') }}\" method=\"POST\" class=\"w-full\">
            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('logout') }}\">
            <button type=\"submit\"
                    class=\"flex w-full items-center justify-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-red-500/80 hover:bg-red-500/10 hover:text-red-500 transition-colors\">
                <i data-lucide=\"log-out\" class=\"h-5 w-5\"></i>
                <span class=\"sidebar-text\">Déconnexion</span>
            </button>
        </form>
        <button id=\"sidebar-toggle\"
                class=\"flex w-full items-center justify-center rounded-lg p-2 text-[hsl(215,14%,55%)] transition-colors hover:bg-[hsl(220,16%,12%)] hover:text-[hsl(210,20%,95%)]\">
            <i data-lucide=\"chevron-left\" class=\"h-5 w-5\"></i>
        </button>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebar-toggle');
        const sidebarTexts = document.querySelectorAll('.sidebar-text');
        if (!toggleBtn) return;
        const toggleIcon = toggleBtn.querySelector('i');
        let collapsed = false;

        toggleBtn.addEventListener('click', () => {
            collapsed = !collapsed;
            if (collapsed) {
                sidebar.classList.remove('w-[250px]');
                sidebar.classList.add('w-[68px]');
                sidebarTexts.forEach(el => el.style.display = 'none');
                toggleIcon.setAttribute('data-lucide', 'chevron-right');
            } else {
                sidebar.classList.remove('w-[68px]');
                sidebar.classList.add('w-[250px]');
                sidebarTexts.forEach(el => el.style.display = 'block');
                toggleIcon.setAttribute('data-lucide', 'chevron-left');
            }
            if (window.lucide) {
                lucide.createIcons();
            }
        });
    });
</script>
", "admin/components/sidebar.html.twig", "C:\\Users\\magya\\Downloads\\LifeOps-maghrebi-yassine (1)\\LifeOps-maghrebi-yassine\\templates\\admin\\components\\sidebar.html.twig");
    }
}
