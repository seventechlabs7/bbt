<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdProjectContainerUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request;
        $requestMethod = $canonicalMethod = $context->getMethod();
        $scheme = $context->getScheme();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }


        // homepage
        if ('' === $trimmedPathinfo) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'homepage');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',);
        }

        // app_lucky_number
        if ('/lucky/number' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\LuckyController::numberAction',  '_route' => 'app_lucky_number',);
        }

        // app_lucky_insert
        if ('/insert' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\LuckyController::insert',  '_route' => 'app_lucky_insert',);
        }

        // home
        if ('/home' === $pathinfo) {
            return array (  '_controller' => 'AppBundle\\Controller\\UniversityController::homeAction',  '_route' => 'home',);
        }

        // teachersignup
        if ('/api/teacher/signup' === $pathinfo) {
            if ('POST' !== $canonicalMethod) {
                $allow[] = 'POST';
                goto not_teachersignup;
            }

            return array (  '_controller' => 'AppBundle\\Controller\\UniversityController::signupTeacherAction',  '_route' => 'teachersignup',);
        }
        not_teachersignup:

        // saveteacher
        if ('/api/saveteacher' === $pathinfo) {
            if ('POST' !== $canonicalMethod) {
                $allow[] = 'POST';
                goto not_saveteacher;
            }

            return array (  '_controller' => 'AppBundle\\Controller\\UniversityController::saveTeacherAction',  '_route' => 'saveteacher',);
        }
        not_saveteacher:

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
