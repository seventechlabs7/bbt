<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;
use AppBundle\Entity\Likes;
use AppBundle\Entity\Teacher;
use AppBundle\Entity\Group;
use AppBundle\Entity\GroupEmail;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\UserPurchaseHistory;
use AppBundle\Service\MailerService;
use AppBundle\Service\CustomCrypt;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use AppBundle\Entity\GroupAsset;
use AppBundle\Entity\GroupFeedback;

class UserOperationsController extends Controller
{

	public function getUserOperationsAction(Request $request ,$tid)
	{

			 $em = $this->getDoctrine()->getManager();
			$result = $em->getRepository('AppBundle:UserPurchaseHistory')
            ->findAllOperationsOfConnectedUsers($tid);
            
            $final = [];
            foreach ($result as $re) {

			  $likes =    $em->getRepository('AppBundle:UserPurchaseHistory')
           		 ->findUserLikes($re);
           		 $users = [];

                if(is_array($likes) || is_object($likes))
                {
                  foreach ($likes as $like)
                   {
                    $likesArray = explode("|",$like);	

                    if(is_array($likesArray) || is_object($likesArray))
                    {
                      foreach ($likesArray as $likeObj) 
                      {
                      $username =	$this->getUserNames($likeObj);
                      array_push($users,$username['username']);           		 	
                      }        
                    }   		 
                  }
                }

			 $comments =    $em->getRepository('AppBundle:UserPurchaseHistory')
           		 ->findUserComments($re);
           		 // return new JsonResponse($comments);
           		 $usersComments = [];
                if(is_array($comments) || is_object($comments))
                {
                  label1:
               foreach ($comments as $comment) {
                $commentObj = new \stdClass();
                $likedUsers = [];
               
                $likesArray = explode("|",$comment['likes']);
                 

                $commentatorName =	$this->getUserNames($comment['userId']);
                if(is_array($likesArray) || is_object($likesArray))
                {
                   label2:
                foreach ($likesArray as $likeObj) 
                  {
                      
                    $commentObj->commentatorName = $commentatorName['username'];
                    $commentObj->name = $comment['comment'];
                     $commentObj->commentId = $comment['commentId'];
                    $likedName =	$this->getUserNames($likeObj);
                    if($likeObj != "")
                    array_push($likedUsers,$likedName['username']); 
                  }     
                }
                //here
                $likedUsers = array_map('trim',$likedUsers);
                $commentObj->likedUsers = count($likedUsers);
                $commentObj->commentLikes = $likedUsers;
                array_push($usersComments,$commentObj);  
                	 
                }
                }
			//return new JsonResponse($likedUsers);  
				$re['likes'] = $users;
				$re['comments'] = $usersComments;
				array_push($final,$re );
		}
		
            return new JsonResponse($final);

	}

	public function commentAction(Request $request)
	{
		 $reqData = $request->request->all();

		 $obj = new \stdClass();
		 $em = $this->getDoctrine()->getManager();
		 $obj->userId = $reqData['uId'];
		 $obj->comment = $reqData['comment'];
		 $obj->purchaseId = $reqData['rId'];
		// $obj->commentId = $reqData['cId'];
		 
    $TD =  $em->getRepository('AppBundle:Teacher')->find($obj->userId);
  
    if($TD)
    {
       $em = $this->getDoctrine()->getManager();
     $user_id  = $em->getRepository('AppBundle:UserPurchaseHistory')
                ->findEmail($TD->getEmail());
       if($user_id)
       {
           $obj->userId = $user_id['id'];
       }
       else
        return new JsonResponse("failure");
    }
    else
      return new JsonResponse("failure");

		 $comment =    $em->getRepository('AppBundle:Likes')
           		 ->postComment($obj);
		 //get current user id

		 return new JsonResponse("success");
	}
	public function likeAction(Request $request)
	{
		 $reqData = $request->request->all();    
		 $obj = new \stdClass();
		 $obj->purchaseId = $reqData['rId'];
		 $obj->userId = $reqData['uId'];

		 $em = $this->getDoctrine()->getManager();

		 $likes = $em->getRepository('AppBundle:Likes')
           		   ->findRecordLikes($obj);
    if(!$likes)
    {
      $like = new Likes();
      $like->setPurchaseId($obj->purchaseId);
      $like->setOperationId(0);
      $like->setLikes("");
      $em->persist($like);
      $em->flush();
       $likes = $em->getRepository('AppBundle:Likes')
                 ->findRecordLikes($obj);
    }
   
          //return new JsonResponse($likes);  

         $likesArray = explode("|",$likes['ids_like']);	
         $newLikes = [];
         $likeFlag = true;
           			  foreach ($likesArray as $likeObj) {
        				if($likeObj == $obj->userId)   
        					 {
        					 	$likeFlag =false;
        					 	//unlike it 
        					 	break;
        					 } 
        					 else if($likeObj)
        					 {
        					 	 array_push($newLikes,$likeObj);
        					 } 

           		 }   
           		 if(count($likesArray) == 0 || $likeFlag)
           		 {
           		 	 array_push($newLikes,$obj->userId);
           		 }
               else
               {
               }
          $newLikes = array_map('trim',$newLikes);
          /*if(count($newLikes) == 0 >1)
              $obj->newLikes =   implode('|', $newLikes);
            else
                $obj->newLikes =  $newLikes;*/
               $obj->newLikes =   implode('|', $newLikes);
          //return new JsonResponse(count($likesArray));
          $update = $em->getRepository('AppBundle:Likes')
           		   ->updateLikes($obj);

		 return new JsonResponse($update);
	}

    public function commentLikeAction(Request $request)
  {
     $reqData = $request->request->all();    
     $obj = new \stdClass();
     $obj->purchaseId = $reqData['rId'];
     $obj->userId = $reqData['uId'];
     $obj->commentId = $reqData['cId'];

     $em = $this->getDoctrine()->getManager();

     $comment = $em->getRepository('AppBundle:Likes')
                 ->findCommentById($obj);
     // return new JsonResponse($comment);
    
   
          //return new JsonResponse($likes);  

         $likesArray = explode("|",$comment['ids_likes']); 
         $newLikes = [];
         $likeFlag = true;
                  foreach ($likesArray as $likeObj) {
                if($likeObj == $obj->userId)   
                   {
                    $likeFlag =false;
                    //unlike it 
                    break;
                   } 
                   else if($likeObj)
                   {
                     array_push($newLikes,$likeObj);
                   } 

               }   
               if(count($likesArray) == 0 || $likeFlag)
               {
                 array_push($newLikes,$obj->userId);
               }
               else
               {
               }
          $newLikes = array_map('trim',$newLikes);
          /*if(count($newLikes) == 0 >1)
              $obj->newLikes =   implode('|', $newLikes);
            else
                $obj->newLikes =  $newLikes;*/
               $obj->newLikes =   implode('|', $newLikes);
          //return new JsonResponse(count($likesArray));
          $update = $em->getRepository('AppBundle:Likes')
                 ->updateCommmentLikes($obj);

     return new JsonResponse($update);
  }

	public function getUserNames($id)
	{
		$em = $this->getDoctrine()->getManager();
		return    $em->getRepository('AppBundle:UserPurchaseHistory')
           		 	->findUserNames($id);
	}

  public function removeFromGroupAction(Request $request)
  {
     $reqData = $request->request->all();

     $studentId = $reqData['sId'];
     $teacherId = $reqData['uId'];
     $em = $this->getDoctrine()->getManager();

     $user = $em->getRepository('AppBundle:UserPurchaseHistory')
                ->findEmailById($studentId);
    // return new JsonResponse($user['email']);
     $TD = $em->getRepository('AppBundle:GroupEmail')->findOneByEmail($user['email']);                
     if($TD)
     {
       $em->remove($TD);
       $em->flush();
       return new JsonResponse(array('status' => 'success','reason' => 'Student removed from group successfully','reaponse' => 200));

     }
     else
     {
       return new JsonResponse(array('status' => 'failure','reason' => 'Student not removed from group ! please try again','reaponse' => 200));
     }
  }

  public function addStudentsAction(Request $request ,CustomCrypt $crypt,MailerService $mailerService)
  {

        $teacher = $request->request->get('teacher');  
        $file = $request->files->get('file');   
    
        $em = $this->getDoctrine()->getManager();
        $emails_list = $teacher['mail_list'];
        $emails = explode(',', $emails_list); 

        foreach ($emails as $email) 
      {
        $valid = $this->CheckValidEmail($email);
        if(!$valid)
          continue;
        $exists = $this->CheckDupeEmail($email);
        
        if($exists)
          continue;
        $GM = new GroupEmail;
        $GM->setGroup_id($teacher['gId']);
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
            $GM->setGroup_id($teacher['gId']);
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

       return new JsonResponse(array('status' => 'success','reason' => 'success','reaponse' => 200));
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

    public function sendEmailsToUser($email,CustomCrypt $crypt,MailerService $mailerService)
  {
      $mailObject = new \stdClass();
      $mailObject->toMail = $email;
      $mailObject->name = 'Student';
      $mailObject->type = 'Student';
      $mailObject->encryptedLink = urlencode($crypt->encrypt($email));
      $mailerService->indexAction($mailObject);
  }

  public function getLeagueByIdAction (Request $request)
  {
    $league = $request->request->all();
    $gId = $league['gId'];
    $em = $this->getDoctrine()->getManager();


    $query = $em->createQuery(
    'SELECT g.id,g.league_name,g.start_date,g.end_date ,g.virtual_money ,g.assets 
    FROM AppBundle:Group g
    WHERE g.id = :id
    '
)->setParameter('id',$gId);
$products = $query->setMaxResults(1)->getOneOrNullResult();

    $query1 = $em->createQuery(
    'SELECT ga.asset_id  
  
    FROM AppBundle:Group g , AppBundle:GroupAsset as ga
    where ga.group_id = g.id 
    and g.id = :id
    '
)->setParameter('id',$gId);
$assets = $query1->getResult();

/*feedback*/

 $query2 = $em->createQuery(
    'SELECT gf.feedback_id  
  
    FROM AppBundle:Group g , AppBundle:GroupFeedback as gf
    where gf.group_id = g.id 
    and g.id = :id
    '
)->setParameter('id',$gId);
$feedbacks = $query2->getResult();

$as = [];
foreach($assets as $i => $item) {
     
    $as[$i] = $item['asset_id'];
     // $array[$i] is same as $item
}

$fb = [];
foreach($feedbacks as $i => $item) {
     
    $fb[$i] = $item['feedback_id'];
     // $array[$i] is same as $item
}
//return new JsonResponse($as);
//$products = $query->getResult();
 return new JsonResponse(array('league'=>$products,'assets'=>implode(',', ($as)) ,'feedback'=>implode(',', ($fb)) ));

    $leagueData = new Group();
    $res = $em->getRepository('AppBundle:Group')->findOneById($gId);

    if($res)
    {

      $leagueData->setLeague_name($res->getLeague_name());
      $leagueData->setVirtual_money($res->getVirtual_money());
      $leagueData->setGroup_name($res->getGroup_name());
      $leagueData->setStart_date($res->getStart_date());
      $leagueData->setEnd_date($res->getEnd_date());
      $leagueData->setAssets($res->getAssets());
      $leagueData->setId($res->getId());

      return new JsonResponse($leagueData);
    }
  }

  public function updateLeagueAction(Request $request)
  {
    $requestData  =  $request->request->all();
    $requestData = $requestData['data'];
   
    $em = $this->getDoctrine()->getManager();
    $TD =  $em->getRepository('AppBundle:Group')->find($requestData['gId']);



      $RAW_QUERY1 = "
          DELETE FROM `group_assets` WHERE `group_assets`.`group_id` = :gId
      ";

      $stmt =$em->getConnection()->prepare($RAW_QUERY1);
      $stmt->execute(array('gId'=>$requestData['gId']));


    if($TD)
    {
       $TD->setStart_date($requestData['start_date']);
       $TD->setEnd_date($requestData['end_date']);
       $TD->setVirtual_money($requestData['virtual_money']);
       $TD->setLeague_name($requestData['league_name']);
       $TD->setAssets("1");
       $em->flush($TD);

        $assets = $requestData['assets'];
      foreach ($assets as $asset) 
      {
        
          $GA = new GroupAsset;
          $GA->setGroup_id($TD->getId());
          $GA->setAsset_id($asset);
          $em->persist($GA);
          $em->flush();
        
      }

       return new JsonResponse(array('status' => 'success','reason' => 'updated successfully','reaponse' => 200));
    }
     return new JsonResponse(array('status' => 'failure','reason' => 'something went wrong','reaponse' => 200));

  }

    public function updateFeedbackAction(Request $request)
  {
    $requestData  =  $request->request->all();
    $requestData = $requestData['data'];
   
    $em = $this->getDoctrine()->getManager();
    $TD =  $em->getRepository('AppBundle:Group')->find($requestData['gId']);


    $feedbacks = $requestData['feedback'];
    if(count($feedbacks) == 0)
        return new JsonResponse(array('status' => 'failure','reason' => 'Select atleast one feedback','reaponse' => 200));
      $RAW_QUERY1 = "
          DELETE FROM `group_feedback` WHERE `group_feedback`.`group_id` = :gId
      ";

      $stmt =$em->getConnection()->prepare($RAW_QUERY1);
      $stmt->execute(array('gId'=>$requestData['gId']));


    if($TD)
    {
       /*$TD->setStart_date($requestData['start_date']);
       $TD->setEnd_date($requestData['end_date']);
       $TD->setVirtual_money($requestData['virtual_money']);
       $TD->setLeague_name($requestData['league_name']);
       $TD->setAssets("1");
       $em->flush($TD);*/

        

      foreach ($feedbacks as $feedback) 
      {
        
          $GF = new GroupFeedback;
          $GF->setGroup_id($TD->getId());
          $GF->setFeedback_id($feedback);
          $em->persist($GF);
          $em->flush();
        
      }

       return new JsonResponse(array('status' => 'success','reason' => 'updated successfully','reaponse' => 200));
    }
     return new JsonResponse(array('status' => 'failure','reason' => 'something went wrong','reaponse' => 200));

  }

  public function checkCurrentPasswordAction(Request $request)
  {
    $requestData  =  $request->request->all();
    $password = $requestData['password'];
    $tId = $requestData['tId'];
    $em = $this->getDoctrine()->getManager();
    $TD =  $em->getRepository('AppBundle:Teacher')->find($tId);

    if($TD)
    {
      $em = $this->getDoctrine()->getManager();

      $user = $em->getRepository('AppBundle:UserPurchaseHistory')
                  ->findEmail($TD->getEmail()); // TODO from session

         $encoder = new MessageDigestPasswordEncoder();
         //return new JsonResponse($user);
         $isValid =  $encoder->isPasswordValid($user['password'], $password ,'');
          
        if($isValid)
        {
           return new JsonResponse(array('status' => 'success','response' => 200));
        }  
        else
           return new JsonResponse(array('status' => 'failure','reason' => 'incorrect current password','reaponse' => 200));    
      return new JsonResponse($pwEN);
    }
    

  }

   public function updatePasswordAction(Request $request)
  {
    $requestData  =  $request->request->all();
    $password = $requestData['password'];
    $currentPassword = $password['currentPassword'];
    $tId = $requestData['tId'];
    $em = $this->getDoctrine()->getManager();
    $TD =  $em->getRepository('AppBundle:Teacher')->find($tId);
    if($TD)
    {
      $em = $this->getDoctrine()->getManager();

      $user = $em->getRepository('AppBundle:UserPurchaseHistory')
                  ->findEmail($TD->getEmail()); // TODO from session

     $encoder = new MessageDigestPasswordEncoder();
         //return new JsonResponse($password);
         $curEncPassword =   $encoder->encodePassword($password['currentPassword'], '');
         $encPassword =   $encoder->encodePassword($password['password'], '');
         //return new JsonResponse($encodePassword."---------".$user['password']);
        if($curEncPassword == $user['password'])
        {
            if($password['password'] != $user['password'])
            {
                 $passwordupdate = $em->getRepository('AppBundle:UserPurchaseHistory')
                  ->updatePassword($TD->getEmail(),$encPassword); 
            }
            else
            {
               return new JsonResponse(array('status' => 'failure','reason' => 'New password should not be same as current password','reaponse' => 200));  
            }
        }  
        else
           return new JsonResponse(array('status' => 'failure','reason' => 'incorrect current password','reaponse' => 200));    
      return new JsonResponse(array('status' => 'success','reason' => 'Password updated successfully','reaponse' => 200)); 
    }
  }


}