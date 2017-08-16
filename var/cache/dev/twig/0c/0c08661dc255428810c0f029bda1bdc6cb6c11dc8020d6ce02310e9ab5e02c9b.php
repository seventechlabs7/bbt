<?php

/* staff/index.html.twig */
class __TwigTemplate_4e3398888e98a231ce13971a2cd302244a79b915634e93787245c3c43bfde0a0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_af28c979afbbd64506e34b47ab2291e9a437cb443da8dc5b6da5a0ee5bbd9097 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_af28c979afbbd64506e34b47ab2291e9a437cb443da8dc5b6da5a0ee5bbd9097->enter($__internal_af28c979afbbd64506e34b47ab2291e9a437cb443da8dc5b6da5a0ee5bbd9097_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "staff/index.html.twig"));

        $__internal_33d879007230262473f32699a8c5a80b575455426e186c271ca3db9335216d90 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_33d879007230262473f32699a8c5a80b575455426e186c271ca3db9335216d90->enter($__internal_33d879007230262473f32699a8c5a80b575455426e186c271ca3db9335216d90_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "staff/index.html.twig"));

        // line 1
        echo "

<!DOCTYPE html>
<html lang=\"en\" ng-app=\"app\" >

<head>
    
   <title>BBT</title>
   ";
        // line 9
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 18
        echo "
    ";
        // line 19
        $this->displayBlock('javascripts', $context, $blocks);
        // line 70
        echo "

</head>

<body ng-controller=\"AppCtrl\">

";
        // line 76
        echo twig_include($this->env, $context, "staff/partials/home.html.twig");
        echo "

    

</body>

</html>
";
        
        $__internal_af28c979afbbd64506e34b47ab2291e9a437cb443da8dc5b6da5a0ee5bbd9097->leave($__internal_af28c979afbbd64506e34b47ab2291e9a437cb443da8dc5b6da5a0ee5bbd9097_prof);

        
        $__internal_33d879007230262473f32699a8c5a80b575455426e186c271ca3db9335216d90->leave($__internal_33d879007230262473f32699a8c5a80b575455426e186c271ca3db9335216d90_prof);

    }

    // line 9
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_6736541a7811d25d27a4e62f319739922a82aa7ce496b9977c4191bc90f2fc67 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_6736541a7811d25d27a4e62f319739922a82aa7ce496b9977c4191bc90f2fc67->enter($__internal_6736541a7811d25d27a4e62f319739922a82aa7ce496b9977c4191bc90f2fc67_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_46afb4012e31ce1be91b6ad091ad9208d00dea79cc44ff14beb37d19a50fe1e9 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_46afb4012e31ce1be91b6ad091ad9208d00dea79cc44ff14beb37d19a50fe1e9->enter($__internal_46afb4012e31ce1be91b6ad091ad9208d00dea79cc44ff14beb37d19a50fe1e9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 10
        echo "       <link  rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("css/bootstrap.css"), "html", null, true);
        echo "\">
       <link  rel=\"stylesheet\" href=\"css/font-awesome.min.css\" >
       <link  rel=\"stylesheet\" href=\"css/angular-chart.css\" >
       <link  rel=\"stylesheet\" type=\"text/css\" href=\"css/ng-table.min.css\">
       <link  rel=\"stylesheet\" href=\"css/easytabs.css\">
       <link  rel=\"stylesheet\" href=\"css/main.css\">
       <link rel=\"stylesheet\" type=\"text/css\" href=\"bower_components/angular-notify/dist/angular-notify.min.css\" />
    ";
        
        $__internal_46afb4012e31ce1be91b6ad091ad9208d00dea79cc44ff14beb37d19a50fe1e9->leave($__internal_46afb4012e31ce1be91b6ad091ad9208d00dea79cc44ff14beb37d19a50fe1e9_prof);

        
        $__internal_6736541a7811d25d27a4e62f319739922a82aa7ce496b9977c4191bc90f2fc67->leave($__internal_6736541a7811d25d27a4e62f319739922a82aa7ce496b9977c4191bc90f2fc67_prof);

    }

    // line 19
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_2b2701417479fb3cf0bd2222903b2c09b7a2e95c51b59f60592f84e44c2c2c44 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_2b2701417479fb3cf0bd2222903b2c09b7a2e95c51b59f60592f84e44c2c2c44->enter($__internal_2b2701417479fb3cf0bd2222903b2c09b7a2e95c51b59f60592f84e44c2c2c44_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_bae0993a519c38d33551f4d85cb120ab81f406ac8dbeeed2fc46be975e0e3e34 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_bae0993a519c38d33551f4d85cb120ab81f406ac8dbeeed2fc46be975e0e3e34->enter($__internal_bae0993a519c38d33551f4d85cb120ab81f406ac8dbeeed2fc46be975e0e3e34_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 20
        echo "    
    <!--Javascript Frameworks-->
    <script  src=\"js/jquery-2.0.3.min.js\"></script>
    <script  src=\"js/jquery.validate.min.js\"></script>
    <script  src=\"js/angular.min.js\"></script>
    <script  src=\"js/bootstrap.min.js\"></script>
    <!--Bootstrap Dependencies-->
    <!-- <script  src=\"js/bootstrap-datepicker.js\"></script> -->
    <script  src=\"js/moment.min.js\"></script>
    <script  src=\"js/bootstrap-datetimepicker.min.js\"></script>


    <!--Angular Dependencies-->
    <script  src=\"js/angular-sanitize.min.js\"></script>
    <script  src=\"js/angular-touch.min.js\"></script>
    <script  src=\"js/ui-bootstrap-tpls.js\"></script>
    <script  src=\"js/angular-ui-router.min.js\"></script>
    <script  src=\"js/ocLazyLoad.min.js\"></script>
    <script  src=\"js/ui-utils.min.js\"></script>
    <script  src=\"js/angular-inview.js\"></script>

    <script  src=\"js/app.js\"></script>
    <script  src=\"js/app.config.js\"></script>
    <script  src=\"js/app.lazyload.js\"></script>
    <!-- <script  src=\"js/app.router.js\"></script> -->
    <script  src=\"js/jq/chart.js\"></script>
    <script  src=\"js/jq/chartconfig.js\"></script>
    <script  src=\"js/jq/legend.js\"></script>
    <script  src=\"js/jq/moment.js\"></script>
    <script  src=\"js/directives/easytabs.js\"></script>
    <script  src=\"js/app.main.js\"></script>

    <script  src=\"js/services/ui-load.js\"></script>
    <script  src=\"js/directives/ui-jq.js\"></script>
    <script  src=\"js/directives/ui-module.js\"></script>
    <script  src=\"js/directives/d3.js\"></script>
    <script  src=\"js/directives/ng-knob.js\"></script>
    <script  src=\"js/directives/progressbar.js\"></script>
    <script  src=\"js/directives/angular-chart.js\"></script>
    <script  src=\"js/directives/ng-table.min.js\"></script>
    <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyDhK2HA-8bKkZpmb8BetOtwiXy6k9eNfdM'></script>
    <script  src=\"js/directives/lodash.js\"></script>
    <script  src=\"js/directives/angular-simple-logger.js\"></script>
    <script  src=\"js/directives/angular-google-maps.min.js\"></script>
    <script  src=\"js/directives/infobox.js\"></script>
    <script  src=\"bower_components/ng-file-upload/ng-file-upload-shim.min.js\"></script>
    <script  src=\"bower_components/ng-file-upload/ng-file-upload.min.js\"></script>
    <script src=\"bower_components/angular-notify/dist/angular-notify.min.js\"></script>

    ";
        
        $__internal_bae0993a519c38d33551f4d85cb120ab81f406ac8dbeeed2fc46be975e0e3e34->leave($__internal_bae0993a519c38d33551f4d85cb120ab81f406ac8dbeeed2fc46be975e0e3e34_prof);

        
        $__internal_2b2701417479fb3cf0bd2222903b2c09b7a2e95c51b59f60592f84e44c2c2c44->leave($__internal_2b2701417479fb3cf0bd2222903b2c09b7a2e95c51b59f60592f84e44c2c2c44_prof);

    }

    public function getTemplateName()
    {
        return "staff/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  107 => 20,  98 => 19,  79 => 10,  70 => 9,  52 => 76,  44 => 70,  42 => 19,  39 => 18,  37 => 9,  27 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("

<!DOCTYPE html>
<html lang=\"en\" ng-app=\"app\" >

<head>
    
   <title>BBT</title>
   {% block stylesheets %}
       <link  rel=\"stylesheet\" href=\"{{ asset('css/bootstrap.css') }}\">
       <link  rel=\"stylesheet\" href=\"css/font-awesome.min.css\" >
       <link  rel=\"stylesheet\" href=\"css/angular-chart.css\" >
       <link  rel=\"stylesheet\" type=\"text/css\" href=\"css/ng-table.min.css\">
       <link  rel=\"stylesheet\" href=\"css/easytabs.css\">
       <link  rel=\"stylesheet\" href=\"css/main.css\">
       <link rel=\"stylesheet\" type=\"text/css\" href=\"bower_components/angular-notify/dist/angular-notify.min.css\" />
    {% endblock %}

    {% block javascripts %}
    
    <!--Javascript Frameworks-->
    <script  src=\"js/jquery-2.0.3.min.js\"></script>
    <script  src=\"js/jquery.validate.min.js\"></script>
    <script  src=\"js/angular.min.js\"></script>
    <script  src=\"js/bootstrap.min.js\"></script>
    <!--Bootstrap Dependencies-->
    <!-- <script  src=\"js/bootstrap-datepicker.js\"></script> -->
    <script  src=\"js/moment.min.js\"></script>
    <script  src=\"js/bootstrap-datetimepicker.min.js\"></script>


    <!--Angular Dependencies-->
    <script  src=\"js/angular-sanitize.min.js\"></script>
    <script  src=\"js/angular-touch.min.js\"></script>
    <script  src=\"js/ui-bootstrap-tpls.js\"></script>
    <script  src=\"js/angular-ui-router.min.js\"></script>
    <script  src=\"js/ocLazyLoad.min.js\"></script>
    <script  src=\"js/ui-utils.min.js\"></script>
    <script  src=\"js/angular-inview.js\"></script>

    <script  src=\"js/app.js\"></script>
    <script  src=\"js/app.config.js\"></script>
    <script  src=\"js/app.lazyload.js\"></script>
    <!-- <script  src=\"js/app.router.js\"></script> -->
    <script  src=\"js/jq/chart.js\"></script>
    <script  src=\"js/jq/chartconfig.js\"></script>
    <script  src=\"js/jq/legend.js\"></script>
    <script  src=\"js/jq/moment.js\"></script>
    <script  src=\"js/directives/easytabs.js\"></script>
    <script  src=\"js/app.main.js\"></script>

    <script  src=\"js/services/ui-load.js\"></script>
    <script  src=\"js/directives/ui-jq.js\"></script>
    <script  src=\"js/directives/ui-module.js\"></script>
    <script  src=\"js/directives/d3.js\"></script>
    <script  src=\"js/directives/ng-knob.js\"></script>
    <script  src=\"js/directives/progressbar.js\"></script>
    <script  src=\"js/directives/angular-chart.js\"></script>
    <script  src=\"js/directives/ng-table.min.js\"></script>
    <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyDhK2HA-8bKkZpmb8BetOtwiXy6k9eNfdM'></script>
    <script  src=\"js/directives/lodash.js\"></script>
    <script  src=\"js/directives/angular-simple-logger.js\"></script>
    <script  src=\"js/directives/angular-google-maps.min.js\"></script>
    <script  src=\"js/directives/infobox.js\"></script>
    <script  src=\"bower_components/ng-file-upload/ng-file-upload-shim.min.js\"></script>
    <script  src=\"bower_components/ng-file-upload/ng-file-upload.min.js\"></script>
    <script src=\"bower_components/angular-notify/dist/angular-notify.min.js\"></script>

    {% endblock %}


</head>

<body ng-controller=\"AppCtrl\">

{{ include('staff/partials/home.html.twig') }}

    

</body>

</html>
", "staff/index.html.twig", "C:\\xampp\\htdocs\\bbt\\app\\Resources\\views\\staff\\index.html.twig");
    }
}
