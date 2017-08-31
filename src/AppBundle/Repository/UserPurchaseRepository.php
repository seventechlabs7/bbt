<?php

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserPurchaseRepository extends EntityRepository
{
	 /**
     * @return UserPurchaseHistory[]
     */
    public function findAllOperationsOfConnectedUsers()
    {

        	$dummyUserId = 1000;
            $conn = $this->getEntityManager()
         	->getConnection();
       		$sql = '
            SELECT purchase.id as recordId , user.username,user.id_admin as userId ,company.nom_empresa ,purchase.prec_apertura_compra as amount, purchase.volumen as shares  FROM `hist_user_compra` as purchase, users as user ,empresas as company WHERE company.id = purchase.id_empresa and user.id_admin = purchase.id_user group by purchase.id limit 10
            ';
	        $stmt = $conn->prepare($sql);
	       	$stmt->execute();
	        $final = $stmt->fetchAll();   
	       // var_dump($final);die;     	
           	return ($final);
    }


     public function findUserLikes($re)
    {

            $dummyUserId = 1000;
            $conn = $this->getEntityManager()
            ->getConnection();
            $sql = '
           SELECT likes.ids_like as likes FROM `hist_user_compra` as purchase ,operaciones_like as likes WHERE likes.id_compra =:purchaseId and purchase.id= likes.id_compra and likes.ids_like !=" "
            ';
            $stmt = $conn->prepare($sql);
            $stmt->execute(array('purchaseId' => $re['recordId']));
            $final = $stmt->fetch();   
           // var_dump($final);die;         
            return ($final);
    }

     public function findUserComments($re)
    {

            $dummyUserId = 1000;
            $conn = $this->getEntityManager()
            ->getConnection();
            $sql = '
            SELECT com.id_user as userId , com.ids_likes as likes , com.comentario as comment FROM `hist_user_compra` as purchase, users as user ,comentarios as com   WHERE purchase.id = com.id_compra and user.id_admin = com.id_user   and com.id_compra =:purchaseId
            ';
            $stmt = $conn->prepare($sql);
             $stmt->execute(array('purchaseId' => $re['recordId']));
            $final = $stmt->fetchAll();   
           // var_dump($final);die;         
            return ($final);
    }

      public function findUserNames($userId)
    {

            $dummyUserId = 1000;
            $conn = $this->getEntityManager()
            ->getConnection();
            $sql = '
            SELECT user.username as username from users as user where user.id_admin = :userId
            ';
            $stmt = $conn->prepare($sql);
             $stmt->execute(array('userId' => $userId));
            $final = $stmt->fetch();   
           // var_dump($final);die;         
            return ($final);
    }

    public function postComment($obj)
    {
        
    }

    public function getRecordLikes($obj)
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
    public function findEmail($email)
    {

            $dummyUserId = 1000;
            $conn = $this->getEntityManager()
            ->getConnection();
            $sql = '
            SELECT user.id_admin as id,user.email as email from users as user where user.email = :email
            ';
            $stmt = $conn->prepare($sql);
             $stmt->execute(array('email' => $email));
            $final = $stmt->fetch();   
           // var_dump($final);die;         
            return ($final);
    }
}