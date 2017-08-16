<?php

/* @Twig/layout.html.twig */
class __TwigTemplate_296e4a3fa61bac1f045b59482fe4f8e6a48cceea7677469536bbe1cd34806d74 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'head' => array($this, 'block_head'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_23aac6e1c5cf15a2f4b9fd0b1998e6e5d9361ba2985c5c8c4a85666143087356 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_23aac6e1c5cf15a2f4b9fd0b1998e6e5d9361ba2985c5c8c4a85666143087356->enter($__internal_23aac6e1c5cf15a2f4b9fd0b1998e6e5d9361ba2985c5c8c4a85666143087356_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/layout.html.twig"));

        $__internal_90d792383d4a00b9b6974ecaaa943c8cbc9b929a7cbd64308accd1e592115a91 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_90d792383d4a00b9b6974ecaaa943c8cbc9b929a7cbd64308accd1e592115a91->enter($__internal_90d792383d4a00b9b6974ecaaa943c8cbc9b929a7cbd64308accd1e592115a91_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/layout.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getCharset(), "html", null, true);
        echo "\" />
        <meta name=\"robots\" content=\"noindex,nofollow\" />
        <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\" />
        <title>";
        // line 7
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 8
        echo twig_include($this->env, $context, "@Twig/images/favicon.png.base64");
        echo "\">
        <style>";
        // line 9
        echo twig_include($this->env, $context, "@Twig/exception.css.twig");
        echo "</style>
        ";
        // line 10
        $this->displayBlock('head', $context, $blocks);
        // line 11
        echo "    </head>
    <body>
        <header>
            <div class=\"container\">
                <h1 class=\"logo\">";
        // line 15
        echo twig_include($this->env, $context, "@Twig/images/symfony-logo.svg");
        echo " Symfony Exception</h1>

                <div class=\"help-link\">
                    <a href=\"https://symfony.com/doc\">
                        <span class=\"icon\">";
        // line 19
        echo twig_include($this->env, $context, "@Twig/images/icon-book.svg");
        echo "</span>
                        <span class=\"hidden-xs-down\">Symfony</span> Docs
                    </a>
                </div>

                <div class=\"help-link\">
                    <a href=\"https://symfony.com/support\">
                        <span class=\"icon\">";
        // line 26
        echo twig_include($this->env, $context, "@Twig/images/icon-support.svg");
        echo "</span>
                        <span class=\"hidden-xs-down\">Symfony</span> Support
                    </a>
                </div>
            </div>
        </header>

        ";
        // line 33
        $this->displayBlock('body', $context, $blocks);
        // line 34
        echo "        ";
        echo twig_include($this->env, $context, "@Twig/base_js.html.twig");
        echo "
    </body>
</html>
";
        
        $__internal_23aac6e1c5cf15a2f4b9fd0b1998e6e5d9361ba2985c5c8c4a85666143087356->leave($__internal_23aac6e1c5cf15a2f4b9fd0b1998e6e5d9361ba2985c5c8c4a85666143087356_prof);

        
        $__internal_90d792383d4a00b9b6974ecaaa943c8cbc9b929a7cbd64308accd1e592115a91->leave($__internal_90d792383d4a00b9b6974ecaaa943c8cbc9b929a7cbd64308accd1e592115a91_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_4dc8342d90baea049a6a079a4931f70b0f65c0e239b48d5ace854e73684288b8 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_4dc8342d90baea049a6a079a4931f70b0f65c0e239b48d5ace854e73684288b8->enter($__internal_4dc8342d90baea049a6a079a4931f70b0f65c0e239b48d5ace854e73684288b8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        $__internal_66ddf3526e9eff63dd337c360be1bc46f1aaf4101420fbbad26959276ef64465 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_66ddf3526e9eff63dd337c360be1bc46f1aaf4101420fbbad26959276ef64465->enter($__internal_66ddf3526e9eff63dd337c360be1bc46f1aaf4101420fbbad26959276ef64465_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        
        $__internal_66ddf3526e9eff63dd337c360be1bc46f1aaf4101420fbbad26959276ef64465->leave($__internal_66ddf3526e9eff63dd337c360be1bc46f1aaf4101420fbbad26959276ef64465_prof);

        
        $__internal_4dc8342d90baea049a6a079a4931f70b0f65c0e239b48d5ace854e73684288b8->leave($__internal_4dc8342d90baea049a6a079a4931f70b0f65c0e239b48d5ace854e73684288b8_prof);

    }

    // line 10
    public function block_head($context, array $blocks = array())
    {
        $__internal_c462fa9632afe32f034c0e9828b96ddde200312589cf49480333f171e7e1b8d1 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_c462fa9632afe32f034c0e9828b96ddde200312589cf49480333f171e7e1b8d1->enter($__internal_c462fa9632afe32f034c0e9828b96ddde200312589cf49480333f171e7e1b8d1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        $__internal_de3a4b34fa1c860a9cbf5b3aaa850f6e25147179da463b9c82932bff2b18d188 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_de3a4b34fa1c860a9cbf5b3aaa850f6e25147179da463b9c82932bff2b18d188->enter($__internal_de3a4b34fa1c860a9cbf5b3aaa850f6e25147179da463b9c82932bff2b18d188_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        
        $__internal_de3a4b34fa1c860a9cbf5b3aaa850f6e25147179da463b9c82932bff2b18d188->leave($__internal_de3a4b34fa1c860a9cbf5b3aaa850f6e25147179da463b9c82932bff2b18d188_prof);

        
        $__internal_c462fa9632afe32f034c0e9828b96ddde200312589cf49480333f171e7e1b8d1->leave($__internal_c462fa9632afe32f034c0e9828b96ddde200312589cf49480333f171e7e1b8d1_prof);

    }

    // line 33
    public function block_body($context, array $blocks = array())
    {
        $__internal_32f1b5622d3a0d320f1e57e022f6b5014a54e2e388682034df8595fe2d77b2ea = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_32f1b5622d3a0d320f1e57e022f6b5014a54e2e388682034df8595fe2d77b2ea->enter($__internal_32f1b5622d3a0d320f1e57e022f6b5014a54e2e388682034df8595fe2d77b2ea_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        $__internal_a870aae56d6c51dbc6792013aafc3fd10f9cb00cf67d1a17a8d0e3e7d10e5251 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_a870aae56d6c51dbc6792013aafc3fd10f9cb00cf67d1a17a8d0e3e7d10e5251->enter($__internal_a870aae56d6c51dbc6792013aafc3fd10f9cb00cf67d1a17a8d0e3e7d10e5251_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_a870aae56d6c51dbc6792013aafc3fd10f9cb00cf67d1a17a8d0e3e7d10e5251->leave($__internal_a870aae56d6c51dbc6792013aafc3fd10f9cb00cf67d1a17a8d0e3e7d10e5251_prof);

        
        $__internal_32f1b5622d3a0d320f1e57e022f6b5014a54e2e388682034df8595fe2d77b2ea->leave($__internal_32f1b5622d3a0d320f1e57e022f6b5014a54e2e388682034df8595fe2d77b2ea_prof);

    }

    public function getTemplateName()
    {
        return "@Twig/layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  137 => 33,  120 => 10,  103 => 7,  88 => 34,  86 => 33,  76 => 26,  66 => 19,  59 => 15,  53 => 11,  51 => 10,  47 => 9,  43 => 8,  39 => 7,  33 => 4,  28 => 1,);
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
        <meta charset=\"{{ _charset }}\" />
        <meta name=\"robots\" content=\"noindex,nofollow\" />
        <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\" />
        <title>{% block title %}{% endblock %}</title>
        <link rel=\"icon\" type=\"image/png\" href=\"{{ include('@Twig/images/favicon.png.base64') }}\">
        <style>{{ include('@Twig/exception.css.twig') }}</style>
        {% block head %}{% endblock %}
    </head>
    <body>
        <header>
            <div class=\"container\">
                <h1 class=\"logo\">{{ include('@Twig/images/symfony-logo.svg') }} Symfony Exception</h1>

                <div class=\"help-link\">
                    <a href=\"https://symfony.com/doc\">
                        <span class=\"icon\">{{ include('@Twig/images/icon-book.svg') }}</span>
                        <span class=\"hidden-xs-down\">Symfony</span> Docs
                    </a>
                </div>

                <div class=\"help-link\">
                    <a href=\"https://symfony.com/support\">
                        <span class=\"icon\">{{ include('@Twig/images/icon-support.svg') }}</span>
                        <span class=\"hidden-xs-down\">Symfony</span> Support
                    </a>
                </div>
            </div>
        </header>

        {% block body %}{% endblock %}
        {{ include('@Twig/base_js.html.twig') }}
    </body>
</html>
", "@Twig/layout.html.twig", "C:\\xampp\\htdocs\\bbt\\vendor\\symfony\\symfony\\src\\Symfony\\Bundle\\TwigBundle\\Resources\\views\\layout.html.twig");
    }
}
