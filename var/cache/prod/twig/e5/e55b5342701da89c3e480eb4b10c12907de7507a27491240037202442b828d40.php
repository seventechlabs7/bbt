<?php

/* staff/index.html.twig */
class __TwigTemplate_73a7c52cf16cd7df944fb8cddaaa19c1dae2ccfa8e3222e8be74dcc9abef1f4e extends Twig_Template
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
    }

    // line 9
    public function block_stylesheets($context, array $blocks = array())
    {
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
    }

    // line 19
    public function block_javascripts($context, array $blocks = array())
    {
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
        return array (  77 => 20,  74 => 19,  61 => 10,  58 => 9,  46 => 76,  38 => 70,  36 => 19,  33 => 18,  31 => 9,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "staff/index.html.twig", "C:\\xampp\\htdocs\\bbt\\app\\Resources\\views\\staff\\index.html.twig");
    }
}
