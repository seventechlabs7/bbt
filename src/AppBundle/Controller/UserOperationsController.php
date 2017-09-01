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
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\UserPurchaseHistory;

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
                $likesArray = array_map('trim',$likesArray);  
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
}