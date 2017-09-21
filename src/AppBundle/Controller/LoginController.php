<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use AppBundle\Entity\User;
use AppBundle\Service\MyUserManager;
use AppBundle\Service\BbtCrypt;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class LoginController extends Controller
{
    use \AppBundle\Helper\ControllerHelper;

     public function loginAction(Request $request,BbtCrypt $bbtCrypt)
    {
        session_start();
        $reqData = $request->request->all();
        $userName = $reqData['email'];
        $password = $reqData['password'];
        $encpassword = $bbtCrypt->decrypt($password);
        $encoder = new MessageDigestPasswordEncoder();
        $pwencoded = $encoder->encodePassword($password, '');

          $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('AppBundle:UserPurchaseHistory')
            ->authenticate($userName);
        //return new JsonResponse($result);
        if (!$user) {
             $teacherFind = $em->getRepository('AppBundle:Teacher')->findOneByEmail($userName);
             if($teacherFind)
             {
                return new JsonResponse(array('status' => 'failure','reason' => 'Inactive account . Plesae activate link shared to your registered email id','response' => 200));
             }
             else
             {
                 $studentfind = $em->getRepository('AppBundle:GroupEmail')->findOneByEmail($userName);
                  if($studentfind)
                 {
                    return new JsonResponse(array('status' => 'failure','reason' => 'Inactive account . Plesae activate link shared to your registered email id','response' => 200));
                 }
             }
             
            return new JsonResponse(array('status' => 'failure','reason' => 'Invalid User','response' => 200));
           // throw $this->createNotFoundException();
        }
 
      /*  $isValid = $this->get('security.password_encoder')
            ->isPasswordValid($user, $password);*/
            // return new JsonResponse($user['password']);
        $isValid =  $encoder->isPasswordValid($user['password'], $password ,'');
       
        if (!$isValid) {
           // throw new BadCredentialsException();
            return new JsonResponse(array('status' => 'failure','reason' => 'Invalid Credentials','response' => 404));
        }
    $user1 = $em->getRepository('AppBundle:UserPurchaseHistory')
            ->getTeacherId($userName);
    $token = $this->getToken($userName);
             // session_start(); 

              $_SESSION['user'] = $user1['id'];
              $_SESSION['user_email'] = $userName;

    $response = new Response($this->serialize(['status'=>'success','token' => $token,'id' =>$user1['id']]), Response::HTTP_OK);
 
    return $this->setBaseHeaders($response);
}
 
    /**
     * Returns token for user.
     *
     * @param User $user
     *
     * @return array
     */
    public function getToken($username)
    {
        return $this->container->get('lexik_jwt_authentication.encoder')
                ->encode([
                    'username' => $username,
                    'exp' => $this->getTokenExpiryDateTime(),
                ]);
    }
     
    /**
     * Returns token expiration datetime.
     *
     * @return string Unixtmestamp
     */
    private function getTokenExpiryDateTime()
    {
        $tokenTtl = $this->container->getParameter('lexik_jwt_authentication.token_ttl');
        $now = new \DateTime();
        $now->add(new \DateInterval('PT'.$tokenTtl.'S'));
     
        return $now->format('U');
}
}
