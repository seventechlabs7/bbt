<?php

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserOperationsRepository extends EntityRepository
{
	 /**
     * @return UserOperations[]
     */

    public function checkUser($email)
    {
          $conn = $this->getEntityManager()
          ->getConnection();

          $sql = 'SELECT id_admin as user_id ,email ,username FROM users where users.email = :email LIMIT 1;';

          $stmt = $conn->prepare($sql);
          $stmt->execute(array('email' => $email));
          $final = $stmt->fetch();         
          return ($final);
    }
    public function findAllOperationsOfConnectedUsers($tid)
    {

        	//$dummyUserId = 1000;
            $conn = $this->getEntityManager()
         	->getConnection();
       		$sql = '
            SELECT purchase.id as recordId , user.username,user.id_admin as userId ,company.nom_empresa ,
            ROUND(purchase.prec_apertura_compra,2) as amount, 
            ROUND(purchase.volumen,2) as shares  

            FROM `hist_user_compra_proff_'.$tid.'` as purchase,
                  users as user ,
                  empresas as company , 
                  group_emails as ge , 
                  groups as g

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


     public function findUserLikes($re,$tid)
    {

            $dummyUserId = 1000;
            $conn = $this->getEntityManager()
            ->getConnection();
            $sql = '
                        SELECT likes.ids_like as likes
                        FROM `hist_user_compra_proff_'.$tid.'` as purchase ,
                        operaciones_like as likes 
                        WHERE likes.id_compra =:purchaseId and 
                        purchase.id= likes.id_compra and 
                        likes.ids_like !=" "
                  ';
            $stmt = $conn->prepare($sql);
            $stmt->execute(array('purchaseId' => $re['recordId']));
            $final = $stmt->fetch();   
           // var_dump($final);die;         
            return ($final);
    }

     public function findUserComments($re,$tid)
    {

            $dummyUserId = 1000;
            $conn = $this->getEntityManager()
            ->getConnection();
            $sql = '
                  SELECT com.id as commentId ,com.id_user as userId , com.ids_likes as likes , com.comentario as comment 
                  FROM `hist_user_compra_proff_'.$tid.'` as purchase,
                  users as user ,comentarios as com   
                  WHERE purchase.id = com.id_compra and user.id_admin = com.id_user   and com.id_compra =:purchaseId 
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
              $sql1 = '
                     SELECT 
                            ROUND(amounttable.patrimonio,2) as amount ,
                            ROUND(pos.patrimonio_total,2) as newamount , pos.posicion as position ,pos.posicion_ant as old_position,
                            ROUND(pos.beneficio_total,2)as benefits ,  
                            user.username as name,user.id_admin as userId , count(op.id_user) as operations ,
                            IFNull(chat.total, 0) as total 
                      FROM  
                            hist_ranking_posiciones_proff_'.$tid.' as pos, 
                            users as user 
                            left join chats_sin_leer as chat on chat.id_user =:idUser and chat.id_user_send = user.id_admin
                            left join hist_user_operaciones_proff_'.$tid.' as op   on  op.id_user = user.id_admin
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
     public function findIdByEmail($email)
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
             $stmt->execute(array('members'=>$members ,'messages' =>$newmessage));
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
             g.id = ge.group_id and g.teacher_id = :tid and user.email = ge.email and ge.active =1
            
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
                      ROUND(sum(pos.beneficio_total),2) as benefits ,  
                      ROUND(((pos.patrimonio_total -25000.00)/25000 ) * 100,2) as percentage
                      , count(op.id) as operations 
                   
                    FROM
                     hist_ranking_posiciones_proff_'.$tid.' as pos, users as user 
                   
                    left join hist_user_operaciones_proff_'.$tid.' as op   on  op.id_user = user.id_admin
                    
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
                    SELECT  
                        com.nom_empresa as asset ,
                        op.fecha_compra  as purchaseDate ,
                        ROUND(op.prec_compra,2) as purchasePrice,
                        ROUND(op.volumen_compra,2) as purchaseShare,
                        ROUND(op.prec_venta,2) as salePrice ,
                        op.fecha_venta as saleDate ,
                        ROUND(op.volumen_operacion,2) as saleShare,
                        ROUND(op.beneficios,2) as benefits , 
                        ROUND(((op.prec_venta - op.prec_compra) / op.prec_compra)*100,2) as benefitPercentage 
                    FROM 
                      hist_user_operaciones_proff_'.$tid.' as op  ,empresas as com 
                    WHERE
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

      public function studentPurchase($tid,$sid,$gid)
    {
            $sql1 = 
                '
                    SELECT  
                    com.nom_empresa as asset ,
                    op.fecha_apertura_compra  as purchaseDate ,
                    ROUND(op.prec_apertura_compra,2) as purchasePrice ,
                    ROUND(op.volumen,2) as purchaseShare ,
                    ROUND(com.current_price,2) as current_price , 
                    ROUND(((op.prec_apertura_compra * op.volumen) - (com.current_price )* (op.volumen - op.volumen_ya_vendido)),2) as benefit
                    from hist_user_compra_proff_'.$tid.' as op  ,empresas as com 
                    WHERE
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

    public function studentList($tId,$gId)
    {
        $sql1 = 
                '
                    SELECT  user.id_admin as userId ,
                     user.email as email ,user.username 
                    from 
                    users as user , 
                    groups as g ,
                    group_emails as ge 
                    where g.id = :gId and  ge.group_id = g.id and ge.email = user.email and g.teacher_id = :tId; 

                ';

                $conn = $this->getEntityManager()
                ->getConnection();
                $sql = $sql1;
                $stmt = $conn->prepare($sql);
                $stmt->execute(array('gId' => $gId ,'tId' => $tId));
                $final = $stmt->fetchAll();   
               // var_dump($final);die;         
                return ($final);
    }

    public function findUserIdByTeacherId($tId)
    {
        $sql1 = 
                '
                    SELECT  user.id_admin as userId ,icono as image
                    from users as user ,teachers as t 
                    where t.id = :tId and  t.email = user.email ; 
                ';

                $conn = $this->getEntityManager()
                ->getConnection();
                $sql = $sql1;
                $stmt = $conn->prepare($sql);
                $stmt->execute(array('tId' => $tId));
                $final = $stmt->fetch();   
               // var_dump($final);die;         
                return ($final);
    }

     public function findRankingDataBygroupId($gId)
    {
        $sql1 = 
                '
                   SELECT 
                          g.id, g.group_name, 
                          l.fecha_inicio as start_date,l.fecha_fin as end_date
                    FROM 
                        groups as g ,
                        ligas as l  ,
                        group_leagues as gl 
                    WHERE 
                        g.id = :gId and  gl.group_id = g.id and gl.league_id = l.id 
                ';

                $conn = $this->getEntityManager()
                ->getConnection();
                $sql = $sql1;
                $stmt = $conn->prepare($sql);
                $stmt->execute(array('gId' => $gId));
                $final = $stmt->fetch();   
               // var_dump($final);die;         
                return ($final);
    }


    public function getLeagueData($gId)
    {
       $sql1 = 
                '
                  SELECT 
                          g.id, g.group_name, 
                          l.fecha_inicio as start_date,l.fecha_fin as end_date
                    from 
                        groups as g ,ligas as l  ,group_leagues as gl 
                    where 
                        g.id = :gId and  gl.group_id = g.id and gl.league_id = l.id 
                ';

                $conn = $this->getEntityManager()
                ->getConnection();
                $sql = $sql1;
                $stmt = $conn->prepare($sql);
                $stmt->execute(array('gId' => $gId));
                $final = $stmt->fetch();   
               // var_dump($final);die;         
                return ($final);
    }

     public function getLeagueDataMain($gId)
    {
       $sql1 = 
                '
                  SELECT  
                          g.id, g.group_name, 
                          l.id,l.nom_liga as league_name , l.fecha_inicio as start_date,l.fecha_fin as end_date, 
                          gl.virtual_money 
                  FROM 
                          groups as g ,ligas as l  ,group_leagues as gl 
                  WHERE 
                          g.id = :gId and  gl.group_id = g.id and gl.league_id = l.id 
                ';

                $conn = $this->getEntityManager()
                ->getConnection();
                $sql = $sql1;
                $stmt = $conn->prepare($sql);
                $stmt->execute(array('gId' => $gId));
                $final = $stmt->fetch();   
               // var_dump($final);die;         
                return ($final);
    }


      public function getLeagueAssets($gId)
    {
       $sql1 = 
                '
                  SELECT 
                        ga.asset_id 
                  FROM 
                        group_assets as ga ,groups as g , group_leagues as gl
                  WHERE 
                       ga.group_id =g.id and g.id = :gId and gl.group_id = g.id
                ';

                $conn = $this->getEntityManager()
                ->getConnection();
                $sql = $sql1;
                $stmt = $conn->prepare($sql);
                $stmt->execute(array('gId' => $gId));
                $final = $stmt->fetchAll();   
               // var_dump($final);die;         
                return ($final);
    }

     public function getLeagueFeedback($gId)
    {
       $sql1 = 
                '
                  SELECT 
                      gf.feedback_id 
                  FROM 
                      group_feedback as gf ,groups as g , group_leagues as gl 
                  WHERE
                      gf.group_id =g.id and g.id = :gId and gl.group_id = g.id
                ';

                $conn = $this->getEntityManager()
                ->getConnection();
                $sql = $sql1;
                $stmt = $conn->prepare($sql);
                $stmt->execute(array('gId' => $gId));
                $final = $stmt->fetchAll();   
               // var_dump($final);die;         
                return ($final);
    }

    public function passwordResetCheck($email)
    {
          $conn = $this->getEntityManager()
          ->getConnection();

          $sql = 'SELECT id,otp FROM recovery as r 
                  where 
                  r.user_id = :id  and  TIMESTAMPDIFF(HOUR, NOW(), created_at) <=24 ;
          ';

          $stmt = $conn->prepare($sql);
          $stmt->execute(array('id' => $email));
          $final = $stmt->fetch();         
          return ($final);
    }

    public function checkValidOtp($otp)
    {
          $conn = $this->getEntityManager()
          ->getConnection();

          $sql = 'SELECT id,otp FROM recovery as r 
                  where 
                  r.otp = :otp  and  TIMESTAMPDIFF(HOUR, NOW(), created_at) <=24 ;
          ';

          $stmt = $conn->prepare($sql);
          $stmt->execute(array('otp' => $otp));
          $final = $stmt->fetch();         
          return ($final);
    }
}