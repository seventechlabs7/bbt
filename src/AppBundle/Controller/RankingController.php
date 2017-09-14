<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;
use AppBundle\Entity\Likes;
use AppBundle\Entity\Group;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\UserPurchaseHistory;
use AppBundle\Service\BbtCrypt;
use AppBundle\Service\Utils;

class RankingController extends Controller
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

	public function getUserNames($id)
	{
		$em = $this->getDoctrine()->getManager();
		return    $em->getRepository('AppBundle:UserPurchaseHistory')
           		 	->findUserNames($id);
	}

  public function showAction (Request $request)
  {
     $ranking = $request->request->all();

     //find all groups by teacher id
      $teacherId = $ranking['uId'];

      $repository = $this->getDoctrine()->getRepository(Group::class);
      $qb = $repository->createQueryBuilder('g');
      $qb->select('g.id','g.group_name')
      ->where($qb->expr()->like('g.teacher_id', ':teacherId'))
      ->setParameter('teacherId', $teacherId);
      $query = $qb->getQuery();
      $groups = $query->getResult();

        //fetch group details 
      $flag = false;
      if(isset($ranking['gId']))
      {
        $flag = true;
        $groupId = $ranking['gId'] ;
      }
      if(!$flag && count($groups) >0 )
      {
        $groupId = $groups[0]['id'] ;
      }

       $qb = $repository->createQueryBuilder('g');
      $qb->select('g.id','g.group_name','g.start_date,g.end_date')
      ->where($qb->expr()->like('g.id', ':groupId'))
      ->setParameter('groupId', $groupId);
      $query1 = $qb->getQuery();
      $group = $query1->getResult();



     return new JsonResponse(array('status' => 'success','groups'=>$groups,'groupData'=>$group,'reason' => 'data loaded','reaponse' => 200));
  }

  public function dashBoardAction(Request $request)
  {
     $ranking = $request->request->all();

      $teacherId = $ranking['uId'];
     $report = new \stdClass();

     $em = $this->getDoctrine()->getManager();
     $count  = $em->getRepository('AppBundle:UserPurchaseHistory')
                ->totalUsers($teacherId);

     $em = $this->getDoctrine()->getManager();
     $dashboard  = $em->getRepository('AppBundle:UserPurchaseHistory')
                ->dashBoard($teacherId);


     $report->count      = $count['totalUsers'];
     $report->operations = $dashboard['operations'];
     $report->percentage = $dashboard['percentage'];
     $report->benefits   = $dashboard['benefits'];

      return new JsonResponse(array('status' => 'success','report'=>$report,'reason' => 'data loaded','reaponse' => 200));
  }

   public function studentDataAction(Request $request)
  {
     $ranking = $request->request->all();

     $teacherId = $ranking['uId'];
     $studentId = $ranking['sId'];
     $groupId = $ranking['gId'];

     $report = new \stdClass();

     $em = $this->getDoctrine()->getManager();
     $op  = $em->getRepository('AppBundle:UserPurchaseHistory')
                ->operationsOfStudent($teacherId,$studentId,$groupId);

     $purchase  = $em->getRepository('AppBundle:UserPurchaseHistory')
                ->studentPurchase($teacherId,$studentId,$groupId);

      $studentList = $em->getRepository('AppBundle:UserPurchaseHistory')
                ->studentList($teacherId,$groupId);
     

      return new JsonResponse(array('status' => 'success','operations'=>$op,'purchase'=>$purchase,'students' => $studentList,
        'reason' => 'data loaded','reaponse' => 200));
  }

    public function rankingListAction(Request $request)
  {
     $reqData = $request->request->all();

    $TID = $reqData['uId'];
  
 
       $em = $this->getDoctrine()->getManager();
     $list  = $em->getRepository('AppBundle:UserPurchaseHistory')
                ->rankingList($TID);
     //get current user id

     return new JsonResponse($list);
  }

  public function getChatAction(Request $request,BbtCrypt $bbtCrypt)
  {
    $reqData = $request->request->all();
    $uId = $reqData['uId'];
    $tId = $reqData['tId'];
    $members1 = $tId.'##'.$uId;
    $members2 = $uId.'##'.$tId;
      $em = $this->getDoctrine()->getManager();
     $list  = $em->getRepository('AppBundle:UserPurchaseHistory')
                ->getChat($uId,$tId);

      $encUID = $bbtCrypt ->encrypt($uId); 
      $encTID = $bbtCrypt ->encrypt($tId);
      $remove = [$encUID, $encTID,'##@@last_message@@##'];
      $replace = [$this->getUserNames($uId)['username'], $this->getUserNames($tId)['username']];
      $list['messages'] = str_replace($remove, $replace, $list['messages']);
    return new JsonResponse(array('status' => 'success','list'=>$list,'encUID' => $encUID,'reason' => 'page loaded','reaponse' => 200));

  }

   public function sendMessageAction(Request $request,BbtCrypt $bbtCrypt,Utils $utils)
  {
    $reqData = $request->request->all();
    $uId = $reqData['uId'];
    $tId = $reqData['tId'];
    $newmessage = $reqData['message'];
    $cssfrom = "css".$bbtCrypt->encrypt($uId);;
    $encuserid = $bbtCrypt->encrypt($tId); 

      $room = "";
      $response = [];
      $roomExists = false;

     $em = $this->getDoctrine()->getManager();
     $list  = $em->getRepository('AppBundle:UserPurchaseHistory')
                ->selectUsers($uId,$tId);

     $arrAsoc = array();
        foreach ($list as $key=>$value) {
            // $arrAsoc[$valor["id_admin"]] = $valor["username"];
            $arrAsoc[$value["id_admin"]]["username"] = $value["username"];
            $arrAsoc[$value["id_admin"]]["chat_color"] = $value["chat_color"];
        }

      $roomMembers = [$uId, $tId];
        sort($roomMembers);
        
        foreach ($roomMembers as $key => $value) {
            if($key == count($roomMembers) -1){
                $room .= $value;
            }else{
                $room .= $value."##";
            }
        }

         $chats  = $em->getRepository('AppBundle:UserPurchaseHistory')
                ->selectChats($room);

                     if(count($chats) >= 1){
                // el room existe
                $roomExists = true;
            }
            
            $fecha = date('Y-m-d H|i|s');
            
            
            $fecha = $utils->fecha_to_es($fecha);


            $newmessage = $newmessage."<em>".$fecha."</em>";
            if(!$roomExists)
              {

                 $insertChat  = $em->getRepository('AppBundle:UserPurchaseHistory')
                ->insertChat($room,$newmessage);
                
                $remove = [$encuserid, $cssfrom];
                $replace = ["Yo", "class='me'"];
                $cleanMessage = str_replace($remove, $replace, $newmessage);

                $response[]["messages"] = "<p class='me'>".$cleanMessage."</p>";

            }
            
            if($roomExists){
                $preremove = ["##@@last_message@@##"];
                // $prereplace = ["<p $cssfrom>".$newmessage."</p>##@@last_message@@##"];
                $prereplace = ["<p>".$newmessage."</p>##@@last_message@@##"];
                $precleanMessage = str_replace($preremove, $prereplace, $chats[0]["messages"]);
                

                  $updatechat  = $em->getRepository('AppBundle:UserPurchaseHistory')
                ->updateChat($room,$precleanMessage);

            }


            
    return new JsonResponse($chats);

  }


}