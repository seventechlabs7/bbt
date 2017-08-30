<?php

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class LikesRepository extends EntityRepository
{
	 /**
     * @return LikesRepository[]
     */

   public function findRecordLikes($obj)
    {
            $dummyUserId = 1000;
            $conn = $this->getEntityManager()
            ->getConnection();
            $sql = '
            SELECT *  from operaciones_like as likes where id_compra = :purchase_id 
            ';
            $stmt = $conn->prepare($sql);
             $stmt->execute(array('purchase_id' => $obj->purchaseId));
            $final = $stmt->fetch();   
           // var_dump($final);die;         
            return ($final);
    }

    public function updateLikes($obj)
    {
            $dummyUserId = 1000;
            $conn = $this->getEntityManager()
            ->getConnection();
            $sql = '
            UPDATE operaciones_like set ids_like = :likes where id_compra = :id 
            ';
            $stmt = $conn->prepare($sql);
             $stmt->execute(array('id' => $obj->purchaseId,'likes' =>$obj->newLikes));
            //$final = $stmt->fetch();   
            //var_dump($final);die;         
            return ($stmt);
    }

    public function postComment($obj)
    {
            $dummyUserId = 1000;
            $conn = $this->getEntityManager()
            ->getConnection();
            $sql = '
         INSERT INTO `comentarios` (`id`, `id_compra`, `id_operacion`, `comentario`, `id_user`, `ids_likes`) VALUES (NULL, :purchase_id, 0, :comment, :user_id, " ");
            ';
            $stmt = $conn->prepare($sql);
             $stmt->execute(array('purchase_id' => $obj->purchaseId,'comment' => $obj->comment,'user_id' =>$obj->userId));
            //$final = $stmt->fetch();   
            //var_dump($final);die;         
            return ($stmt);
    }

}