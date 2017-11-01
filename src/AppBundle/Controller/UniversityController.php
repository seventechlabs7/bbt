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
use AppBundle\Entity\League;
use AppBundle\Entity\GroupLeagues;
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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Controller\TokenAuthenticatedController;


class UniversityController extends Controller implements  TokenAuthenticatedController
{


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
		return $this->json(array('status' => 'success','reason' => 'Teacher Status Saved Successfully','response' => 200));
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
        
        $user  = $em->getRepository('AppBundle:UserOperations')
                ->findUserIdByTeacherId($profile['id']);
                if($user)
        			$profileImageUrl = "/imgs/iconos/".$user['image'];
       			else
       				$profileImageUrl = "";
        $url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'] ;
        $profileImageUrl = $url.$profileImageUrl ;
       	return $this->json(array('status' => 'success',
       		'data' => $profile,
       		'profileImageUrl' =>$profileImageUrl,
       		 'isGroup' =>$isGroup,
       		'response' => 200));
       
    }

    public function saveTeacherAction(Request $request,CustomCrypt $crypt,MailerService $mailerService , Utils $utils)
    { 
    	  $this->get('translator')->setLocale($_SERVER['HTTP_ACCEPT_LANGUAGE']);
     $em = $this->getDoctrine()->getManager();   
     $em->getConnection()->beginTransaction();
      try
      {	    	
		$teacher = $request->request->get('teacher');		
		$file = $request->files->get('file');		
		$STEP = $teacher["save_step"] ;
		$invalidArray = [];
		$dupelicateArray = [];

		if($STEP == "1")
		{
			$emails_list = $teacher['mail_list'];
			$emails = explode(',', $emails_list);

			$content = [];
			if($file)
			{	
					$absolute_path = getcwd();
					$fileCo = file_get_contents($file);
					file_put_contents('temp.xls', $fileCo);
					$reader = $this->get("arodiss.xls.reader");
					$path = $absolute_path."/temp.xls";
					$path = str_replace('/', '//', $path);
					$content = $reader->readAll($path);
					unlink($path);
					
			}
			$contentsNew = [];
			foreach ($content as $key ) {
				if(array_values($key)[0] != "" && array_values($key)[0] != " ")
				 array_push($contentsNew, array_values($key)[0]);	
			}
			
			$emails = array_merge($emails,$contentsNew);
			$emails = array_intersect_key($emails, array_unique(array_map('strtolower', $emails)));

			//new version
			$emails = array_filter($emails);
			foreach ($emails as $email) 
		    {
		    	
		    	$valid = $this->CheckValidEmail($email);
		    	if(!$valid)
	    		{
	    			//add to invalid mail list	
	    			array_push($invalidArray, $email);
	    		}
		    	$exists = $this->CheckDupeEmail($email);
		    	if($exists)
		    	{
		    		array_push($dupelicateArray, $email);
		    	}
		    }
		  
		    if(count($invalidArray) >0 ||  count($dupelicateArray) > 0)
		    {
		    	return $this->json(array('status' => 'failure','reason' => 'no_emails_added','response' => 200 , 'invalidArray' =>$invalidArray ,'dupelicateArray'=>$dupelicateArray    							 ));
		    }
			
		   // return new JsonResponse (array('array'=>$emails ,'invalidArray'=> $invalidArray,'dupelicateArray'=>$dupelicateArray ));
			$group = new Group();
			$group->setTeacher_id($teacher['id']);
			if(array_key_exists('group_name',$teacher) && $teacher['group_name'] != null)
				$group->setGroup_name($teacher['group_name']);
			else
			{
				$group->setGroup_name('Group'.rand());
			}
			//$group->setLeague_name($teacher['league_name']);//TODO		
			//$group->setVirtual_money($utils->getNumberFromLocaleString($teacher['virtual_money']));
			//$group->setStart_date($teacher['start_date']);
			//$group->setEnd_date($teacher['end_date']);
			$group->setCreated_by(1);//TODO
			//return "hi";
			$group->setCreated_at(new \DateTime());
			$group->setUpdated_at(new \DateTime());
			$em->persist($group);
		    $em->flush();

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
	    	$GM->setTeacherId($teacher['id']);
	    	$GM->setActive(0);
	    	$GM->setCreated_by(1);
	    	$em->persist($GM);
	    	$em->flush();
	    	$this->sendEmailsToUser($email,$crypt,$mailerService);
    	

	    }   
	    	$reason = "Group Created successfully";
	    }
	    if($STEP == "2")//2
	    {
	    	$group = $em->getRepository('AppBundle:Group')->find($request->request->get('groupId'));

		    $league = new League();
		    $league->setLeagueName($teacher['league_name']);
		    $league->setStartDate(new \DateTime($teacher['start_date']));
		    $league->setEndDate(new \DateTime($teacher['end_date']));
		    $league->setActive(1);
		    $league->setReset(0);
		    $em->persist($league);
		    $em->flush();

		    $groupLeague =  new GroupLeagues();
		    $groupLeague->setGroupId($group->getId());
		    $groupLeague->setLeagueId($league->getId());
		    $groupLeague->setVirtualMoney($utils->getNumberFromLocaleString($teacher['virtual_money']));
		    $em->persist($groupLeague);
		    $em->flush();

		    $assets = $teacher['assets'];
		    foreach ($assets as $asset) 
		    {	    	
				$GA = new GroupAsset;
				$GA->setGroup_id($group->getId());
				if($asset != "1" && $asset !=1)
					$GA->setAsset_id(0);
				else
					$GA->setAsset_id($asset);
				$GA->setLeagueId($league->getId());
				$em->persist($GA);
				$em->flush();		    	
		    }
		    $reason = "League created Successfully";
	    }
	    if($STEP == "3")//3
	    {
	    	$group = $em->getRepository('AppBundle:Group')->find($request->request->get('groupId'));

	    	$leagueData = $em->getRepository('AppBundle:UserOperations')
                		  ->getLeagueDataMain($group->getId());

		    $feedbacks = $teacher['feedback'];
		    foreach ($feedbacks as $feedback) 
		    {
		    	
				$GF = new GroupFeedback;
				$GF->setGroup_id($group->getId());
				if($feedback != "1" && $feedback !=1)
					$GF->setFeedback_id(0);
				else
					$GF->setFeedback_id($feedback);
				$GF->setLeagueId($leagueData['id']);
				$em->persist($GF);
				$em->flush();
		    	    	
		    }

		    $reason = "Feedback saved successfully";
	    }

	   
	    $em->getConnection()->commit();
	    }
	    catch(Exception $e)
	    {
			 $em->getConnection()->rollBack();
			   // throw $e;
	    } 

    	return $this->json(array('status' => 'success','reason' => $reason,'response' => 200 ,
    							 'invalidArray' =>$invalidArray ,'dupelicateArray'=>$dupelicateArray,
    							  'group' =>$group->getId()));

    }

    public function updateTeacherAction(Request $request ,CustomCrypt $crypt,MailerService $mailerService)
    {
    	  $this->get('translator')->setLocale($_SERVER['HTTP_ACCEPT_LANGUAGE']);
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
    					return $this->json(array('status' => 'failure','reason' => 'Email Already in use','response' => 200));
    			}
    		
    		$TD->setId($teacher['id']);
			$TD->setName(ucfirst($teacher['name']));
			$TD->setSurname(($teacher['surname']));
			
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
             	{
             		$this->mailUpdateLink($oldemail,$teacher['email'],$crypt, $mailerService);
             		return $this->json(array('status' => 'success','reason' => 'updated_successfully_verify_email','response' => 200));
             	}

    	return $this->json(array('status' => 'success','reason' => 'updated_successfully','response' => 200));
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
		

		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('AppBundle:UserOperations')
                ->findUserIdByTeacherId($uId);

       $fileName = $fileUploader->upload($file,$user['userId']);
       if($fileName == "failure")
       {
       		return new JsonResponse(array('status' => 'failure','reason' => 'select_valid_image','response' => 401));
       }
       if(isset($user['image']))
       		$removeFile = $fileUploader->removeFile($user['image']);
         $sql = '
				UPDATE users set  icono = :url  where id_admin = :id 
				
				';
				$statement3 = $em->getConnection()->prepare($sql);
				// Set parameters 

				$statement3->execute(array(
				'url' =>$fileName,
				'id' => $user['userId']));

       return new JsonResponse(array('status' => 'success','reason' => 'image_uploaded','response' => 200));
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
			$mailObject = (Object) [] ;//new \stdClass();
			$mailObject->toMail = $newEmail;
			$mailObject->name = 'user';
			$mailObject->encryptedLink = urlencode($crypt->encrypt($newEmail));
			
			$mailerService->mailChangeLink($mailObject);


			$mailObject1 =(Object) [] ;// new \stdClass();
			$mailObject1->toMail 	= $email;
			$mailObject1->name 		= 'user';
			$mailObject1->newmail 	= $newEmail; //preg_replace('/(?:^|@).\K|\.[^@]*$(*SKIP)(*F)|.(?=.*?\.)/', '*', $newmail);

			$mailerService->mailChangeNotify($mailObject1);
	}

}
