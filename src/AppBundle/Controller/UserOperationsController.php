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

            return new JsonResponse($result);

	}
}