<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;
use AppBundle\Entity\Likes;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\UserPurchaseHistory;

class UserOperationsController extends Controller
{

	public function getUserOperationsAction(Request $request)
	{
			 $em = $this->getDoctrine()->getManager();
			$result = $em->getRepository('AppBundle:UserPurchaseHistory')
            ->findAllOperationsOfConnectedUsers();
            
            $final = [];
            foreach ($result as $re) {
			  $likes =    $em->getRepository('AppBundle:UserPurchaseHistory')
           		 ->findUserLikes();
           		 $users = [];
           		   foreach ($likes as $like) {
           		    $likesArray = explode("|",$like);	
           			  foreach ($likesArray as $likeObj) {
        		$username =	$this->getUserNames($likeObj);
           		 	array_push($users,$username['username']);           		 	
           		 }           		 
			}
			 $comments =    $em->getRepository('AppBundle:UserPurchaseHistory')
           		 ->findUserComments();
           		 // return new JsonResponse($comments);
           		 $usersComments = [];
           		
           		   foreach ($comments as $comment) {
           		   	$commentObj = new \stdClass();
           		   	 $likedUsers = [];
           		    $likesArray = explode("|",$comment['likes']);	
           		    $commentatorName =	$this->getUserNames($comment['userId']);
           			  foreach ($likesArray as $likeObj) {
           			  	$commentObj->commentatorName = $commentatorName['username'];
           			  	$commentObj->name = $comment['comment'];
        			$likedName =	$this->getUserNames($likeObj);
        			array_push($likedUsers,$likedName['username']); 
           		 }     
					$commentObj->likedUsers = count($likedUsers);
					$commentObj->commentLikes = $likedUsers;
           		 	array_push($usersComments,$commentObj);  
           		 	       		 
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
        					 else
        					 {
        					 	 array_push($newLikes,$likeObj);
        					 } 

           		 }   
           		 if(count($likesArray) == 0 || $likeFlag)
           		 {
           		 	 array_push($newLikes,$obj->userId);
           		 }

           $obj->newLikes =   implode('|', $newLikes);
          $update = $em->getRepository('AppBundle:Likes')
           		   ->updateLikes($obj);

		 return new JsonResponse($update);
	}

	public function getUserNames($id)
	{
		$em = $this->getDoctrine()->getManager();
		return    $em->getRepository('AppBundle:UserPurchaseHistory')
           		 	->findUserNames($id);
	}
}