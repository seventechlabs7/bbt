<?php

/* @WebProfiler/Collector/exception.css.twig */
class __TwigTemplate_f2a6ce639f2190fdda7c862369dd1687d7d101ff4ee7f69f82744649a4dc0216 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_b3b60106b64aeb5e8b21f1e3ef49a4e39e9e443ba5d0592db084e99e29a8e53c = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_b3b60106b64aeb5e8b21f1e3ef49a4e39e9e443ba5d0592db084e99e29a8e53c->enter($__internal_b3b60106b64aeb5e8b21f1e3ef49a4e39e9e443ba5d0592db084e99e29a8e53c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/exception.css.twig"));

        $__internal_e8432e50f3236306d2cb852fd87b2b30ab9576205f7ef6620e8e63e840beb3d9 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_e8432e50f3236306d2cb852fd87b2b30ab9576205f7ef6620e8e63e840beb3d9->enter($__internal_e8432e50f3236306d2cb852fd87b2b30ab9576205f7ef6620e8e63e840beb3d9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/exception.css.twig"));

        // line 1
        echo twig_include($this->env, $context, "@Twig/exception.css.twig");
        echo "

.container {
    max-width: auto;
    margin: 0;
    padding: 0;
}
.container .container {
    padding: 0;
}

.exception-summary {
    background: #FFF;
    border: 1px solid #E0E0E0;
    box-shadow: 0 0 1px rgba(128, 128, 128, .2);
    margin: 1em 0;
    padding: 10px;
}
.exception-summary.exception-without-message {
    display: none;
}

.exception-message {
    color: #B0413E;
}

.exception-metadata,
.exception-illustration {
    display: none;
}

.exception-message-wrapper .container {
    min-height: auto;
}
";
        
        $__internal_b3b60106b64aeb5e8b21f1e3ef49a4e39e9e443ba5d0592db084e99e29a8e53c->leave($__internal_b3b60106b64aeb5e8b21f1e3ef49a4e39e9e443ba5d0592db084e99e29a8e53c_prof);

        
        $__internal_e8432e50f3236306d2cb852fd87b2b30ab9576205f7ef6620e8e63e840beb3d9->leave($__internal_e8432e50f3236306d2cb852fd87b2b30ab9576205f7ef6620e8e63e840beb3d9_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/exception.css.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{{ include('@Twig/exception.css.twig') }}

.container {
    max-width: auto;
    margin: 0;
    padding: 0;
}
.container .container {
    padding: 0;
}

.exception-summary {
    background: #FFF;
    border: 1px solid #E0E0E0;
    box-shadow: 0 0 1px rgba(128, 128, 128, .2);
    margin: 1em 0;
    padding: 10px;
}
.exception-summary.exception-without-message {
    display: none;
}

.exception-message {
    color: #B0413E;
}

.exception-metadata,
.exception-illustration {
    display: none;
}

.exception-message-wrapper .container {
    min-height: auto;
}
", "@WebProfiler/Collector/exception.css.twig", "C:\\xampp\\htdocs\\bbt\\vendor\\symfony\\symfony\\src\\Symfony\\Bundle\\WebProfilerBundle\\Resources\\views\\Collector\\exception.css.twig");
    }
}
