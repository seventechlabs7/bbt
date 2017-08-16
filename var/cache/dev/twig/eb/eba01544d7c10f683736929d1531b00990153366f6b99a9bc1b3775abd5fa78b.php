<?php

/* @WebProfiler/Collector/router.html.twig */
class __TwigTemplate_f39cf575138b7be63d855209a3a990f0d09c088c1d827c171273322642ec5dd0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/router.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_2438636d731f7dcfa59625b8f100069931d36898f19357de996e9351892f02e4 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_2438636d731f7dcfa59625b8f100069931d36898f19357de996e9351892f02e4->enter($__internal_2438636d731f7dcfa59625b8f100069931d36898f19357de996e9351892f02e4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $__internal_d1cc2320cd8bcc7657d1febdaa6524e569d46cc387247f71fab78320cfcb3edf = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_d1cc2320cd8bcc7657d1febdaa6524e569d46cc387247f71fab78320cfcb3edf->enter($__internal_d1cc2320cd8bcc7657d1febdaa6524e569d46cc387247f71fab78320cfcb3edf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_2438636d731f7dcfa59625b8f100069931d36898f19357de996e9351892f02e4->leave($__internal_2438636d731f7dcfa59625b8f100069931d36898f19357de996e9351892f02e4_prof);

        
        $__internal_d1cc2320cd8bcc7657d1febdaa6524e569d46cc387247f71fab78320cfcb3edf->leave($__internal_d1cc2320cd8bcc7657d1febdaa6524e569d46cc387247f71fab78320cfcb3edf_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_610d9684600b471dd4240bf21672e1b30eeb90afc8f002e70019331d128a5a09 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_610d9684600b471dd4240bf21672e1b30eeb90afc8f002e70019331d128a5a09->enter($__internal_610d9684600b471dd4240bf21672e1b30eeb90afc8f002e70019331d128a5a09_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        $__internal_9d87c74b5c8997e35cb1dc5f932e9df93041c2bbf49eee2b3556cecbff0be868 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_9d87c74b5c8997e35cb1dc5f932e9df93041c2bbf49eee2b3556cecbff0be868->enter($__internal_9d87c74b5c8997e35cb1dc5f932e9df93041c2bbf49eee2b3556cecbff0be868_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_9d87c74b5c8997e35cb1dc5f932e9df93041c2bbf49eee2b3556cecbff0be868->leave($__internal_9d87c74b5c8997e35cb1dc5f932e9df93041c2bbf49eee2b3556cecbff0be868_prof);

        
        $__internal_610d9684600b471dd4240bf21672e1b30eeb90afc8f002e70019331d128a5a09->leave($__internal_610d9684600b471dd4240bf21672e1b30eeb90afc8f002e70019331d128a5a09_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_ea25e9d53a5a7a5c8cdef0543f7de837db3f0ec73fbd5dde42685711651b1b05 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_ea25e9d53a5a7a5c8cdef0543f7de837db3f0ec73fbd5dde42685711651b1b05->enter($__internal_ea25e9d53a5a7a5c8cdef0543f7de837db3f0ec73fbd5dde42685711651b1b05_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        $__internal_a291962e54e423346756f581513c0f017c4904d2f821519b7d693ccad439ba2d = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_a291962e54e423346756f581513c0f017c4904d2f821519b7d693ccad439ba2d->enter($__internal_a291962e54e423346756f581513c0f017c4904d2f821519b7d693ccad439ba2d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_a291962e54e423346756f581513c0f017c4904d2f821519b7d693ccad439ba2d->leave($__internal_a291962e54e423346756f581513c0f017c4904d2f821519b7d693ccad439ba2d_prof);

        
        $__internal_ea25e9d53a5a7a5c8cdef0543f7de837db3f0ec73fbd5dde42685711651b1b05->leave($__internal_ea25e9d53a5a7a5c8cdef0543f7de837db3f0ec73fbd5dde42685711651b1b05_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_faab24523c7d6d548abc0d698e14d18ff5874925670989beb59753d182645146 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_faab24523c7d6d548abc0d698e14d18ff5874925670989beb59753d182645146->enter($__internal_faab24523c7d6d548abc0d698e14d18ff5874925670989beb59753d182645146_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        $__internal_c7adc6fdcb990afcdffec22772ef05adb4f2fd529325e520096af6e9679b15a2 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_c7adc6fdcb990afcdffec22772ef05adb4f2fd529325e520096af6e9679b15a2->enter($__internal_c7adc6fdcb990afcdffec22772ef05adb4f2fd529325e520096af6e9679b15a2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getRuntime('Symfony\Bridge\Twig\Extension\HttpKernelRuntime')->renderFragment($this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_c7adc6fdcb990afcdffec22772ef05adb4f2fd529325e520096af6e9679b15a2->leave($__internal_c7adc6fdcb990afcdffec22772ef05adb4f2fd529325e520096af6e9679b15a2_prof);

        
        $__internal_faab24523c7d6d548abc0d698e14d18ff5874925670989beb59753d182645146->leave($__internal_faab24523c7d6d548abc0d698e14d18ff5874925670989beb59753d182645146_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 13,  85 => 12,  71 => 7,  68 => 6,  59 => 5,  42 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends '@WebProfiler/Profiler/layout.html.twig' %}

{% block toolbar %}{% endblock %}

{% block menu %}
<span class=\"label\">
    <span class=\"icon\">{{ include('@WebProfiler/Icon/router.svg') }}</span>
    <strong>Routing</strong>
</span>
{% endblock %}

{% block panel %}
    {{ render(path('_profiler_router', { token: token })) }}
{% endblock %}
", "@WebProfiler/Collector/router.html.twig", "C:\\xampp\\htdocs\\bbt\\vendor\\symfony\\symfony\\src\\Symfony\\Bundle\\WebProfilerBundle\\Resources\\views\\Collector\\router.html.twig");
    }
}
