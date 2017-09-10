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

class UniversityController extends Controller
{

	public function signupTeacherAction(Request $request,MailerService $mailerService,CustomCrypt $crypt)
	{
		$teacher = $request->request->all();
		
		//$em = $this->getDoctrine()->getManager();
		//$qb = $em->getRepository('AppBundle:Teacher')->createQueryBuilder('i');

		/*$qb->select('u')
		   ->from('Teacher', 'u')
		   ->where('u.id = ?1')
		   ->orderBy('u.name', 'ASC');*/

		//return $qb;
		 /* $result = $em->createQuery("SELECT * FROM Teacher t")->getScalarResult();
			$ids = array_column($result, "id");
			return $ids;*/

        /*$repository = $this->getDoctrine()->getRepository('AppBundle:Teacher');
        $query = $repository->createQueryBuilder('t')
        			->select('t.email')
        			//->where("t.email",'=' ,$teacher['email'])
        			//->where('t.name = aaa')
        			 //->where('t.id = 1')
        			//->where("t.name!= ".$teacher['username'])
        			//->where("t.email!= ".$teacher['email'])
        			//->where("t.email LIKE '%".$search_for."%' or t.name LIKE '%".$search_for."%'")
            		->getQuery();
        $entities= $query->getResult();
        return 	$entities;	
*/
        /*$teacherEmail = "111@222.com";
        $repository = $this->getDoctrine()->getRepository('AppBundle:Teacher');
        $qb = $repository->createQueryBuilder('t');
        $qb->select('t.email','t.id','t.name')
         ->where($qb->expr()->like('t.email', ':teacherEmail'))
            ->setParameter('teacherEmail', $teacherEmail);
        $query = $qb->getQuery();

        return $query->getResult();*/

       /* $car = $this->getDoctrine()
	    ->getRepository('AppBundle:Teacher')
	    ->findOneBy(array('email' => $teacher['email']));
	    return $car;*/
		/*$qb = $this->getDoctrine()->getManager();
		$qb->select('COUNT(u)')->from('AppBundle:Teacher', 't');
		$count = $qb->getQuery()->getSingleScalarResult();
		return $count;*/

		//$db = $this->get('database_connection');
		/*$query = 'select email from  teachers';
		//$query->where('email','=',$teacher['email']);
		$sth = $db->prepare($query);
		$sth->execute();
		$db_email = $sth->fetchAll();
		$myArray= array();

		foreach ($db_email as $key => $arremail) {
			foreach ($arremail as $key => $email) {
				$myArray[] = $email;
			}
		}
		$emailvalidate = 0;
		foreach ($myArray as $key => $checkemail) {
			if($checkemail != $teacher['email']){
				$emailvalidate = 1;
			}else{
				$emailvalidate = 0;
			}
		}*/

		$emailvalidate =0;
        $emailCheck1 = $this->CheckDupeEmail($teacher['email']);
        if(!$emailCheck1)
        	$emailvalidate =1;
		
		if($emailvalidate === 1){
			$em = $this->getDoctrine()->getManager();
			$TD = new Teacher();
			$TD->setName($teacher['username']);
			$TD->setSurname($teacher['surname']);
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

	public function teacherStatusAction(Request $request)
	{
		$profile = $request->request->all();
		$id = $profile['id'];
		$em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AppBundle:Teacher')->find($id);
        
		$post->setAbout($profile['teacher']['about']);
		$post->setTeachplace($profile['teacher']['teach_place']);
		$post->setWork($profile['teacher']['work']);
		$em->flush();
		return $this->json(array('status' => 'success','reason' => 'Teacher Status Saved Successfully','reaponse' => 200));
	}
    public function teacherProfileAction(Request $request,$tid,FileUploader $fileUploader)
    {
    	$teacherEmail = $tid;
        $repository = $this->getDoctrine()->getRepository('AppBundle:Teacher');
        $qb = $repository->createQueryBuilder('t');
        $qb->select('t.email','t.id','t.name','t.surname','t.university','t.about','t.teach_place','t.work')
         ->where($qb->expr()->like('t.id', ':teacherEmail'))
            ->setParameter('teacherEmail', $teacherEmail);
        $query = $qb->getQuery();
        $profile = $query->getSingleResult();
       // return new JsonResponse($profile);
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AppBundle:Group')->findBy(array('teacher_id' => $profile['id']));
        if(count($post) >0)
        {
        	$isGroup =true;
        }
        else
        	$isGroup =false;
        $profileImageUrl = $fileUploader->getTargetDir();
        $profileImageUrl =  explode("htdocs",$profileImageUrl)[1]; //$profileImageUrl.split("htdocs")[1];
        $url = 'http://'.$_SERVER['SERVER_NAME'].':'."80" ;
        $profileImageUrl = $url.$profileImageUrl ;
       	return $this->json(array('status' => 'success',
       		'data' => $profile,
       		'profileImageUrl' =>$profileImageUrl,
       		 'isGroup' =>$isGroup,
       		'reaponse' => 200));
       
    }

    public function saveTeacherAction(Request $request,CustomCrypt $crypt,MailerService $mailerService)
    {    	    	
		$teacher = $request->request->get('teacher');		
		$file = $request->files->get('file');		
		
			$em = $this->getDoctrine()->getManager();
			//return	$teacher['mail_list'];
		//if($teacher['mail_list'] != Undefined){	
			$emails_list = $teacher['mail_list'];
			$emails = explode(',', $emails_list);		
		//}
		$group = new Group();
		$group->setTeacher_id($teacher['id']);
		if(array_key_exists('group_name',$teacher) && $teacher['group_name'] != null)
			$group->setGroup_name($teacher['group_name']);
		else
		{
			$group->setGroup_name('Group'.rand());
		}
		$group->setLeague_name($teacher['league_name']);//TODO		
		$group->setVirtual_money($teacher['virtual_money']);
		$group->setStart_date($teacher['start_date']);
		$group->setEnd_date($teacher['end_date']);
		$group->setCreated_by(1);
		//return "hi";
		$em->persist($group);
	    $em->flush();
	    //return "hi";
	    $assets = $teacher['assets'];
	    foreach ($assets as $asset) 
	    {
	    	if($asset)
	    	{
	    		$GA = new GroupAsset;
	    		$GA->setGroup_id($group->getId());
	    		$GA->setAsset_id($asset);
	    		$em->persist($GA);
	    		$em->flush();
	    	}
	    }

	    $feedbacks = $teacher['feedback'];
	    foreach ($feedbacks as $feedback) 
	    {
	    	if($feedbacks)
	    	{
	    		$GF = new GroupFeedback;
	    		$GF->setGroup_id($group->getId());
	    		$GF->setFeedback_id($feedback);
	    		$em->persist($GF);
	    		$em->flush();
	    	}	    	
	    }

	    $assets = $teacher['assets'];
	    foreach ($assets as $asset) 
	    {
	    	if($asset)
	    	{
	    		$GA = new GroupAsset;
	    		$GA->setGroup_id($group->getId());
	    		$GA->setAsset_id($asset);
	    		$em->persist($GA);
	    		$em->flush();
	    	}
	    }

	    $feedbacks = $teacher['feedback'];
	    foreach ($feedbacks as $feedback) 
	    {
	    	if($feedbacks)
	    	{
	    		$GF = new GroupFeedback;
	    		$GF->setGroup_id($group->getId());
	    		$GF->setFeedback_id($feedback);
	    		$em->persist($GF);
	    		$em->flush();
	    	}	    	
	    }

	    foreach ($emails as $email) 
	    {
	    	$valid = $this->CheckValidEmail($email);
	    	if(!$valid)
	    		continue;
	    	$exists = $this->CheckDupeEmail($email);
	    	
	    	if($exists)
	    		continue;
	    	$GM = new GroupEmail;
	    	$GM->setGroup_id($group->getId());
	    	$GM->setEmail($email);
	    	$GM->setCreated_by(1);
	    	$em->persist($GM);
	    	$em->flush();
	    	$this->sendEmailsToUser($email,$crypt,$mailerService);

	    }
			//path 		
			if($file)
			{	
					$absolute_path = getcwd();
					$fileCo = file_get_contents($file);
					file_put_contents('temp.xls', $fileCo);
					$reader = $this->get("arodiss.xls.reader");
					$path = $absolute_path."/temp.xls";
					$path = str_replace('/', '//', $path);
					$content = $reader->readAll($path);
					
					 foreach ($content as $c) 
			    {
			    	$valid = $this->CheckValidEmail(array_values($c)[0]);
			    	if(!$valid)
			    		continue;
			    	$exists = $this->CheckDupeEmail(array_values($c)[0]);
					//return $this->json($exists);
			    	if($exists)
			    		continue;
			    	$GM = new GroupEmail;
			    	$GM->setGroup_id($group->getId());
			    	$GM->setEmail(array_values($c)[0]);
			    	$GM->setCreated_by(1);
			    	$em->persist($GM);
			    	$em->flush();
			    	$this->sendEmailsToUser(array_values($c)[0],$crypt,$mailerService);
			    	//var_dump($content)
			    	//return $this->json($content);
			    }
			    unlink($path);
		}
		    //return $this->json(($path));
/*
			for($i=0;$i<$content;$i++)
	    {

	    	$GM = new GroupEmail;
	    	$GM->setGroup_id($group->getId());
	    	$GM->setEmail($content[$i]);
	    	$GM->setCreated_by(1);
	    	$em->persist($GM);
	    	$em->flush();
	    	//var_dump($content)
	    	return $this->json($content);
	    }*/

			//return $this->json($content);
			//$excel = $this->get('os.excel');
	    	//$excel->loadFile($path);
			//$rows = $excel->getRowCount();
			//$data = $excel->getSheetData();
				//return $this->json(['count'=>$data]);
			/*for($i=0;$i<$rows;$i++) 			
			{
				return $this->json( $excel->getCellData([0], [0]));
				return $this->json(['count'=>$excel->getRowData([$i])]);
				$data[] = $excel->getRowData([$i]);
				$GM = new GroupEmail;
		    	$GM->setGroup_id($group->getId());
		    	$GM->setEmail($excel->getCellData([1], ['A']));
		    	$GM->setCreated_by(1);
		    	$em->persist($GM);
		    	$em->flush();
			}*/	    

    	return $this->json(array('status' => 'success','reason' => 'Group Saved Successfully','reaponse' => 200));

    }

    public function updateTeacherAction(Request $request ,CustomCrypt $crypt,MailerService $mailerService)
    {
    	$em = $this->getDoctrine()->getManager();
		$teacher = $request->request->get('teacher');
		$isEmailChanged = isset($teacher['oldemail']);
		if($isEmailChanged)
			$emailold = $teacher['oldemail'];
		else
			$emailold = null;
    		$TD = $em->getRepository('AppBundle:Teacher')->find($teacher['id']);
    		$mailFlag =false;
    		if($teacher['email'] != $TD->getEmail())
    			{
    				$mailFlag =true;
    				$TD->setTempEmail($teacher['email']);
    				$oldemail = $TD->getEmail();
    				$exists = $this->CheckDupeEmail($teacher['email']);
    				if($exists)
    					return $this->json(array('status' => 'failure','reason' => 'Email Already in use','reaponse' => 200));
    			}
    		
    		$TD->setId($teacher['id']);
			$TD->setName($teacher['name']);
			$TD->setSurname($teacher['surname']);
			
		/*	if(isset($teacher['password']))
				{
					$TD->setPassword($teacher['password']);		
					$password = $teacher['password'];
				}	*/
			$TD->setUniversity($teacher['university']);
			$TD->setAbout($teacher['about']);
			$TD->setTeachplace($teacher['teach_place']);
			$TD->setWork($teacher['work']);
			$TD->setCreated_by(1);
			$em->persist($TD);
		    $em->flush();
		    
             if($mailFlag)
             	$this->mailUpdateLink($oldemail,$teacher['email'],$crypt, $mailerService);

    	return $this->json(array('status' => 'success','reason' => 'updated Successfully','reaponse' => 200));
    }
    
    public function homeAction()
    {
    	return $this->render('staff/index.html.twig', array(
            'profileName' => 'Admin',
        ));
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


    public function avatarAction(Request $request,FileUploader $fileUploader)
    {    	    	
		$uId = $request->request->get('userId');		
		$file = $request->files->get('file');
		$fileName = $fileUploader->upload($file,$uId);
        return new JsonResponse($fileName);
	}

	public function verifySignupteacherAction(Request $request ,CustomCrypt $crypt,$verifyLink)
	{
		$email = $crypt->decrypt(urldecode($verifyLink));
		if($email)
		{
			$checkMail = 	$this->CheckUserTable($email);
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
			$checkMail = 	$this->CheckUserTable($email);
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

	public function sendEmailsToUser($email,CustomCrypt $crypt,MailerService $mailerService)
	{
			$mailObject = new \stdClass();
			$mailObject->toMail = $email;
			$mailObject->name = 'Student';
			$mailObject->type = 'Student';
			/*$mailObject->temppassword = "bbt@123";*/
			$mailObject->encryptedLink = urlencode($crypt->encrypt($email));
			$mailerService->indexAction($mailObject);
	}

	public function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

	public function mailUpdateLink($email,$newEmail,CustomCrypt $crypt,MailerService $mailerService)
	{
			$mailObject = new \stdClass();
			$mailObject->toMail = $email;
			$mailObject->name = 'user';
			
			/*$mailObject->temppassword = "bbt@123";*/
			$mailObject->encryptedLink = urlencode($crypt->encrypt($newEmail));
			$mailerService->mailChangeLink($mailObject);
	}


		public function emailChangeTeacherVerifyAction(Request $request ,CustomCrypt $crypt,$verifyLink)
	{
		$email = $crypt->decrypt(urldecode($verifyLink));
		if($email)
		{
			$checkMail = 	$this->CheckDupeEmail($email);
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


}
