<?php

/* @Twig/Exception/exception_full.html.twig */
class __TwigTemplate_16d2157aa4ad9c2f0cc61510b85a5bf54478c6be44a231bc8865258d10db301d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@Twig/layout.html.twig", "@Twig/Exception/exception_full.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@Twig/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_cb3f6d5eb339ff1f3a5d7a5aef44da75adbadfec6fd10d67d96f5813491f675a = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_cb3f6d5eb339ff1f3a5d7a5aef44da75adbadfec6fd10d67d96f5813491f675a->enter($__internal_cb3f6d5eb339ff1f3a5d7a5aef44da75adbadfec6fd10d67d96f5813491f675a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $__internal_c0ef1c696f8d3ded17831aab61faed2d9569f599259896f1e0c43711a2bddc20 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_c0ef1c696f8d3ded17831aab61faed2d9569f599259896f1e0c43711a2bddc20->enter($__internal_c0ef1c696f8d3ded17831aab61faed2d9569f599259896f1e0c43711a2bddc20_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_cb3f6d5eb339ff1f3a5d7a5aef44da75adbadfec6fd10d67d96f5813491f675a->leave($__internal_cb3f6d5eb339ff1f3a5d7a5aef44da75adbadfec6fd10d67d96f5813491f675a_prof);

        
        $__internal_c0ef1c696f8d3ded17831aab61faed2d9569f599259896f1e0c43711a2bddc20->leave($__internal_c0ef1c696f8d3ded17831aab61faed2d9569f599259896f1e0c43711a2bddc20_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_166d215c5d432fb86f1a77bf8677a531070b965da10dffdf36a5ab4671386b14 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_166d215c5d432fb86f1a77bf8677a531070b965da10dffdf36a5ab4671386b14->enter($__internal_166d215c5d432fb86f1a77bf8677a531070b965da10dffdf36a5ab4671386b14_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        $__internal_ca34681260699d4423a65e65ddd1ab6add3f41e2347a662fda519021524d6798 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_ca34681260699d4423a65e65ddd1ab6add3f41e2347a662fda519021524d6798->enter($__internal_ca34681260699d4423a65e65ddd1ab6add3f41e2347a662fda519021524d6798_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <style>
        .sf-reset .traces {
            padding-bottom: 14px;
        }
        .sf-reset .traces li {
            font-size: 12px;
            color: #868686;
            padding: 5px 4px;
            list-style-type: decimal;
            margin-left: 20px;
        }
        .sf-reset #logs .traces li.error {
            font-style: normal;
            color: #AA3333;
            background: #f9ecec;
        }
        .sf-reset #logs .traces li.warning {
            font-style: normal;
            background: #ffcc00;
        }
        /* fix for Opera not liking empty <li> */
        .sf-reset .traces li:after {
            content: \"\\00A0\";
        }
        .sf-reset .trace {
            border: 1px solid #D3D3D3;
            padding: 10px;
            overflow: auto;
            margin: 10px 0 20px;
        }
        .sf-reset .block-exception {
            -moz-border-radius: 16px;
            -webkit-border-radius: 16px;
            border-radius: 16px;
            margin-bottom: 20px;
            background-color: #f6f6f6;
            border: 1px solid #dfdfdf;
            padding: 30px 28px;
            word-wrap: break-word;
            overflow: hidden;
        }
        .sf-reset .block-exception div {
            color: #313131;
            font-size: 10px;
        }
        .sf-reset .block-exception-detected .illustration-exception,
        .sf-reset .block-exception-detected .text-exception {
            float: left;
        }
        .sf-reset .block-exception-detected .illustration-exception {
            width: 152px;
        }
        .sf-reset .block-exception-detected .text-exception {
            width: 670px;
            padding: 30px 44px 24px 46px;
            position: relative;
        }
        .sf-reset .text-exception .open-quote,
        .sf-reset .text-exception .close-quote {
            font-family: Arial, Helvetica, sans-serif;
            position: absolute;
            color: #C9C9C9;
            font-size: 8em;
        }
        .sf-reset .open-quote {
            top: 0;
            left: 0;
        }
        .sf-reset .close-quote {
            bottom: -0.5em;
            right: 50px;
        }
        .sf-reset .block-exception p {
            font-family: Arial, Helvetica, sans-serif;
        }
        .sf-reset .block-exception p a,
        .sf-reset .block-exception p a:hover {
            color: #565656;
        }
        .sf-reset .logs h2 {
            float: left;
            width: 654px;
        }
        .sf-reset .error-count, .sf-reset .support {
            float: right;
            width: 170px;
            text-align: right;
        }
        .sf-reset .error-count span {
             display: inline-block;
             background-color: #aacd4e;
             -moz-border-radius: 6px;
             -webkit-border-radius: 6px;
             border-radius: 6px;
             padding: 4px;
             color: white;
             margin-right: 2px;
             font-size: 11px;
             font-weight: bold;
        }

        .sf-reset .support a {
            display: inline-block;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            border-radius: 6px;
            padding: 4px;
            color: #000000;
            margin-right: 2px;
            font-size: 11px;
            font-weight: bold;
        }

        .sf-reset .toggle {
            vertical-align: middle;
        }
        .sf-reset .linked ul,
        .sf-reset .linked li {
            display: inline;
        }
        .sf-reset #output-content {
            color: #000;
            font-size: 12px;
        }
        .sf-reset #traces-text pre {
            white-space: pre;
            font-size: 12px;
            font-family: monospace;
        }
    </style>
";
        
        $__internal_ca34681260699d4423a65e65ddd1ab6add3f41e2347a662fda519021524d6798->leave($__internal_ca34681260699d4423a65e65ddd1ab6add3f41e2347a662fda519021524d6798_prof);

        
        $__internal_166d215c5d432fb86f1a77bf8677a531070b965da10dffdf36a5ab4671386b14->leave($__internal_166d215c5d432fb86f1a77bf8677a531070b965da10dffdf36a5ab4671386b14_prof);

    }

    // line 136
    public function block_title($context, array $blocks = array())
    {
        $__internal_3794f821c101355fc158456e3c59e20b7b8050cf517a4de50b83cc66d461c74a = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_3794f821c101355fc158456e3c59e20b7b8050cf517a4de50b83cc66d461c74a->enter($__internal_3794f821c101355fc158456e3c59e20b7b8050cf517a4de50b83cc66d461c74a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        $__internal_4ae49eac0414953e48ed6159164657302e07b8304622dd80e89457e32ff5cf51 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_4ae49eac0414953e48ed6159164657302e07b8304622dd80e89457e32ff5cf51->enter($__internal_4ae49eac0414953e48ed6159164657302e07b8304622dd80e89457e32ff5cf51_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 137
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_4ae49eac0414953e48ed6159164657302e07b8304622dd80e89457e32ff5cf51->leave($__internal_4ae49eac0414953e48ed6159164657302e07b8304622dd80e89457e32ff5cf51_prof);

        
        $__internal_3794f821c101355fc158456e3c59e20b7b8050cf517a4de50b83cc66d461c74a->leave($__internal_3794f821c101355fc158456e3c59e20b7b8050cf517a4de50b83cc66d461c74a_prof);

    }

    // line 140
    public function block_body($context, array $blocks = array())
    {
        $__internal_eb69f0f9c4ed2f013d3f8bea7634dd04318e4191edd516dc7b7bfaafc5713afb = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_eb69f0f9c4ed2f013d3f8bea7634dd04318e4191edd516dc7b7bfaafc5713afb->enter($__internal_eb69f0f9c4ed2f013d3f8bea7634dd04318e4191edd516dc7b7bfaafc5713afb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        $__internal_33c712d9cfe720cb4745121cdf18a3f2cf921bcebfe53241f65bc5411db3fc03 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_33c712d9cfe720cb4745121cdf18a3f2cf921bcebfe53241f65bc5411db3fc03->enter($__internal_33c712d9cfe720cb4745121cdf18a3f2cf921bcebfe53241f65bc5411db3fc03_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 141
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 141)->display($context);
        
        $__internal_33c712d9cfe720cb4745121cdf18a3f2cf921bcebfe53241f65bc5411db3fc03->leave($__internal_33c712d9cfe720cb4745121cdf18a3f2cf921bcebfe53241f65bc5411db3fc03_prof);

        
        $__internal_eb69f0f9c4ed2f013d3f8bea7634dd04318e4191edd516dc7b7bfaafc5713afb->leave($__internal_eb69f0f9c4ed2f013d3f8bea7634dd04318e4191edd516dc7b7bfaafc5713afb_prof);

    }

    public function getTemplateName()
    {
        return "@Twig/Exception/exception_full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  226 => 141,  217 => 140,  200 => 137,  191 => 136,  51 => 4,  42 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends '@Twig/layout.html.twig' %}

{% block head %}
    <style>
        .sf-reset .traces {
            padding-bottom: 14px;
        }
        .sf-reset .traces li {
            font-size: 12px;
            color: #868686;
            padding: 5px 4px;
            list-style-type: decimal;
            margin-left: 20px;
        }
        .sf-reset #logs .traces li.error {
            font-style: normal;
            color: #AA3333;
            background: #f9ecec;
        }
        .sf-reset #logs .traces li.warning {
            font-style: normal;
            background: #ffcc00;
        }
        /* fix for Opera not liking empty <li> */
        .sf-reset .traces li:after {
            content: \"\\00A0\";
        }
        .sf-reset .trace {
            border: 1px solid #D3D3D3;
            padding: 10px;
            overflow: auto;
            margin: 10px 0 20px;
        }
        .sf-reset .block-exception {
            -moz-border-radius: 16px;
            -webkit-border-radius: 16px;
            border-radius: 16px;
            margin-bottom: 20px;
            background-color: #f6f6f6;
            border: 1px solid #dfdfdf;
            padding: 30px 28px;
            word-wrap: break-word;
            overflow: hidden;
        }
        .sf-reset .block-exception div {
            color: #313131;
            font-size: 10px;
        }
        .sf-reset .block-exception-detected .illustration-exception,
        .sf-reset .block-exception-detected .text-exception {
            float: left;
        }
        .sf-reset .block-exception-detected .illustration-exception {
            width: 152px;
        }
        .sf-reset .block-exception-detected .text-exception {
            width: 670px;
            padding: 30px 44px 24px 46px;
            position: relative;
        }
        .sf-reset .text-exception .open-quote,
        .sf-reset .text-exception .close-quote {
            font-family: Arial, Helvetica, sans-serif;
            position: absolute;
            color: #C9C9C9;
            font-size: 8em;
        }
        .sf-reset .open-quote {
            top: 0;
            left: 0;
        }
        .sf-reset .close-quote {
            bottom: -0.5em;
            right: 50px;
        }
        .sf-reset .block-exception p {
            font-family: Arial, Helvetica, sans-serif;
        }
        .sf-reset .block-exception p a,
        .sf-reset .block-exception p a:hover {
            color: #565656;
        }
        .sf-reset .logs h2 {
            float: left;
            width: 654px;
        }
        .sf-reset .error-count, .sf-reset .support {
            float: right;
            width: 170px;
            text-align: right;
        }
        .sf-reset .error-count span {
             display: inline-block;
             background-color: #aacd4e;
             -moz-border-radius: 6px;
             -webkit-border-radius: 6px;
             border-radius: 6px;
             padding: 4px;
             color: white;
             margin-right: 2px;
             font-size: 11px;
             font-weight: bold;
        }

        .sf-reset .support a {
            display: inline-block;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            border-radius: 6px;
            padding: 4px;
            color: #000000;
            margin-right: 2px;
            font-size: 11px;
            font-weight: bold;
        }

        .sf-reset .toggle {
            vertical-align: middle;
        }
        .sf-reset .linked ul,
        .sf-reset .linked li {
            display: inline;
        }
        .sf-reset #output-content {
            color: #000;
            font-size: 12px;
        }
        .sf-reset #traces-text pre {
            white-space: pre;
            font-size: 12px;
            font-family: monospace;
        }
    </style>
{% endblock %}

{% block title %}
    {{ exception.message }} ({{ status_code }} {{ status_text }})
{% endblock %}

{% block body %}
    {% include '@Twig/Exception/exception.html.twig' %}
{% endblock %}
", "@Twig/Exception/exception_full.html.twig", "C:\\xampp\\htdocs\\bbt\\vendor\\symfony\\symfony\\src\\Symfony\\Bundle\\TwigBundle\\Resources\\views\\Exception\\exception_full.html.twig");
    }
}
