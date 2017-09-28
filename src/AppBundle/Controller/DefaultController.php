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
            return $this->json(array('status' => 'success','teacher_id' => $TD->getId(),'reason' => 'Teacher Saved Successfully . please verify your email','response' => 200));
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
        $em1 = $this->getDoctrine()->getManager();   
        $em1->getConnection()->beginTransaction();
        try
        {
        $email = $crypt->decrypt(urldecode($verifyLink));
        if($email)
        {
            $checkMail =    $this->CheckUserTable($email);
            if($checkMail)
            {
                return $this->render('staff/error-page.html.twig', array(
                         'message' => 'Link Already Verified or does not exist',
                    ));
            }
            else
            {
                //$em1 = $this->getDoctrine()->getManager();

                $result1 = $em1->getRepository('AppBundle:Teacher')->findOneByEmail($email);
                
                if($result1)
                {
                     $encoder = new MessageDigestPasswordEncoder();
                     $pwencoded = $encoder->encodePassword($result1->getPassword(), '');

                    $RAW_QUERY1 = "

                    INSERT INTO `users` 
                    (`id_admin`, `activo`, `enPrueba2dias`, `chat_color`, `fecha_alta`, `fecha_max_prueba`, `fecha_nacimiento`, `nif`, 
                    `username`, `nombre`, `apellidos`, `telefono`, `email`, `password`, `roles`, `nombre_completo`, `direccion`, `localidad`, `cp`, `id_provincia`, `id_pais`, `otra_ciudad`, `bloqueado`, `causa_bloqueo`, `aceptaLOPD`, `mi_descripcion`, `mis_trabajos`, `mis_estudios`, `id_universidad`, `empresa`, `icono`, `se_registro_desde`, `fotoFB`, `fb_id`)
                     VALUES (NULL,:active,0,'0',:datetime1,:date1,:date2,'0',:username, '0', '0', '0', :email, :password,:role, '0', '0', '0', '0', '0', 0, '0', 0,'0', 0, '0', '0', '0', 0, '0', '0', :reg_type, '0', '0');";

                     $stmt =$em1->getConnection()->prepare($RAW_QUERY1);
                     $stmt->execute(array('active' => 1,'username' => $result1->getName()." ".$result1->getSurname(),'email' => $result1->getEmail(),'password' => $pwencoded,'role' => 'ROLE_TEACHER' ,'reg_type' => 'Reg.Normal' ,'datetime1' => date_format(date_create(null),"Y-m-d H:i:s") ,'date1' =>  date_format(date_create(null),"Y-m-d") ,'date2' => date_format(date_create(null),"Y-m-d")));
                          //$stmt->fetch();
                         $this->createTeachertables($result1->getId());
                        // return new JsonResponse($stmt);    
                          $em1->getConnection()->commit();                    
                }
                $url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'] ;
                return $this->redirect($url.'/index');

            }
          }
        }
         catch(Exception $e)
        {
             $em1->getConnection()->rollBack();
            return new JsonResponse("Something went wrong");
        }

    }

    public function createTeachertables($teacherId)
    {
       /* $em1 = $this->getDoctrine()->getManager();   
        $em1->getConnection()->beginTransaction();
        try
        {*/
            $em1 = $this->getDoctrine()->getManager();
            $RAW_QUERY1 = "
                            CREATE TABLE `bigbangt_aemin`.`hist_ranking_posiciones_proff_".$teacherId."`
                             (
                              `id` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
                              `id_liga` int(3) NOT NULL,                              
                              `id_user` int(5) NOT NULL,
                              `fecha` datetime NOT NULL,
                              `posicion` int(4) NOT NULL,
                              `patrimonio_total` double(16,4) NOT NULL,
                              `beneficio_total` double(16,4) NOT NULL,
                              `posicion_ant` int(4) NOT NULL,
                              `patrimonio_ant` double(16,4) NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
                            ALTER  TABLE `bigbangt_aemin`.`hist_ranking_posiciones_proff_".$teacherId."` ADD PRIMARY KEY (`id`);

                            ";

            $stmt1 =$em1->getConnection()->prepare($RAW_QUERY1);
            $stmt1->execute();
            $stmt1->closeCursor();

            $RAW_QUERY2 = "
                            CREATE TABLE `bigbangt_aemin`.`hist_user_compra_proff_".$teacherId."` 
                            ( `id` int(11) NOT NULL, `id_liga` int(4) NOT NULL, `id_user` int(5) NOT NULL, `id_empresa` varchar(10) NOT NULL, `prec_apertura_compra` double(16,4) NOT NULL, `fecha_apertura_compra` datetime NOT NULL, `volumen` double(16,4) NOT NULL, `volumen_ya_vendido` double(16,4) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=utf8; ALTER TABLE `bigbangt_aemin`.`hist_user_compra_proff_".$teacherId."` ADD PRIMARY KEY (`id`); ALTER TABLE `bigbangt_aemin`.`hist_user_compra_proff_".$teacherId."` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
                            ";

            $stmt2 =$em1->getConnection()->prepare($RAW_QUERY2);
            $stmt2->execute();
            $stmt2->closeCursor();

           $RAW_QUERY3 = "
                            CREATE TABLE `bigbangt_aemin`.`hist_user_operaciones_proff_".$teacherId."`  ( `id` int(11) NOT NULL, `id_liga` int(4) NOT NULL, `id_user` int(5) NOT NULL, `id_empresa` varchar(10) NOT NULL, `prec_compra` double(16,4) NOT NULL, `fecha_compra` datetime NOT NULL, `volumen_compra` double(16,4) NOT NULL, `prec_venta` double(16,4) NOT NULL, `fecha_venta` datetime NOT NULL, `volumen_operacion` double(16,4) NOT NULL, `beneficios` double(16,4) NOT NULL, `reg_oculto` int(1) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=utf8; ALTER TABLE `bigbangt_aemin`.`hist_user_operaciones_proff_".$teacherId."` ADD PRIMARY KEY (`id`); ALTER TABLE `bigbangt_aemin`.`hist_user_operaciones_proff_".$teacherId."` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
                         ";

            $stmt3 =$em1->getConnection()->prepare($RAW_QUERY3);
            $stmt3->execute();
            $stmt3->closeCursor();

        /*    $em1->getConnection()->commit();  
        }
        catch(Exception $e)
        {

        }*/
    }

    public function verifySignupStudentAction(Request $request ,CustomCrypt $crypt,$verifyLink)
    {
            $em1 = $this->getDoctrine()->getManager();   
            $em1->getConnection()->beginTransaction();
        try
        {
        $email = $crypt->decrypt(urldecode($verifyLink));
        if($email)
        {
            $checkMail =    $this->CheckUserTable($email);
            if($checkMail)
            {
                return $this->render('staff/error-page.html.twig', array(
                         'message' => 'Link Already Verified or does not exist',
                    ));
            }
            else
            {
                

                $result1 = $em1->getRepository('AppBundle:GroupEmail')->findOneByEmail($email);
                /*
                $RAW_QUERY1 = 'SELECT * FROM group_emails where group_emails.email = :email LIMIT 1;';

                $statement1 = $em1->getConnection()->prepare($RAW_QUERY1);
                // Set parameters 
                $statement1->bindValue('email', $email);
                $statement1->execute();
                $result1 = $statement1->fetch();*/
                //return new JsonResponse($result1['id']); 
                if($result1)
                {

                     $encoder = new MessageDigestPasswordEncoder();
                     $encPassStud = $encoder->encodePassword('bbt@123', '');
                        // $em2 = $this->getDoctrine()->getManager();

                        $RAW_QUERY1 = "

                        INSERT INTO `users` 
                        (`id_admin`, `activo`, `enPrueba2dias`, `chat_color`, `fecha_alta`, `fecha_max_prueba`, `fecha_nacimiento`, `nif`, 
                        `username`, `nombre`, `apellidos`, `telefono`, `email`, `password`, `roles`, `nombre_completo`, `direccion`, `localidad`, `cp`, `id_provincia`, `id_pais`, `otra_ciudad`, `bloqueado`, `causa_bloqueo`, `aceptaLOPD`, `mi_descripcion`, `mis_trabajos`, `mis_estudios`, `id_universidad`, `empresa`, `icono`, `se_registro_desde`, `fotoFB`, `fb_id`)
                         VALUES (NULL,:active,0,'0',:datetime1,:date1,:date2,'0',:username, '0', '0', '0', :email, :password,:role, '0', '0', '0', '0', '0', 0, '0', 0,'0', 0, '0', '0', '0', 0, '0', '0', :reg_type, '0', '0');";

                         $stmt =$em1->getConnection()->prepare($RAW_QUERY1);
                         $stmt->execute(array('active' => 1,'username' => "firstName"." "."lastName" ,'email' => $result1->getEmail(),'password' => $encPassStud,'role' => 'ROLE_STUDENT' ,'reg_type' => 'Reg.Normal' ,'datetime1' => date_format(date_create(null),"Y-m-d H:i:s") ,'date1' =>  date_format(date_create(null),"Y-m-d") ,'date2' => date_format(date_create(null),"Y-m-d")));

                         /*mark as active and set user id */
                         $result1->setActive(1);
                         $result1->setStudentId($em1->getConnection()->lastInsertId());
                         $em1->persist($result1);
                         $em1->flush();
                         //return $em->lastInsertId();
                         /*dummydata*/
                        $this->studentDummyData($email);
                          //$stmt->fetch();
                         
                        // return new JsonResponse($stmt);   
                         $em1->getConnection()->commit();                     
                }
                $url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'] ;
                return $this->redirect('http://bigbangtrading.com/');

            }
        }
        }
        catch(Exception $e)
        {
             $em1->getConnection()->rollBack();
            return new JsonResponse("Something went wrong");
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
                return $this->render('staff/error-page.html.twig', array(
                         'message' => 'Link Already Verified or does not exist',
                    ));
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

            $result = $em->getRepository('AppBundle:UserOperations')
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
