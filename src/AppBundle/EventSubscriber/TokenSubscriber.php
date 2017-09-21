<?php
namespace AppBundle\EventSubscriber;

use AppBundle\Controller\TokenAuthenticatedController;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\AuthorizationHeaderTokenExtractor;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Doctrine\ORM\EntityManager;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class TokenSubscriber implements EventSubscriberInterface
{
   /**
     * @var JWTEncoderInterface
     */
    private $jwtEncoder;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @param JWTEncoderInterface $jwtEncoder
     * @param EntityManager       $em
     */
    public function __construct(JWTEncoderInterface $jwtEncoder, EntityManager $em)
    {
        $this->jwtEncoder = $jwtEncoder;
        $this->em = $em;
    }


    public function onKernelController(FilterControllerEvent $event)
    {
       // session_start();
           
        $controller = $event->getController();

        /*
         * $controller passed can be either a class or a Closure.
         * This is not usual in Symfony but it may happen.
         * If it is a class, it comes in array format
         */
/*        if (!is_array($controller)) {
            return;
        }
         if (isset($_SESSION['user_email'])) {

   } else {
      throw new AccessDeniedHttpException('This action needs a valid token!');
   }*/
        if ($controller[0] instanceof TokenAuthenticatedController) {
              $extractor = new AuthorizationHeaderTokenExtractor(
             'Bearer',
            'Authorization'
           
        );

        $token = $extractor->extract($event->getRequest());
       

        if (!$token) {
             throw new AccessDeniedHttpException('This action needs a valid token!');
        }
 
         $data = $this->jwtEncoder->decode($token);
        $user = $this->em->getRepository('AppBundle:UserPurchaseHistory')
            ->authenticate($data['username']);

            if(!$user)
                throw new AccessDeniedHttpException('This action needs a valid token!');
            /*else
            {
                if($user["email"] != $_SESSION['user_email'])
                    throw new AccessDeniedHttpException('This action needs a valid token!');
            }*/
          /*  $token = $event->getRequest()->query->get('token');
            if (!in_array($token, $this->tokens)) {
                throw new AccessDeniedHttpException('This action needs a valid token!');
            }*/
        }
    }

    public function onKernelResponse(FilterResponseEvent $event)
{
 
}

public static function getSubscribedEvents()
{
    return array(
        KernelEvents::CONTROLLER => 'onKernelController',
        KernelEvents::RESPONSE => 'onKernelResponse',
    );
}

   
}