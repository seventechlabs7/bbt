<?php

/* base.html.twig */
class __TwigTemplate_6d2a393b7389d0c27cd01fd1079735a946deeb2a0849741c9d44c02f69d64f70 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_f0030eb7176cab1dcc25cc13f4a61b833d5e3aa40b2669a9df35dc20ca8d757d = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_f0030eb7176cab1dcc25cc13f4a61b833d5e3aa40b2669a9df35dc20ca8d757d->enter($__internal_f0030eb7176cab1dcc25cc13f4a61b833d5e3aa40b2669a9df35dc20ca8d757d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        $__internal_ae15bbfa54385462fb18790380b5eb9d90375055509001a34fe93843b8980cad = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_ae15bbfa54385462fb18790380b5eb9d90375055509001a34fe93843b8980cad->enter($__internal_ae15bbfa54385462fb18790380b5eb9d90375055509001a34fe93843b8980cad_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        ";
        // line 10
        $this->displayBlock('body', $context, $blocks);
        // line 11
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 12
        echo "    </body>
</html>
";
        
        $__internal_f0030eb7176cab1dcc25cc13f4a61b833d5e3aa40b2669a9df35dc20ca8d757d->leave($__internal_f0030eb7176cab1dcc25cc13f4a61b833d5e3aa40b2669a9df35dc20ca8d757d_prof);

        
        $__internal_ae15bbfa54385462fb18790380b5eb9d90375055509001a34fe93843b8980cad->leave($__internal_ae15bbfa54385462fb18790380b5eb9d90375055509001a34fe93843b8980cad_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_554d52fb1d2526ef2ad8bfc1974a7b4bc6377ea685f5740056325e76b4edb4f9 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_554d52fb1d2526ef2ad8bfc1974a7b4bc6377ea685f5740056325e76b4edb4f9->enter($__internal_554d52fb1d2526ef2ad8bfc1974a7b4bc6377ea685f5740056325e76b4edb4f9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        $__internal_5e84c98c8599998fbdebd846c7a719ab5d0039762bde66c8dbbe3d40b279c4e7 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_5e84c98c8599998fbdebd846c7a719ab5d0039762bde66c8dbbe3d40b279c4e7->enter($__internal_5e84c98c8599998fbdebd846c7a719ab5d0039762bde66c8dbbe3d40b279c4e7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Welcome!";
        
        $__internal_5e84c98c8599998fbdebd846c7a719ab5d0039762bde66c8dbbe3d40b279c4e7->leave($__internal_5e84c98c8599998fbdebd846c7a719ab5d0039762bde66c8dbbe3d40b279c4e7_prof);

        
        $__internal_554d52fb1d2526ef2ad8bfc1974a7b4bc6377ea685f5740056325e76b4edb4f9->leave($__internal_554d52fb1d2526ef2ad8bfc1974a7b4bc6377ea685f5740056325e76b4edb4f9_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_54f4b970d98bd2c97bf6797c70c664625b19010cb50d836018519a194d45f4d2 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_54f4b970d98bd2c97bf6797c70c664625b19010cb50d836018519a194d45f4d2->enter($__internal_54f4b970d98bd2c97bf6797c70c664625b19010cb50d836018519a194d45f4d2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_42acf6b1160867ed26f0c259ec4ab02065c6e2d558d39f2ee32919497b633df8 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_42acf6b1160867ed26f0c259ec4ab02065c6e2d558d39f2ee32919497b633df8->enter($__internal_42acf6b1160867ed26f0c259ec4ab02065c6e2d558d39f2ee32919497b633df8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_42acf6b1160867ed26f0c259ec4ab02065c6e2d558d39f2ee32919497b633df8->leave($__internal_42acf6b1160867ed26f0c259ec4ab02065c6e2d558d39f2ee32919497b633df8_prof);

        
        $__internal_54f4b970d98bd2c97bf6797c70c664625b19010cb50d836018519a194d45f4d2->leave($__internal_54f4b970d98bd2c97bf6797c70c664625b19010cb50d836018519a194d45f4d2_prof);

    }

    // line 10
    public function block_body($context, array $blocks = array())
    {
        $__internal_9d33e747312a90c62569cfac50010937cd48254fde86744d3ad7ff5e9d6dc42d = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_9d33e747312a90c62569cfac50010937cd48254fde86744d3ad7ff5e9d6dc42d->enter($__internal_9d33e747312a90c62569cfac50010937cd48254fde86744d3ad7ff5e9d6dc42d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        $__internal_13cf2ffc2b8fe6d238e463b63ba86164ed81607665673d4bfe3a2fe89306fe62 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_13cf2ffc2b8fe6d238e463b63ba86164ed81607665673d4bfe3a2fe89306fe62->enter($__internal_13cf2ffc2b8fe6d238e463b63ba86164ed81607665673d4bfe3a2fe89306fe62_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_13cf2ffc2b8fe6d238e463b63ba86164ed81607665673d4bfe3a2fe89306fe62->leave($__internal_13cf2ffc2b8fe6d238e463b63ba86164ed81607665673d4bfe3a2fe89306fe62_prof);

        
        $__internal_9d33e747312a90c62569cfac50010937cd48254fde86744d3ad7ff5e9d6dc42d->leave($__internal_9d33e747312a90c62569cfac50010937cd48254fde86744d3ad7ff5e9d6dc42d_prof);

    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_2273860c87c475726cb86fad96bdd290a286b8f34938591a450c490cfaa867ce = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_2273860c87c475726cb86fad96bdd290a286b8f34938591a450c490cfaa867ce->enter($__internal_2273860c87c475726cb86fad96bdd290a286b8f34938591a450c490cfaa867ce_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_365cada409ccc156c2859700a3e8cf0d364617b898a11bbc22cc477a3856e6d1 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_365cada409ccc156c2859700a3e8cf0d364617b898a11bbc22cc477a3856e6d1->enter($__internal_365cada409ccc156c2859700a3e8cf0d364617b898a11bbc22cc477a3856e6d1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_365cada409ccc156c2859700a3e8cf0d364617b898a11bbc22cc477a3856e6d1->leave($__internal_365cada409ccc156c2859700a3e8cf0d364617b898a11bbc22cc477a3856e6d1_prof);

        
        $__internal_2273860c87c475726cb86fad96bdd290a286b8f34938591a450c490cfaa867ce->leave($__internal_2273860c87c475726cb86fad96bdd290a286b8f34938591a450c490cfaa867ce_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  117 => 11,  100 => 10,  83 => 6,  65 => 5,  53 => 12,  50 => 11,  48 => 10,  41 => 7,  39 => 6,  35 => 5,  29 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>{% block title %}Welcome!{% endblock %}</title>
        {% block stylesheets %}{% endblock %}
        <link rel=\"icon\" type=\"image/x-icon\" href=\"{{ asset('favicon.ico') }}\" />
    </head>
    <body>
        {% block body %}{% endblock %}
        {% block javascripts %}{% endblock %}
    </body>
</html>
", "base.html.twig", "C:\\xampp\\htdocs\\bbt\\app\\Resources\\views\\base.html.twig");
    }
}
