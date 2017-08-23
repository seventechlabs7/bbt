<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class LuckyController extends Controller
{
    /**
     * @Route("/lucky/number")
     */
    public function numberAction()
    {
        $number = mt_rand(0, 100);

        return $this->render('lucky/number.html.twig', array(
            'number' => $number,
        ));
    }

    /**
     *@Route("/insert")
     */
    public function insert()
    {
        // you can fetch the EntityManager via $this->getDoctrine()
    // or you can add an argument to your action: createAction(EntityManagerInterface $em)
    $em = $this->getDoctrine()->getManager();

    $product = new Product();
    $product->setName('Keyboard');
    //$product->setPrice(19.99);
    $product->setDescription('Ergonomic and stylish!');


    // tells Doctrine you want to (eventually) save the Product (no queries yet)
    $em->persist($product);

    // actually executes the queries (i.e. the INSERT query)
    $em->flush();

    return new Response('Saved new product with id '.$product->getName());
    }
    
}