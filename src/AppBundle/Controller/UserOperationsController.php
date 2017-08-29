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
					$commentObj->likedUsers = $likedUsers;
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
		 $purchaseId = $reqData['req_id'];
		 $comment = $reqData['comment'];
		 //get current user id

		 return new JsonResponse("success");
	}
	public function likeAction(Request $request)
	{
		 $reqData = $request->request->all();
		 $purchaseId = $reqData['req_id'];
		 $comment = $reqData['like'];
		 return new JsonResponse("success");
	}

	public function getUserNames($id)
	{
		$em = $this->getDoctrine()->getManager();
		return    $em->getRepository('AppBundle:UserPurchaseHistory')
           		 	->findUserNames($id);
	}
}