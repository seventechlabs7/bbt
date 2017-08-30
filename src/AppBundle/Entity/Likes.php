<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LikesRepository")
 * @ORM\Table(name="operaciones_like")
 */
class Likes
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="`id_compra`",type="integer" ,length=6)
     */
    private $purchaseId;

    /**
     * @ORM\Column(name="`id_operacion`",type="integer" ,length=6)
     */
    private $operationId;


     /**
     * @ORM\Column(name="`ids_like`",type="string" ,length=200)
     */
    private $likes;





    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }


     public function getPurchaseId(){
        return $this->purchaseId;
    }

    public function setPurchaseId($purchaseId){
        $this->purchaseId = $purchaseId;
    }


     public function getOperationId(){
        return $this->operationId;
    }

    public function setOperationId($operationId){
        $this->operationId = $operationId;
    }

    
    public function getLikes(){
        return $this->likes;
    }

    public function setLikes($likes){
        $this->likes = $likes;
    }


   
}
