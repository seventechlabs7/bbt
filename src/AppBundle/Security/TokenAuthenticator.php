<?php

namespace AppBundle\Security;

use Doctrine\ORM\EntityManager;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\AuthorizationHeaderTokenExtractor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use AppBundle\Entity\User;

class TokenAuthenticator extends AbstractGuardAuthenticator
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

    /**
     * @inheritdoc
     */
    public function getCredentials(Request $request)
    {
        $extractor = new AuthorizationHeaderTokenExtractor(
             'Bearer',
            'Authorization'
           
        );

        $token = $extractor->extract($request);
       // var_dump($token);

        if (!$token) {
            return;
        }

        return $token;
    }

    /**
     * @inheritdoc
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $data = $this->jwtEncoder->decode($credentials);
       // var_dump($data);
        if ($data === false) {
            throw new CustomUserMessageAuthenticationException('Invalid Token');
        }

        $username = $data['username'];

         //METHOD 1 

        /*$user =  $this->em
            ->getRepository('AppBundle:User')
            ->findOneBy(['email' => $username]);*/

            // = $this->getDoctrine()->getManager();

            //method 2

            /*$user = $this->em->getRepository('AppBundle:UserOperations')
            ->authenticate($username);
            var_dump($user);
            $u = new User();
            if($user)
            {
                $u->setEmail($user["email"]);
                $u->setPassword($user['password']);
                $u->setUsername($user['email']);
                return $u;
            }
            var_dump($u);
            return $u;*/

            //method 3
             $user =  $this->em->getRepository('AppBundle:User')->createQueryBuilder('u')
            ->andWhere('u.email= :email')
            ->setParameter('email', $username)
           /* ->select('u.email ,u.username,u.password')*/
            ->getQuery()
            ->getScalarResult();
            var_dump($user);
    }

    /**
     * @inheritdoc
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
    }

    /**
     * @inheritdoc
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
    }

    /**
     * @inheritdoc
     */
    public function supportsRememberMe()
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new Response('Token is missing!', Response::HTTP_UNAUTHORIZED);
    }
}
