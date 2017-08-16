<?php

/* staff/partials/home.html.twig */
class __TwigTemplate_c6830fc60fd480d4a1ae637f40b0b1c6714824036673df3bc846a527111cdf8d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_8935e49602f7b7557d7dc6e10177e2f41f8451d942ecf011b5c4a3b29d496016 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_8935e49602f7b7557d7dc6e10177e2f41f8451d942ecf011b5c4a3b29d496016->enter($__internal_8935e49602f7b7557d7dc6e10177e2f41f8451d942ecf011b5c4a3b29d496016_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "staff/partials/home.html.twig"));

        $__internal_75ef0d71cf67367606d9215d925edebee829f1bec06ee64e75637247c991823c = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_75ef0d71cf67367606d9215d925edebee829f1bec06ee64e75637247c991823c->enter($__internal_75ef0d71cf67367606d9215d925edebee829f1bec06ee64e75637247c991823c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "staff/partials/home.html.twig"));

        // line 1
        echo "
<div ng-controller=\"homepage\">
\t
<!-- \t<div class=\"\">
\t\tProfile";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["profileName"]) ? $context["profileName"] : $this->getContext($context, "profileName")), "html", null, true);
        echo "
\t</div> -->
\t<div class=\"whole_container\">
\t\t<div class=\"header_container\">
\t\t\t<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-2\">
\t\t\t\t<div class=\"header_logo_cont\">
\t\t\t\t\t<div class=\"header_logo\">
\t\t\t\t\t\t<img src=\"imgs/logo.png\">
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-10\">
\t\t\t\t<div class=\"header_right_cont\">
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t<div class=\"col-lg-4 col-md-4 col-xs-12\">
\t\t\t\t\t\t\t<input type=\"\" name=\"\" placeholder=\"Email\" class=\"form_inputtext\">
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"col-lg-4 col-md-4 col-xs-12\">
\t\t\t\t\t\t\t<input type=\"\" name=\"\" placeholder=\"Password\" class=\"form_inputtext\">
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"col-lg-4 col-md-4 col-xs-12\">
\t\t\t\t\t\t\t<button class=\"head_login_but\">Log In</button>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t\t\t\t\t\t<div class=\"forgot_password_cont\">
\t\t\t\t\t\t\t\t<a href=\"javascript:void(0)\" class=\"forgotpass_text\">Forgot password?</a>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"body_container\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6\">
\t\t\t\t\t<div class=\"body_main_text\">
\t\t\t\t\t\t<h3>Your university is getting closer:</h3>
\t\t\t\t\t\t<ul class=\"body_main_ul\">
\t\t\t\t\t\t\t<li>Learn Finance</li>
\t\t\t\t\t\t\t<li>Practice in virtual Stock Exchange</li>
\t\t\t\t\t\t\t<li>Connect with people and companies</li>
\t\t\t\t\t\t</ul>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6\">
\t\t\t\t\t<div class=\"signup_page_form_cont\">
\t\t\t\t\t\t<div class=\"signup_form_card\">
\t\t\t\t\t\t\t<div class=\"card_header\">
\t\t\t\t\t\t\t\t<div class=\"card_header_text\"> 
\t\t\t\t\t\t\t\t\tSign up Teacher
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"card_header_button\">
\t\t\t\t\t\t\t\t\t<!-- <button class=\"card_header_btn\">Are You a teacher?</button> -->
\t\t\t\t\t\t\t\t\t<h5 class=\"form_text text-center\"> Specially Prepared for Teachers </h5>\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"card_body\">
\t\t\t\t\t\t\t\t<form action=\"javascript:;\" id=\"signup\" name=\"signup\" autocomplete=\"off\" novalidate>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form_input_cont\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form_inputtext\" placeholder=\"Name\" type=\"text\" ng-model=\"teacher.username\" name=\"username\" required>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form_input_cont\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form_inputtext\" placeholder=\"Surname\" type=\"text\" ng-model=\"teacher.surname\" name=\"surname\" required>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form_input_cont\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form_inputtext inp_full\" placeholder=\"Email\" type=\"email\" ng-model=\"teacher.email\" name=\"email\" required>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form_input_cont\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form_inputtext inp_full\" placeholder=\"Password\" type=\"password\" ng-model=\"teacher.password\" name=\"password\" required>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form_input_cont\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form_inputtext inp_full\" placeholder=\"University\" type=\"text\" ng-model=\"teacher.university\" name=\"university\" required>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<!-- <div class=\"form_h4_text\">
\t\t\t\t\t\t\t\t\tBirth Date
\t\t\t\t\t\t\t\t\t</div> -->
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<!-- <div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form_input_cont\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form_inputtext\" placeholder=\"Day\" type=\"text\" name=\"\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form_input_cont\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form_inputtext\" placeholder=\"Month\" type=\"text\" name=\"\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form_input_cont\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form_inputtext\" placeholder=\"Year\" type=\"text\" name=\"\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div> -->
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t\t\t\t\t\t\t\t\t<button class=\"form_submit_but\" ng-click=\"shiftTab(1);teacher_signup()\">Join now</button>
\t\t\t\t\t\t\t\t\t</div>
<!-- \t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t\t\t\t\t\t\t\t\t<h5 class=\"form_text text-center\"> - Or Sign up with - </h5>
\t\t\t\t\t\t\t\t\t</div> -->
<!-- \t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t\t\t\t\t\t\t\t\t<ul class=\"card_social_ul\">
\t\t\t\t\t\t\t\t\t\t\t<li class=\"social_li\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"social_cirlce\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-facebook\"></i>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t<li class=\"social_li\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"social_cirlce\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-linkedin\"></i>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t<li class=\"social_li\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"social_cirlce\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-google-plus\"></i>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t</div> -->
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"card_terms\">
\t\t\t\t\t\t\t\t\t\t\tBy clicking the join now button you agree with the cookies policy, the privacy policy and terms and conditions.
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</form>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>







<div class=\"container\">
<!--   <h2>Modal Example</h2> -->
  <!-- <button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#addStudent\">Open Modal</button> -->
  <div class=\"modal fade\" id=\"addStudent\" role=\"dialog\">
    <div class=\"modal-dialog\">   
      <div class=\"modal-content\">
        <div class=\"modal-header\">
          <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
<!--           <h4 class=\"modal-title\">Modal Header</h4> -->
          <ul class=\"step_head_ul\">
          \t<li class=\"step_head_li\" id=\"step_head_1\" data=\"1\">Step 1 of 3</li>
          \t<li class=\"step_head_li\" id=\"step_head_2\" data=\"2\">Step 2 of 3</li>
          \t<li class=\"step_head_li\" id=\"step_head_3\" data=\"3\">Step 3 of 3</li>
          </ul>
        </div>
        <div class=\"modal-body\">
        \t<div class=\"step_body_container\">
        \t\t<ul class=\"step_body_ul\">
        \t\t\t<li class=\"step_body_li\" id=\"step_body_1\">
        \t\t\t\t<div class=\"form_container\">
        \t\t\t\t\t<div class=\"form_head_text\">
        \t\t\t\t\t\tDo you have students? Add them
        \t\t\t\t\t</div>
        \t\t\t\t\t<div class=\"row\">
        \t\t\t\t\t\t<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-12\">
        \t\t\t\t\t\t\t<div class=\"row\">
        \t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t        \t\t\t\t\t\t\t<div class=\"input_upload\">
\t\t        \t\t\t\t\t\t\t\t<input type=\"text\" class=\"field_text\" placeholder=\"Copy and Paste your mailing list\" name=\"maillist\"  ng-model=\"teacher.mail_list\"/>
\t\t        \t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t        \t\t\t\t\t\t\t<div class=\"input_upload\">
\t\t        \t\t\t\t\t\t\t\t<input type=\"file\" class=\"upload_text\" placeholder=\"Find Your File(csv./other)\" name=\"maillistfile\" name=\"file\" ngf-select=\"selectFile(teacher.mail_list_file)\" ng-model=\"teacher.mail_list_file\"/>
\t\t        \t\t\t\t\t\t\t\t<button class=\"upload_button\">Upload</button>
\t\t        \t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t        \t\t\t\t\t\t\t\t<div class=\"form_head_text\">
\t\t\t\t        \t\t\t\t\t\tDo you have students? Add them
\t\t\t\t        \t\t\t\t\t</div>
\t\t\t\t        \t\t\t\t\t<div class=\"input_text\">
\t\t\t\t        \t\t\t\t\t\t<input type=\"text\" class=\"field_text\" placeholder=\"Name of the Group\" name=\"groupname\" ng-model=\"teacher.group_name\" />
\t\t\t\t        \t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t</div>
        \t\t\t\t\t\t<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-4\">
        \t\t\t\t\t\t\t<div class=\"modal_image_container\">
        \t\t\t\t\t\t\t\t<div class=\"modal_image\">
        \t\t\t\t\t\t\t\t\t<img src=\"\" class=\"modal_banner\">
        \t\t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t</div>
        \t\t\t\t\t</div>
        \t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
        \t\t\t\t\t\t<div class=\"modal_but_cont\">        \t\t\t\t\t\t\t
        \t\t\t\t\t\t\t<button class=\"modal_nxt_bt\" ng-click=\"shiftTab(2)\">Next</button>
        \t\t\t\t\t\t</div>
        \t\t\t\t\t</div>
        \t\t\t\t</div>
        \t\t\t</li>
        \t\t\t<li class=\"step_body_li\" id=\"step_body_2\">
        \t\t\t\t<div class=\"form_container\">
        \t\t\t\t\t<div class=\"form_head_text\">
        \t\t\t\t\t\tCreate a virtual bag league for your students:
        \t\t\t\t\t</div>
        \t\t\t\t\t<div class=\"row\">
        \t\t\t\t\t\t<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-8\">
\t        \t\t\t\t\t\t<div class=\"custom_num_list\">
\t        \t\t\t\t\t\t\t<ul class=\"cust_num_ul\"> 
\t        \t\t\t\t\t\t\t\t<li class=\"cust_num_li\">
\t        \t\t\t\t\t\t\t\t\t<div class=\"cust_list_q\">
\t        \t\t\t\t\t\t\t\t\t\t<span class=\"li_num\">1</span>
\t        \t\t\t\t\t\t\t\t\t\t<span class=\"li_q\">How long will it last for?</span>
\t        \t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t\t<div class=\"cust_list_ans\">         \t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"date\" class=\"date_form\" placeholder=\"Start Date\" name=\"maillistfile\" ng-model=\"teacher.start_date\" />
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"date\" class=\"date_form\" name=\"startdate\"  ng-model=\"teacher.end_date\"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t\t</div>       \t\t\t\t\t\t\t\t\t
\t        \t\t\t\t\t\t\t\t</li>
\t        \t\t\t\t\t\t\t\t<li class=\"cust_num_li\">
\t        \t\t\t\t\t\t\t\t\t<div class=\"cust_list_q\">
\t        \t\t\t\t\t\t\t\t\t\t<span class=\"li_num\">2</span>
\t        \t\t\t\t\t\t\t\t\t\t<span class=\"li_q\">Which assets do you want to have?</span>
\t        \t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t\t<div class=\"cust_list_ans\">         \t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"checkbox_cont\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"check_cont_ul\"> 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li> 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"check_label\">   
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"\" ng-checked=\"teacher.assets == 1\" ng-true-value=\"1\" ng-false-vlaue=\"0\" ng-model=\"teacher.assets\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"check_text\">Ibex35</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li> 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"check_label\">   
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"\" ng-checked=\"teacher.assets == 2\" ng-true-value=\"2\" ng-false-vlaue=\"0\" ng-model=\"teacher.assets\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"check_text\">Mercado continuo</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li> 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"check_label\">   
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"\" ng-checked=\"teacher.assets == 3\" ng-true-value=\"3\" ng-false-vlaue=\"0\" ng-model=\"teacher.assets\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"check_text\">Forex</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t\t</div>       \t\t\t\t\t\t\t\t\t
\t        \t\t\t\t\t\t\t\t</li>
\t        \t\t\t\t\t\t\t\t<li class=\"cust_num_li\">
\t        \t\t\t\t\t\t\t\t\t<div class=\"cust_list_q\">
\t        \t\t\t\t\t\t\t\t\t\t<span class=\"li_num\">3</span>
\t        \t\t\t\t\t\t\t\t\t\t<span class=\"li_q\">How do you want to call your league?</span>
\t        \t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t\t<div class=\"cust_list_ans\">
\t        \t\t\t\t\t\t\t\t\t\t<div class=\"row\">
\t        \t\t\t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t        \t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"field_text ft2 blue\" name=\"leaguename\" ng-model=\"teacher.league_name\" />
\t        \t\t\t\t\t\t\t\t\t\t\t</div>\t
\t        \t\t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t</li>
\t        \t\t\t\t\t\t\t\t<li class=\"cust_num_li\">
\t        \t\t\t\t\t\t\t\t\t<div class=\"cust_list_q\">
\t        \t\t\t\t\t\t\t\t\t\t<span class=\"li_num\">4</span>
\t        \t\t\t\t\t\t\t\t\t\t<span class=\"li_q\">Virtual money to start:</span>
\t        \t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t\t<div class=\"cust_list_ans\">
\t        \t\t\t\t\t\t\t\t\t\t<div class=\"row\">
\t        \t\t\t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t        \t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"field_text ft2 blue\"  placeholder=\"\" name=\"virtualmoney\" ng-model=\"teacher.virtual_money\" />
\t        \t\t\t\t\t\t\t\t\t\t\t</div>\t
\t        \t\t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t</li>
\t        \t\t\t\t\t\t\t</ul>
\t        \t\t\t\t\t\t</div>
        \t\t\t\t\t\t</div>
        \t\t\t\t\t\t<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-4\">
        \t\t\t\t\t\t\t<div class=\"modal_image_container\">
        \t\t\t\t\t\t\t\t<div class=\"modal_image\">
        \t\t\t\t\t\t\t\t\t<img src=\"\" class=\"modal_banner\">
        \t\t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t</div>
        \t\t\t\t\t</div>
        \t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
        \t\t\t\t\t\t<div class=\"modal_but_cont\">
        \t\t\t\t\t\t\t<button class=\"modal_nxt_bt\" ng-click=\"shiftTab(1)\">Back</button>
        \t\t\t\t\t\t\t<button class=\"modal_nxt_bt\" ng-click=\"shiftTab(3)\">Next</button>
        \t\t\t\t\t\t</div>
        \t\t\t\t\t</div>        \t\t\t\t\t
        \t\t\t\t</div>
        \t\t\t</li>
        \t\t\t<li class=\"step_body_li\" id=\"step_body_3\">
        \t\t\t\t<div class=\"form_container\">
        \t\t\t\t\t<div class=\"form_head_text\">
        \t\t\t\t\t\tWhat do you want to see?
        \t\t\t\t\t</div>
        \t\t\t\t\t<div class=\"row\">
        \t\t\t\t\t\t<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-12\">
        \t\t\t\t\t\t\t<div class=\"row\">
        \t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t        \t\t\t\t\t\t\t<div class=\"form_head_text\">
\t\t\t\t        \t\t\t\t\t\tSelect the Feedback.
\t\t\t\t        \t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t        \t\t\t\t\t\t\t\t<div class=\"checkbox_cont\">
\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"check_cont_ul\"> 
\t\t\t\t\t\t\t\t\t\t\t\t\t<li> 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"check_label\">   
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" ng-checked=\"teacher.feedback == 1\" ng-true-value=\"1\" ng-false-vlaue=\"0\" ng-model=\"teacher.feedback\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"check_text\">Benifits</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li> 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"check_label\">   
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" ng-checked=\"teacher.feedback == 2\" ng-true-value=\"2\" ng-false-vlaue=\"0\" ng-model=\"teacher.feedback\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"check_text\">Number of Operations</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li> 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"check_label\">   
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" ng-checked=\"teacher.feedback == 3\" ng-true-value=\"3\" ng-false-vlaue=\"0\" ng-model=\"teacher.feedback\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"check_text\">Total Profitability</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li> 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"check_label\">   
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" ng-checked=\"teacher.feedback == 4\" ng-true-value=\"4\" ng-false-vlaue=\"0\" ng-model=\"teacher.feedback\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"check_text\">Average Profability per person</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t</div>
        \t\t\t\t\t\t<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-4\">
        \t\t\t\t\t\t\t<div class=\"modal_image_container\">
        \t\t\t\t\t\t\t\t<div class=\"modal_image\">
        \t\t\t\t\t\t\t\t\t<img src=\"\" class=\"modal_banner\">
        \t\t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t</div>
        \t\t\t\t\t</div>
        \t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
        \t\t\t\t\t\t<div class=\"modal_but_cont\">
        \t\t\t\t\t\t\t<button class=\"modal_nxt_bt\" ng-click=\"shiftTab(2)\">Back</button>
        \t\t\t\t\t\t\t<button class=\"modal_nxt_bt\" ng-click=\"start()\">Start Now</button>
        \t\t\t\t\t\t</div>
        \t\t\t\t\t</div>
        \t\t\t\t</div>        \t\t\t\t
        \t\t\t</li>
        \t\t</ul>
        \t</div>
        </div>
<!--         <div class=\"modal-footer\">
          <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
        </div> -->
      </div>
    </div>
  </div>
  
</div>

</div>

";
        // line 402
        $this->displayBlock('javascripts', $context, $blocks);
        // line 406
        echo "  

";
        
        $__internal_8935e49602f7b7557d7dc6e10177e2f41f8451d942ecf011b5c4a3b29d496016->leave($__internal_8935e49602f7b7557d7dc6e10177e2f41f8451d942ecf011b5c4a3b29d496016_prof);

        
        $__internal_75ef0d71cf67367606d9215d925edebee829f1bec06ee64e75637247c991823c->leave($__internal_75ef0d71cf67367606d9215d925edebee829f1bec06ee64e75637247c991823c_prof);

    }

    // line 402
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_3e45696961774b05b055b837977e6c0b607522e1c68ff20a45f652c62f14b9e6 = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_3e45696961774b05b055b837977e6c0b607522e1c68ff20a45f652c62f14b9e6->enter($__internal_3e45696961774b05b055b837977e6c0b607522e1c68ff20a45f652c62f14b9e6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_c1b66e5d2686d73a6492138c48b5e67531bac2c684744c3ac5c19862433c408e = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_c1b66e5d2686d73a6492138c48b5e67531bac2c684744c3ac5c19862433c408e->enter($__internal_c1b66e5d2686d73a6492138c48b5e67531bac2c684744c3ac5c19862433c408e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 403
        echo "        
    <script  src=\"";
        // line 404
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/controllers/home.js"), "html", null, true);
        echo "\"></script>

";
        
        $__internal_c1b66e5d2686d73a6492138c48b5e67531bac2c684744c3ac5c19862433c408e->leave($__internal_c1b66e5d2686d73a6492138c48b5e67531bac2c684744c3ac5c19862433c408e_prof);

        
        $__internal_3e45696961774b05b055b837977e6c0b607522e1c68ff20a45f652c62f14b9e6->leave($__internal_3e45696961774b05b055b837977e6c0b607522e1c68ff20a45f652c62f14b9e6_prof);

    }

    public function getTemplateName()
    {
        return "staff/partials/home.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  458 => 404,  455 => 403,  446 => 402,  434 => 406,  432 => 402,  32 => 5,  26 => 1,);
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
<div ng-controller=\"homepage\">
\t
<!-- \t<div class=\"\">
\t\tProfile{{profileName}}
\t</div> -->
\t<div class=\"whole_container\">
\t\t<div class=\"header_container\">
\t\t\t<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-2\">
\t\t\t\t<div class=\"header_logo_cont\">
\t\t\t\t\t<div class=\"header_logo\">
\t\t\t\t\t\t<img src=\"imgs/logo.png\">
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-10\">
\t\t\t\t<div class=\"header_right_cont\">
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t<div class=\"col-lg-4 col-md-4 col-xs-12\">
\t\t\t\t\t\t\t<input type=\"\" name=\"\" placeholder=\"Email\" class=\"form_inputtext\">
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"col-lg-4 col-md-4 col-xs-12\">
\t\t\t\t\t\t\t<input type=\"\" name=\"\" placeholder=\"Password\" class=\"form_inputtext\">
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"col-lg-4 col-md-4 col-xs-12\">
\t\t\t\t\t\t\t<button class=\"head_login_but\">Log In</button>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t\t\t\t\t\t<div class=\"forgot_password_cont\">
\t\t\t\t\t\t\t\t<a href=\"javascript:void(0)\" class=\"forgotpass_text\">Forgot password?</a>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"body_container\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6\">
\t\t\t\t\t<div class=\"body_main_text\">
\t\t\t\t\t\t<h3>Your university is getting closer:</h3>
\t\t\t\t\t\t<ul class=\"body_main_ul\">
\t\t\t\t\t\t\t<li>Learn Finance</li>
\t\t\t\t\t\t\t<li>Practice in virtual Stock Exchange</li>
\t\t\t\t\t\t\t<li>Connect with people and companies</li>
\t\t\t\t\t\t</ul>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6\">
\t\t\t\t\t<div class=\"signup_page_form_cont\">
\t\t\t\t\t\t<div class=\"signup_form_card\">
\t\t\t\t\t\t\t<div class=\"card_header\">
\t\t\t\t\t\t\t\t<div class=\"card_header_text\"> 
\t\t\t\t\t\t\t\t\tSign up Teacher
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"card_header_button\">
\t\t\t\t\t\t\t\t\t<!-- <button class=\"card_header_btn\">Are You a teacher?</button> -->
\t\t\t\t\t\t\t\t\t<h5 class=\"form_text text-center\"> Specially Prepared for Teachers </h5>\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"card_body\">
\t\t\t\t\t\t\t\t<form action=\"javascript:;\" id=\"signup\" name=\"signup\" autocomplete=\"off\" novalidate>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form_input_cont\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form_inputtext\" placeholder=\"Name\" type=\"text\" ng-model=\"teacher.username\" name=\"username\" required>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form_input_cont\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form_inputtext\" placeholder=\"Surname\" type=\"text\" ng-model=\"teacher.surname\" name=\"surname\" required>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form_input_cont\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form_inputtext inp_full\" placeholder=\"Email\" type=\"email\" ng-model=\"teacher.email\" name=\"email\" required>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form_input_cont\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form_inputtext inp_full\" placeholder=\"Password\" type=\"password\" ng-model=\"teacher.password\" name=\"password\" required>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form_input_cont\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form_inputtext inp_full\" placeholder=\"University\" type=\"text\" ng-model=\"teacher.university\" name=\"university\" required>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<!-- <div class=\"form_h4_text\">
\t\t\t\t\t\t\t\t\tBirth Date
\t\t\t\t\t\t\t\t\t</div> -->
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<!-- <div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form_input_cont\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form_inputtext\" placeholder=\"Day\" type=\"text\" name=\"\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form_input_cont\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form_inputtext\" placeholder=\"Month\" type=\"text\" name=\"\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"form_input_cont\">
\t\t\t\t\t\t\t\t\t\t\t<input class=\"form_inputtext\" placeholder=\"Year\" type=\"text\" name=\"\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div> -->
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t\t\t\t\t\t\t\t\t<button class=\"form_submit_but\" ng-click=\"shiftTab(1);teacher_signup()\">Join now</button>
\t\t\t\t\t\t\t\t\t</div>
<!-- \t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t\t\t\t\t\t\t\t\t<h5 class=\"form_text text-center\"> - Or Sign up with - </h5>
\t\t\t\t\t\t\t\t\t</div> -->
<!-- \t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t\t\t\t\t\t\t\t\t<ul class=\"card_social_ul\">
\t\t\t\t\t\t\t\t\t\t\t<li class=\"social_li\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"social_cirlce\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-facebook\"></i>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t<li class=\"social_li\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"social_cirlce\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-linkedin\"></i>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t<li class=\"social_li\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"social_cirlce\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-google-plus\"></i>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t</div> -->
\t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t\t\t\t\t\t\t\t\t<div class=\"card_terms\">
\t\t\t\t\t\t\t\t\t\t\tBy clicking the join now button you agree with the cookies policy, the privacy policy and terms and conditions.
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</form>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>







<div class=\"container\">
<!--   <h2>Modal Example</h2> -->
  <!-- <button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#addStudent\">Open Modal</button> -->
  <div class=\"modal fade\" id=\"addStudent\" role=\"dialog\">
    <div class=\"modal-dialog\">   
      <div class=\"modal-content\">
        <div class=\"modal-header\">
          <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
<!--           <h4 class=\"modal-title\">Modal Header</h4> -->
          <ul class=\"step_head_ul\">
          \t<li class=\"step_head_li\" id=\"step_head_1\" data=\"1\">Step 1 of 3</li>
          \t<li class=\"step_head_li\" id=\"step_head_2\" data=\"2\">Step 2 of 3</li>
          \t<li class=\"step_head_li\" id=\"step_head_3\" data=\"3\">Step 3 of 3</li>
          </ul>
        </div>
        <div class=\"modal-body\">
        \t<div class=\"step_body_container\">
        \t\t<ul class=\"step_body_ul\">
        \t\t\t<li class=\"step_body_li\" id=\"step_body_1\">
        \t\t\t\t<div class=\"form_container\">
        \t\t\t\t\t<div class=\"form_head_text\">
        \t\t\t\t\t\tDo you have students? Add them
        \t\t\t\t\t</div>
        \t\t\t\t\t<div class=\"row\">
        \t\t\t\t\t\t<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-12\">
        \t\t\t\t\t\t\t<div class=\"row\">
        \t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t        \t\t\t\t\t\t\t<div class=\"input_upload\">
\t\t        \t\t\t\t\t\t\t\t<input type=\"text\" class=\"field_text\" placeholder=\"Copy and Paste your mailing list\" name=\"maillist\"  ng-model=\"teacher.mail_list\"/>
\t\t        \t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t        \t\t\t\t\t\t\t<div class=\"input_upload\">
\t\t        \t\t\t\t\t\t\t\t<input type=\"file\" class=\"upload_text\" placeholder=\"Find Your File(csv./other)\" name=\"maillistfile\" name=\"file\" ngf-select=\"selectFile(teacher.mail_list_file)\" ng-model=\"teacher.mail_list_file\"/>
\t\t        \t\t\t\t\t\t\t\t<button class=\"upload_button\">Upload</button>
\t\t        \t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t        \t\t\t\t\t\t\t\t<div class=\"form_head_text\">
\t\t\t\t        \t\t\t\t\t\tDo you have students? Add them
\t\t\t\t        \t\t\t\t\t</div>
\t\t\t\t        \t\t\t\t\t<div class=\"input_text\">
\t\t\t\t        \t\t\t\t\t\t<input type=\"text\" class=\"field_text\" placeholder=\"Name of the Group\" name=\"groupname\" ng-model=\"teacher.group_name\" />
\t\t\t\t        \t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t</div>
        \t\t\t\t\t\t<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-4\">
        \t\t\t\t\t\t\t<div class=\"modal_image_container\">
        \t\t\t\t\t\t\t\t<div class=\"modal_image\">
        \t\t\t\t\t\t\t\t\t<img src=\"\" class=\"modal_banner\">
        \t\t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t</div>
        \t\t\t\t\t</div>
        \t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
        \t\t\t\t\t\t<div class=\"modal_but_cont\">        \t\t\t\t\t\t\t
        \t\t\t\t\t\t\t<button class=\"modal_nxt_bt\" ng-click=\"shiftTab(2)\">Next</button>
        \t\t\t\t\t\t</div>
        \t\t\t\t\t</div>
        \t\t\t\t</div>
        \t\t\t</li>
        \t\t\t<li class=\"step_body_li\" id=\"step_body_2\">
        \t\t\t\t<div class=\"form_container\">
        \t\t\t\t\t<div class=\"form_head_text\">
        \t\t\t\t\t\tCreate a virtual bag league for your students:
        \t\t\t\t\t</div>
        \t\t\t\t\t<div class=\"row\">
        \t\t\t\t\t\t<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-8\">
\t        \t\t\t\t\t\t<div class=\"custom_num_list\">
\t        \t\t\t\t\t\t\t<ul class=\"cust_num_ul\"> 
\t        \t\t\t\t\t\t\t\t<li class=\"cust_num_li\">
\t        \t\t\t\t\t\t\t\t\t<div class=\"cust_list_q\">
\t        \t\t\t\t\t\t\t\t\t\t<span class=\"li_num\">1</span>
\t        \t\t\t\t\t\t\t\t\t\t<span class=\"li_q\">How long will it last for?</span>
\t        \t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t\t<div class=\"cust_list_ans\">         \t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"date\" class=\"date_form\" placeholder=\"Start Date\" name=\"maillistfile\" ng-model=\"teacher.start_date\" />
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"date\" class=\"date_form\" name=\"startdate\"  ng-model=\"teacher.end_date\"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t\t</div>       \t\t\t\t\t\t\t\t\t
\t        \t\t\t\t\t\t\t\t</li>
\t        \t\t\t\t\t\t\t\t<li class=\"cust_num_li\">
\t        \t\t\t\t\t\t\t\t\t<div class=\"cust_list_q\">
\t        \t\t\t\t\t\t\t\t\t\t<span class=\"li_num\">2</span>
\t        \t\t\t\t\t\t\t\t\t\t<span class=\"li_q\">Which assets do you want to have?</span>
\t        \t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t\t<div class=\"cust_list_ans\">         \t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"checkbox_cont\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"check_cont_ul\"> 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li> 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"check_label\">   
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"\" ng-checked=\"teacher.assets == 1\" ng-true-value=\"1\" ng-false-vlaue=\"0\" ng-model=\"teacher.assets\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"check_text\">Ibex35</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li> 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"check_label\">   
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"\" ng-checked=\"teacher.assets == 2\" ng-true-value=\"2\" ng-false-vlaue=\"0\" ng-model=\"teacher.assets\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"check_text\">Mercado continuo</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li> 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"check_label\">   
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"\" ng-checked=\"teacher.assets == 3\" ng-true-value=\"3\" ng-false-vlaue=\"0\" ng-model=\"teacher.assets\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"check_text\">Forex</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t\t</div>       \t\t\t\t\t\t\t\t\t
\t        \t\t\t\t\t\t\t\t</li>
\t        \t\t\t\t\t\t\t\t<li class=\"cust_num_li\">
\t        \t\t\t\t\t\t\t\t\t<div class=\"cust_list_q\">
\t        \t\t\t\t\t\t\t\t\t\t<span class=\"li_num\">3</span>
\t        \t\t\t\t\t\t\t\t\t\t<span class=\"li_q\">How do you want to call your league?</span>
\t        \t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t\t<div class=\"cust_list_ans\">
\t        \t\t\t\t\t\t\t\t\t\t<div class=\"row\">
\t        \t\t\t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t        \t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"field_text ft2 blue\" name=\"leaguename\" ng-model=\"teacher.league_name\" />
\t        \t\t\t\t\t\t\t\t\t\t\t</div>\t
\t        \t\t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t</li>
\t        \t\t\t\t\t\t\t\t<li class=\"cust_num_li\">
\t        \t\t\t\t\t\t\t\t\t<div class=\"cust_list_q\">
\t        \t\t\t\t\t\t\t\t\t\t<span class=\"li_num\">4</span>
\t        \t\t\t\t\t\t\t\t\t\t<span class=\"li_q\">Virtual money to start:</span>
\t        \t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t\t<div class=\"cust_list_ans\">
\t        \t\t\t\t\t\t\t\t\t\t<div class=\"row\">
\t        \t\t\t\t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t        \t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"field_text ft2 blue\"  placeholder=\"\" name=\"virtualmoney\" ng-model=\"teacher.virtual_money\" />
\t        \t\t\t\t\t\t\t\t\t\t\t</div>\t
\t        \t\t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t\t</li>
\t        \t\t\t\t\t\t\t</ul>
\t        \t\t\t\t\t\t</div>
        \t\t\t\t\t\t</div>
        \t\t\t\t\t\t<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-4\">
        \t\t\t\t\t\t\t<div class=\"modal_image_container\">
        \t\t\t\t\t\t\t\t<div class=\"modal_image\">
        \t\t\t\t\t\t\t\t\t<img src=\"\" class=\"modal_banner\">
        \t\t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t</div>
        \t\t\t\t\t</div>
        \t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
        \t\t\t\t\t\t<div class=\"modal_but_cont\">
        \t\t\t\t\t\t\t<button class=\"modal_nxt_bt\" ng-click=\"shiftTab(1)\">Back</button>
        \t\t\t\t\t\t\t<button class=\"modal_nxt_bt\" ng-click=\"shiftTab(3)\">Next</button>
        \t\t\t\t\t\t</div>
        \t\t\t\t\t</div>        \t\t\t\t\t
        \t\t\t\t</div>
        \t\t\t</li>
        \t\t\t<li class=\"step_body_li\" id=\"step_body_3\">
        \t\t\t\t<div class=\"form_container\">
        \t\t\t\t\t<div class=\"form_head_text\">
        \t\t\t\t\t\tWhat do you want to see?
        \t\t\t\t\t</div>
        \t\t\t\t\t<div class=\"row\">
        \t\t\t\t\t\t<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-12\">
        \t\t\t\t\t\t\t<div class=\"row\">
        \t\t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t\t        \t\t\t\t\t\t\t<div class=\"form_head_text\">
\t\t\t\t        \t\t\t\t\t\tSelect the Feedback.
\t\t\t\t        \t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
\t        \t\t\t\t\t\t\t\t<div class=\"checkbox_cont\">
\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"check_cont_ul\"> 
\t\t\t\t\t\t\t\t\t\t\t\t\t<li> 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"check_label\">   
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" ng-checked=\"teacher.feedback == 1\" ng-true-value=\"1\" ng-false-vlaue=\"0\" ng-model=\"teacher.feedback\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"check_text\">Benifits</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li> 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"check_label\">   
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" ng-checked=\"teacher.feedback == 2\" ng-true-value=\"2\" ng-false-vlaue=\"0\" ng-model=\"teacher.feedback\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"check_text\">Number of Operations</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li> 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"check_label\">   
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" ng-checked=\"teacher.feedback == 3\" ng-true-value=\"3\" ng-false-vlaue=\"0\" ng-model=\"teacher.feedback\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"check_text\">Total Profitability</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<li> 
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"check_label\">   
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" ng-checked=\"teacher.feedback == 4\" ng-true-value=\"4\" ng-false-vlaue=\"0\" ng-model=\"teacher.feedback\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"check_text\">Average Profability per person</span>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t        \t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t</div>
        \t\t\t\t\t\t<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-4\">
        \t\t\t\t\t\t\t<div class=\"modal_image_container\">
        \t\t\t\t\t\t\t\t<div class=\"modal_image\">
        \t\t\t\t\t\t\t\t\t<img src=\"\" class=\"modal_banner\">
        \t\t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t\t</div>
        \t\t\t\t\t\t</div>
        \t\t\t\t\t</div>
        \t\t\t\t\t<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
        \t\t\t\t\t\t<div class=\"modal_but_cont\">
        \t\t\t\t\t\t\t<button class=\"modal_nxt_bt\" ng-click=\"shiftTab(2)\">Back</button>
        \t\t\t\t\t\t\t<button class=\"modal_nxt_bt\" ng-click=\"start()\">Start Now</button>
        \t\t\t\t\t\t</div>
        \t\t\t\t\t</div>
        \t\t\t\t</div>        \t\t\t\t
        \t\t\t</li>
        \t\t</ul>
        \t</div>
        </div>
<!--         <div class=\"modal-footer\">
          <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
        </div> -->
      </div>
    </div>
  </div>
  
</div>

</div>

{% block javascripts %}
        
    <script  src=\"{{ asset('js/controllers/home.js') }}\"></script>

{% endblock %}  

", "staff/partials/home.html.twig", "C:\\xampp\\htdocs\\bbt\\app\\Resources\\views\\staff\\partials\\home.html.twig");
    }
}
