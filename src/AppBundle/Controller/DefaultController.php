<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Group;
use AppBundle\Entity\GroupEmail;
use AppBundle\Entity\GroupAsset;
use AppBundle\Entity\GroupFeedback;
use AppBundle\Entity\Teacher;
use AppBundle\Entity\BbtUser;
use AppBundle\Service\FileUploader;
use AppBundle\Service\MailerService;
use AppBundle\Service\CustomCrypt;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use AppBundle\Service\Utils;

class DefaultController extends Controller
{
       public function homeAction()
    {
        return $this->render('staff/index.html.twig', array(
            'profileName' => 'Admin',
        ));
    }

    public function signupTeacherAction(Request $request,MailerService $mailerService,CustomCrypt $crypt)
    {
        $teacher = $request->request->all();

        $emailvalidate =0;
        $emailCheck1 = $this->CheckDupeEmail($teacher['email']);
        if(!$emailCheck1)
            $emailvalidate =1;
        $teacher['username'] = ucfirst($teacher['username']);
        $teacher['surname'] = ucfirst($teacher['surname']);
        if($emailvalidate === 1){
            $em = $this->getDoctrine()->getManager();
            $TD = new Teacher();
            $TD->setName(ucfirst($teacher['username']));
            $TD->setSurname(ucfirst($teacher['surname']));
            $TD->setEmail($teacher['email']);
            $TD->setPassword($teacher['password']);
            $TD->setUniversity($teacher['university']);
            $TD->setCreated_by(1);
            $em->persist($TD);
            $em->flush();
            /*return $this->render('staff/partials/teacherprofile.html.twig', array(
            'profile' => $teacher,
                ));*/
            $mailObject = new \stdClass();
            $mailObject->toMail = $teacher['email'];
            $mailObject->name = $teacher['username'];
            $mailObject->type = 'teacher';
            $mailObject->encryptedLink = urlencode($crypt->encrypt($teacher['email']));

            $mailerService->indexAction($mailObject);
            return $this->json(array('status' => 'success','teacher_id' => $TD->getId(),'reason' => 'Teacher Saved Successfully . please verify your email','reaponse' => 200));
        }else{
            return $this->json(array('status' => 'failed','reason' => 'Email already Exists'));
        }
    }

       public function CheckDupeEmail($email)
    {
        $em1 = $this->getDoctrine()->getManager();

        $RAW_QUERY1 = 'SELECT email FROM group_emails where group_emails.email = :email LIMIT 1;';
        
        $statement1 = $em1->getConnection()->prepare($RAW_QUERY1);
        // Set parameters 
        $statement1->bindValue('email', $email);
        $statement1->execute();

        $result1 = $statement1->fetchAll();
        if(!$result1)
        {
            $em2 = $this->getDoctrine()->getManager();

            $RAW_QUERY2 = 'SELECT email FROM teachers where teachers.email = :email LIMIT 1;';
            
            $statement2 = $em2->getConnection()->prepare($RAW_QUERY2);
            // Set parameters 
            $statement2->bindValue('email', $email);
            $statement2->execute();

            $result2 = $statement2->fetchAll();
           
            if(!$result2)
            {
                $em3 = $this->getDoctrine()->getManager();

                $RAW_QUERY3 = 'SELECT email FROM users where users.email = :email LIMIT 1;';

                $statement3 = $em3->getConnection()->prepare($RAW_QUERY3);
                // Set parameters 
                $statement3->bindValue('email', $email);
                $statement3->execute();

                $result3 = $statement3->fetchAll();
                return $result3;
            }
             return $result2;
        }
        return $result1;
       /*$repository = $this->getDoctrine()->getRepository(GroupEmail::class);

       return $product = $repository->findOneByEmail('hello@hello.com');*/

    }
        public function CheckValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function verifySignupteacherAction(Request $request ,CustomCrypt $crypt,$verifyLink)
    {
        $email = $crypt->decrypt(urldecode($verifyLink));
        if($email)
        {
            $checkMail =    $this->CheckUserTable($email);
            if($checkMail)
            {
                return new JsonResponse("Error : Link Already verified !");
            }
            else
            {
                $em1 = $this->getDoctrine()->getManager();

                $RAW_QUERY1 = 'SELECT * FROM teachers where teachers.email = :email LIMIT 1;';

                $statement1 = $em1->getConnection()->prepare($RAW_QUERY1);
                // Set parameters 
                $statement1->bindValue('email', $email);
                $statement1->execute();
                $result1 = $statement1->fetch();
                
                if($result1)
                {
                     $encoder = new MessageDigestPasswordEncoder();
                     $pwencoded = $encoder->encodePassword($result1['password'], '');
                     $em2 = $this->getDoctrine()->getManager();

                    $RAW_QUERY1 = "

                    INSERT INTO `users` 
                    (`id_admin`, `activo`, `enPrueba2dias`, `chat_color`, `fecha_alta`, `fecha_max_prueba`, `fecha_nacimiento`, `nif`, 
                    `username`, `nombre`, `apellidos`, `telefono`, `email`, `password`, `roles`, `nombre_completo`, `direccion`, `localidad`, `cp`, `id_provincia`, `id_pais`, `otra_ciudad`, `bloqueado`, `causa_bloqueo`, `aceptaLOPD`, `mi_descripcion`, `mis_trabajos`, `mis_estudios`, `id_universidad`, `empresa`, `icono`, `se_registro_desde`, `fotoFB`, `fb_id`)
                     VALUES (NULL,:active,0,'0',:datetime1,:date1,:date2,'0',:username, '0', '0', '0', :email, :password,:role, '0', '0', '0', '0', '0', 0, '0', 0,'0', 0, '0', '0', '0', 0, '0', '0', :reg_type, '0', '0');";

                     $stmt =$em2->getConnection()->prepare($RAW_QUERY1);
                     $stmt->execute(array('active' => 1,'username' => $result1['username']." ".$result1['surname'],'email' => $result1['email'],'password' => $pwencoded,'role' => 'ROLE_TEACHER' ,'reg_type' => 'Reg.Normal' ,'datetime1' => date_format(date_create(null),"Y-m-d H:i:s") ,'date1' =>  date_format(date_create(null),"Y-m-d") ,'date2' => date_format(date_create(null),"Y-m-d")));
                          //$stmt->fetch();
                         
                        // return new JsonResponse($stmt);                        
                }
                $url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'] ;
                return $this->redirect($url.'/index#/app/profile/'.$result1['id']);

            }
        }
    }

    public function verifySignupStudentAction(Request $request ,CustomCrypt $crypt,$verifyLink)
    {
        $email = $crypt->decrypt(urldecode($verifyLink));
        if($email)
        {
            $checkMail =    $this->CheckUserTable($email);
            if($checkMail)
            {
                return new JsonResponse("Error : Link Already verified !");
            }
            else
            {
                $em1 = $this->getDoctrine()->getManager();

                
                $RAW_QUERY1 = 'SELECT * FROM group_emails where group_emails.email = :email LIMIT 1;';

                $statement1 = $em1->getConnection()->prepare($RAW_QUERY1);
                // Set parameters 
                $statement1->bindValue('email', $email);
                $statement1->execute();
                $result1 = $statement1->fetch();
                //return new JsonResponse($result1['id']); 
                if($result1)
                {

                     $encoder = new MessageDigestPasswordEncoder();
                     $encPassStud = $encoder->encodePassword('bbt@123', '');
                         $em2 = $this->getDoctrine()->getManager();

                        $RAW_QUERY1 = "

                        INSERT INTO `users` 
                        (`id_admin`, `activo`, `enPrueba2dias`, `chat_color`, `fecha_alta`, `fecha_max_prueba`, `fecha_nacimiento`, `nif`, 
                        `username`, `nombre`, `apellidos`, `telefono`, `email`, `password`, `roles`, `nombre_completo`, `direccion`, `localidad`, `cp`, `id_provincia`, `id_pais`, `otra_ciudad`, `bloqueado`, `causa_bloqueo`, `aceptaLOPD`, `mi_descripcion`, `mis_trabajos`, `mis_estudios`, `id_universidad`, `empresa`, `icono`, `se_registro_desde`, `fotoFB`, `fb_id`)
                         VALUES (NULL,:active,0,'0',:datetime1,:date1,:date2,'0',:username, '0', '0', '0', :email, :password,:role, '0', '0', '0', '0', '0', 0, '0', 0,'0', 0, '0', '0', '0', 0, '0', '0', :reg_type, '0', '0');";

                         $stmt =$em2->getConnection()->prepare($RAW_QUERY1);
                         $stmt->execute(array('active' => 1,'username' => "firstName"." "."lastName" ,'email' => $result1['email'],'password' => $encPassStud,'role' => 'ROLE_STUDENT' ,'reg_type' => 'Reg.Normal' ,'datetime1' => date_format(date_create(null),"Y-m-d H:i:s") ,'date1' =>  date_format(date_create(null),"Y-m-d") ,'date2' => date_format(date_create(null),"Y-m-d")));

                         /*dummydata*/
                        $this->studentDummyData($email);
                          //$stmt->fetch();
                         
                        // return new JsonResponse($stmt);                        
                }
                $url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'] ;
                return $this->redirect('http://bigbangtrading.com/');

            }
        }
    }

    public function CheckUserTable($email)
    {
        $em3 = $this->getDoctrine()->getManager();

        $RAW_QUERY3 = 'SELECT email FROM users where users.email = :email LIMIT 1;';

        $statement3 = $em3->getConnection()->prepare($RAW_QUERY3);
        // Set parameters 
        $statement3->bindValue('email', $email);
        $statement3->execute();

        $result3 = $statement3->fetchAll();
        return $result3;
    }

            public function emailChangeTeacherVerifyAction(Request $request ,CustomCrypt $crypt,$verifyLink)
    {
        $email = $crypt->decrypt(urldecode($verifyLink));
        if($email)
        {
            $checkMail =    $this->CheckDupeEmail($email);
            //return new JsonResponse($email);
            if($checkMail)
            {
                return new JsonResponse("Error : Link Already verified or email already in use");
            }
            else
            {
                $em1 = $this->getDoctrine()->getManager();

                $RAW_QUERY1 = 'SELECT * FROM teachers where teachers.tempemail = :email LIMIT 1;';

                $statement1 = $em1->getConnection()->prepare($RAW_QUERY1);
                // Set parameters 
                $statement1->bindValue('email', $email);
                $statement1->execute();
                $result1 = $statement1->fetch();
                
                if($result1)
                {

                         $em2 = $this->getDoctrine()->getManager();

                          $sql = '
                            UPDATE users set  email = :email1  where email = :email2 
                            ';
                            $statement3 = $em1->getConnection()->prepare($sql);
                            // Set parameters 

                            $statement3->execute(array(
                            'email1' =>$result1['tempemail'],
                            'email2' => $result1['email']));

                             $sql1 = '
                            UPDATE teachers set  email = :email1 ,tempemail=:temail where email = :email2 
                            ';
                            $statement4 = $em1->getConnection()->prepare($sql1);
                            // Set parameters 

                            $statement4->execute(array(
                            'email1' =>$result1['tempemail'],
                            'email2' => $result1['email'],
                            'temail' => null));

                        
                          //$stmt->fetch();
                         
                        // return new JsonResponse($stmt);                        
                }
                $url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'] ;
                return $this->redirect($url.'/index#/app/profile/'.$result1['id']);

            }
        }
    }

        public function studentDummyData($email)
    {
            $em = $this->getDoctrine()->getManager();

            $result = $em->getRepository('AppBundle:UserPurchaseHistory')
            ->findEmail($email);

            if($result)
            {
                $RAW_QUERY1 = "
                INSERT INTO `hist_user_compra` (`id`, `id_liga`, `id_user`, `id_empresa`, `prec_apertura_compra`, `fecha_apertura_compra`, `volumen`, `volumen_ya_vendido`)

                     VALUES (NULL, '1', :userId, 'EURUSD=X', :value1, '2017-05-25 17:25:21', :value2, '0.0000');";

                     $stmt =$em->getConnection()->prepare($RAW_QUERY1);
                     $stmt->execute(array('userId' => $result['id'] , 'value1' => rand(10.0000,100.0000)/10 , 'value2'=> rand(100000.0000,500000.0000)/10));

                $RAW_QUERY2 = "
                INSERT INTO `hist_user_compra` (`id`, `id_liga`, `id_user`, `id_empresa`, `prec_apertura_compra`, `fecha_apertura_compra`, `volumen`, `volumen_ya_vendido`)

                     VALUES (NULL, '1', :userId, 'EURUSD=X', :value1, '2017-05-25 17:25:21',:value2, '0.0000');";

                     $stmt1 =$em->getConnection()->prepare($RAW_QUERY2);
                     $stmt1->execute(array('userId' => $result['id'] , 'value1' => rand(1.0000,10.0000) , 'value2'=> rand(100000.0000,500000.0000)/10));
            }

    }

}
