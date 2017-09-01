<?php

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserPurchaseRepository extends EntityRepository
{
	 /**
     * @return UserPurchaseHistory[]
     */
    public function findAllOperationsOfConnectedUsers($tid)
    {

        	//$dummyUserId = 1000;
            $conn = $this->getEntityManager()
         	->getConnection();
       		$sql = '
            SELECT purchase.id as recordId , user.username,user.id_admin as userId ,company.nom_empresa ,purchase.prec_apertura_compra as amount, purchase.volumen as shares  FROM `hist_user_compra` as purchase, users as user ,empresas as company , group_emails as ge , groups as g

             WHERE company.id = purchase.id_empresa and user.id_admin = purchase.id_user 
            and g.id = ge.group_id and g.teacher_id = :tid and user.email = ge.email 
             group by purchase.id 
            ';
	        $stmt = $conn->prepare($sql);
	       	$stmt->execute(array('tid' => $tid));
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
            SELECT com.id as commentId ,com.id_user as userId , com.ids_likes as likes , com.comentario as comment FROM `hist_user_compra` as purchase, users as user ,comentarios as com   WHERE purchase.id = com.id_compra and user.id_admin = com.id_user   and com.id_compra =:purchaseId 
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

    public function rankingList($tid)
    {
        $sql1 = ' 
                  SELECT purchase.id as recordId , user.username,user.id_admin as userId ,purchase.prec_apertura_compra as purchaseAmount, sales.prec_cierre_venta as salesAmount , purchase.volumen as shares ,SUM( IFNull(g.virtual_money, 0)  + ( - IFNull(purchase.prec_apertura_compra, 0) ) + IFNull(sales.prec_cierre_venta, 0) )  as amount 
                  FROM `hist_user_compra` as purchase  ,
                  group_emails as ge , groups as g , users as user 
                  left JOIN hist_user_venta as sales    on sales.id_user = user.id_admin WHERE
                  user.id_admin = purchase.id_user 
                  and g.id = ge.group_id and g.teacher_id = :tid and user.email = ge.email group by user.id_admin 
                ';

                $conn = $this->getEntityManager()
                ->getConnection();
                $sql = $sql1;
                $stmt = $conn->prepare($sql);
                $stmt->execute(array('tid' => $tid));
                $final = $stmt->fetchAll();   
               // var_dump($final);die;         
                return ($final);

    }

    public function findEmailById($id)
    {
            $conn = $this->getEntityManager()
            ->getConnection();
            $sql = '
            SELECT user.email as email from users as user where user.id_admin = :id
            ';
            $stmt = $conn->prepare($sql);
             $stmt->execute(array('id' => $id));
            $final = $stmt->fetch();   
           // var_dump($final);die;         
            return ($final);
    }
}