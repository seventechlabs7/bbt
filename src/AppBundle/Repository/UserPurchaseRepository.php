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
            SELECT user.username,user.id_admin as userId ,company.nom_empresa ,purchase.prec_apertura_compra as amount, purchase.volumen as shares  FROM `hist_user_compra` as purchase, users as user ,empresas as company WHERE company.id = purchase.id_empresa and user.id_admin = purchase.id_user group by purchase.id limit 10
            ';
	        $stmt = $conn->prepare($sql);
	       	$stmt->execute();
	        $final = $stmt->fetchAll();   
	       // var_dump($final);die;     	
           	return ($final);
    }
}