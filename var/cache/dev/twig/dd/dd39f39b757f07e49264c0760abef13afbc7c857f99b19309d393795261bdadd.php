<?php

/* @WebProfiler/Collector/ajax.html.twig */
class __TwigTemplate_55b14aa7be3cd6cc2b58313c7793bdbec562f31ab5959f52d24feb9bd509c441 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/ajax.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_a52dee3ebf4fc8a8e31096fa1aff454c463fc212ec005f7b62a4a5c8d49e159f = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_a52dee3ebf4fc8a8e31096fa1aff454c463fc212ec005f7b62a4a5c8d49e159f->enter($__internal_a52dee3ebf4fc8a8e31096fa1aff454c463fc212ec005f7b62a4a5c8d49e159f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/ajax.html.twig"));

        $__internal_1744f0280489dc0119f976f27b1101e9d1f30c6dec2aef7bdc5c654d54e03242 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_1744f0280489dc0119f976f27b1101e9d1f30c6dec2aef7bdc5c654d54e03242->enter($__internal_1744f0280489dc0119f976f27b1101e9d1f30c6dec2aef7bdc5c654d54e03242_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/ajax.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_a52dee3ebf4fc8a8e31096fa1aff454c463fc212ec005f7b62a4a5c8d49e159f->leave($__internal_a52dee3ebf4fc8a8e31096fa1aff454c463fc212ec005f7b62a4a5c8d49e159f_prof);

        
        $__internal_1744f0280489dc0119f976f27b1101e9d1f30c6dec2aef7bdc5c654d54e03242->leave($__internal_1744f0280489dc0119f976f27b1101e9d1f30c6dec2aef7bdc5c654d54e03242_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_26252f8c23b0ce5f7911083c87f10e63ab24d86c91d9fe3f7ace279ec9d8b0a4 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_26252f8c23b0ce5f7911083c87f10e63ab24d86c91d9fe3f7ace279ec9d8b0a4->enter($__internal_26252f8c23b0ce5f7911083c87f10e63ab24d86c91d9fe3f7ace279ec9d8b0a4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        $__internal_2d0e20167c0f1a9d2270a62eb37b6513c661c529f0e44d6b9890ff633e5b8f9b = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_2d0e20167c0f1a9d2270a62eb37b6513c661c529f0e44d6b9890ff633e5b8f9b->enter($__internal_2d0e20167c0f1a9d2270a62eb37b6513c661c529f0e44d6b9890ff633e5b8f9b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        // line 4
        echo "    ";
        ob_start();
        // line 5
        echo "        ";
        echo twig_include($this->env, $context, "@WebProfiler/Icon/ajax.svg");
        echo "
        <span class=\"sf-toolbar-value sf-toolbar-ajax-request-counter\">0</span>
    ";
        $context["icon"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 8
        echo "
    ";
        // line 9
        $context["text"] = ('' === $tmp = "        <div class=\"sf-toolbar-info-piece\">
            <b class=\"sf-toolbar-ajax-info\"></b>
        </div>
        <div class=\"sf-toolbar-info-piece\">
            <table class=\"sf-toolbar-ajax-requests\">
                <thead>
                    <tr>
                        <th>Method</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>URL</th>
                        <th>Time</th>
                        <th>Profile</th>
                    </tr>
                </thead>
                <tbody class=\"sf-toolbar-ajax-request-list\"></tbody>
            </table>
        </div>
    ") ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 29
        echo "
    ";
        // line 30
        echo twig_include($this->env, $context, "@WebProfiler/Profiler/toolbar_item.html.twig", array("link" => false));
        echo "
";
        
        $__internal_2d0e20167c0f1a9d2270a62eb37b6513c661c529f0e44d6b9890ff633e5b8f9b->leave($__internal_2d0e20167c0f1a9d2270a62eb37b6513c661c529f0e44d6b9890ff633e5b8f9b_prof);

        
        $__internal_26252f8c23b0ce5f7911083c87f10e63ab24d86c91d9fe3f7ace279ec9d8b0a4->leave($__internal_26252f8c23b0ce5f7911083c87f10e63ab24d86c91d9fe3f7ace279ec9d8b0a4_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/ajax.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  85 => 30,  82 => 29,  62 => 9,  59 => 8,  52 => 5,  49 => 4,  40 => 3,  11 => 1,);
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

{% block toolbar %}
    {% set icon %}
        {{ include('@WebProfiler/Icon/ajax.svg') }}
        <span class=\"sf-toolbar-value sf-toolbar-ajax-request-counter\">0</span>
    {% endset %}

    {% set text %}
        <div class=\"sf-toolbar-info-piece\">
            <b class=\"sf-toolbar-ajax-info\"></b>
        </div>
        <div class=\"sf-toolbar-info-piece\">
            <table class=\"sf-toolbar-ajax-requests\">
                <thead>
                    <tr>
                        <th>Method</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>URL</th>
                        <th>Time</th>
                        <th>Profile</th>
                    </tr>
                </thead>
                <tbody class=\"sf-toolbar-ajax-request-list\"></tbody>
            </table>
        </div>
    {% endset %}

    {{ include('@WebProfiler/Profiler/toolbar_item.html.twig', { link: false }) }}
{% endblock %}
", "@WebProfiler/Collector/ajax.html.twig", "C:\\xampp\\htdocs\\bbt\\vendor\\symfony\\symfony\\src\\Symfony\\Bundle\\WebProfilerBundle\\Resources\\views\\Collector\\ajax.html.twig");
    }
}
