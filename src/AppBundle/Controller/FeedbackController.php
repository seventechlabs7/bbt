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
use AppBundle\Entity\UserOperations;
use AppBundle\Service\BbtCrypt;
use AppBundle\Service\Utils;
use AppBundle\Controller\TokenAuthenticatedController;

class FeedbackController extends Controller implements TokenAuthenticatedController
{

	

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
      //$groups = $query->getResult();
         // $groupData = $query1->setMaxResults(1)->getOneOrNullResult();
      //return new JsonResponse($query1);
     return new JsonResponse(array('status' => 'success','groups'=>$group,'groupData' => $group,'reason' => 'page loaded','response' => 200));
  }




}