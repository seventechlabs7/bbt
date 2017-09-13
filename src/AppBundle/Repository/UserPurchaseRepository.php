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
            SELECT user.id_admin as id,user.email as email,user.password as password  from users as user where user.email = :email
            ';
            $stmt = $conn->prepare($sql);
             $stmt->execute(array('email' => $email));
            $final = $stmt->fetch();   
           // var_dump($final);die;         
            return ($final);
    }

    public function rankingList($tid)
    {
        /*$sql1 = ' 
                  SELECT purchase.id as recordId , user.username,user.id_admin as userId ,purchase.prec_apertura_compra as purchaseAmount, sales.prec_cierre_venta as salesAmount , purchase.volumen as shares ,SUM( IFNull(g.virtual_money, 0)  + ( - IFNull(purchase.prec_apertura_compra, 0) ) + IFNull(sales.prec_cierre_venta, 0) )  as amount 
                  FROM `hist_user_compra` as purchase  ,
                  group_emails as ge , groups as g , users as user 
                  left JOIN hist_user_venta as sales    on sales.id_user = user.id_admin WHERE
                  user.id_admin = purchase.id_user 
                  and g.id = ge.group_id and g.teacher_id = :tid and user.email = ge.email group by user.id_admin 
                ';*/
            $sql1 = '
                        SELECT amounttable.patrimonio as amount ,
                        pos.patrimonio_total as newamount , pos.posicion as position ,pos.posicion_ant as old_position,
                        pos.beneficio_total as benefits ,  
                        user.username as name,user.id_admin as userId , count(op.id_user) as operations ,
                        IFNull(chat.total, 0) as total 
                        from hist_teacher_league_ranking as pos, users as user 
                        left join chats_sin_leer as chat on chat.id_user =:idUser and chat.id_user_send = user.id_admin
                        left join hist_user_operaciones as op   on  op.id_user = user.id_admin
                        left join hist_patrimonio as amounttable on amounttable.id_user = user.id_admin
                        where pos.id_user = user.id_admin group by pos.id_user order by pos.posicion ASC
                    ';

                $conn = $this->getEntityManager()
                ->getConnection();
                $sql = $sql1;
                $stmt = $conn->prepare($sql);
                $stmt->execute(array('idUser' => $tid ));
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
    
    public function getCurrentuserPassword($id)
    {
            $conn = $this->getEntityManager()
            ->getConnection();
            $sql = '
            SELECT user.password as password from users as user where user.id_admin = :id
            ';
            $stmt = $conn->prepare($sql);
             $stmt->execute(array('id' => $id));
            $final = $stmt->fetch();   
           // var_dump($final);die;         
            return ($final);
    }

    public function updatePassword ($email,$password)
    {
        $conn = $this->getEntityManager()
            ->getConnection();
            $sql = '
            UPDATE users set password = :password where email = :email 
            ';
            $stmt = $conn->prepare($sql);
             $stmt->execute(array('email' => $email,'password'=>$password));
            //$final = $stmt->fetch();   
            //var_dump($final);die;         
            return ($stmt);
    }

    public function getChat($uId,$tId)
    {
        $members1 = $tId.'##'.$uId;
        $members2 = $uId.'##'.$tId;

         $conn = $this->getEntityManager()
            ->getConnection();
            $sql = '
            SELECT chat.id,chat.members , chat.messages  ,user.id_admin as userId ,user.username as username  
            from chats as chat , users as user 
            where (chat.members = :members1 or chat.members = :members2) and user.id_admin = :uId
            ';
            $stmt = $conn->prepare($sql);
             $stmt->execute(array('members1' => $members1,'members2'=>$members2,'uId'=>$uId));
            $final = $stmt->fetch();   
           // var_dump($final);die;         
            return ($final);
    }

    public function selectUsers($uId,$fromId)
    {
         $conn = $this->getEntityManager()
            ->getConnection();
            $sql = '
            SELECT id_admin, username, chat_color FROM users WHERE id_admin =:uId OR id_admin = :fromId
            ';
            $stmt = $conn->prepare($sql);
             $stmt->execute(array('uId' => $uId,'fromId'=>$fromId));
            $final = $stmt->fetchAll();   
           // var_dump($final);die;         
            return ($final);
    }

     public function selectChats($room)
    {
         $conn = $this->getEntityManager()
            ->getConnection();
            $sql = '
            select * from chats where members = :room
            ';
            $stmt = $conn->prepare($sql);
             $stmt->execute(array('room' => $room));
            $final = $stmt->fetchAll();   
           // var_dump($final);die;         
            return ($final);
    }

    public function insertChat($members,$newmessage)
    {
            $conn = $this->getEntityManager()
                         ->getConnection();
            $sql = '
                   INSERT INTO chats (type, members, messages) VALUES (:type, :members,:message ) 
                    ';
            $stmt = $conn->prepare($sql);
             $stmt->execute(array('type' => 0,'members'=>$members ,'message' =>"<p>".$newmessage."</p>##@@last_message@@##"));
            //$final = $stmt->fetch();   
            //var_dump($final);die;         
            return ($stmt);
    }
    public function updateChat($members,$newmessage)
    {
            $conn = $this->getEntityManager()
                         ->getConnection();
            $sql = '
                   UPDATE  chats set  messages =:messages  where members = :members  
                    ';
            $stmt = $conn->prepare($sql);
             $stmt->execute(array('members'=>$members ,'messages' =>"<p>".$newmessage));
            //$final = $stmt->fetch();   
            //var_dump($final);die;         
            return ($stmt);
    }

     public function authenticate($user)
    {
            $conn = $this->getEntityManager()
                         ->getConnection();
            $sql = '
                   select id_admin, email ,password from users  where email = :email limit 1
                   ';
             $stmt = $conn->prepare($sql);
             $stmt->execute(array('email' => $user));
            $final = $stmt->fetch();   
           // var_dump($final);die;         
            return ($final);
    }
     public function getTeacherId($user)
    {
            $conn = $this->getEntityManager()
                         ->getConnection();
            $sql = '
                   select id from teachers  where email = :email limit 1
                   ';
             $stmt = $conn->prepare($sql);
             $stmt->execute(array('email' => $user));
            $final = $stmt->fetch();   
           // var_dump($final);die;         
            return ($final);
    }

     public function totalUsers($user)
    {
            $conn = $this->getEntityManager()
                         ->getConnection();
            $sql = '
                   SELECT count(user.id_admin) as totalUsers  FROM  users as user  , group_emails as ge , groups as g

             WHERE 
             g.id = ge.group_id and g.teacher_id = :tid and user.email = ge.email 
            
                    ';
             $stmt = $conn->prepare($sql);
             $stmt->execute(array('tid' => $user));
            $final = $stmt->fetch();   
           // var_dump($final);die;         
            return ($final);
    }

        public function dashBoard($tid)
    {
            $sql1 = 
                '
                    SELECT 
                    sum(pos.beneficio_total) as benefits ,  
                    ((pos.patrimonio_total -25000.00)/25000 ) * 100 as percentage
                    , count(op.id) as operations 
                   
                    from hist_teacher_league_ranking as pos, users as user 
                   
                    left join hist_user_operaciones as op   on  op.id_user = user.id_admin
                    
                    where pos.id_user = user.id_admin 
                ';

                $conn = $this->getEntityManager()
                ->getConnection();
                $sql = $sql1;
                $stmt = $conn->prepare($sql);
                $stmt->execute(array('idUser' => $tid ));
                $final = $stmt->fetch();   
               // var_dump($final);die;         
                return ($final);

    }

      public function operationsOfStudent($tid,$sid,$gid)
    {
            $sql1 = 
                '
                    SELECT  com.nom_empresa as asset ,
                    op.fecha_compra  as pruchaseDate ,op.prec_compra as pruchaseprice ,op.volumen_compra as purchaseShare,
                    op.prec_venta as salePrice ,op.fecha_venta as saleDate ,op.volumen_operacion as saleShare
                    from hist_user_operaciones as op  ,empresas as com 
                    where
                     com.id = op.id_empresa 
                ';

                $conn = $this->getEntityManager()
                ->getConnection();
                $sql = $sql1;
                $stmt = $conn->prepare($sql);
                $stmt->execute(array('sid' => $sid ));
                $final = $stmt->fetchAll();   
               // var_dump($final);die;         
                return ($final);

    }
}