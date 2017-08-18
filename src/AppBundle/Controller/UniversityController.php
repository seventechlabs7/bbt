<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Group;
use AppBundle\Entity\GroupEmail;
use AppBundle\Entity\Teacher;

class UniversityController extends Controller
{

	public function signupTeacherAction(Request $request)
	{
		$teacher = $request->request->all();
		//$em = $this->getDoctrine()->getManager();
		//$qb = $em->getRepository('AppBundle:Teacher')->createQueryBuilder('i');

		/*$qb->select('u')
		   ->from('Teacher', 'u')
		   ->where('u.id = ?1')
		   ->orderBy('u.name', 'ASC');*/

		//return $qb;
		 /* $result = $em->createQuery("SELECT * FROM Teacher t")->getScalarResult();
			$ids = array_column($result, "id");
			return $ids;*/

        /*$repository = $this->getDoctrine()->getRepository('AppBundle:Teacher');
        $query = $repository->createQueryBuilder('t')
        			->select('t.email')
        			//->where("t.email",'=' ,$teacher['email'])
        			//->where('t.name = aaa')
        			 //->where('t.id = 1')
        			//->where("t.name!= ".$teacher['username'])
        			//->where("t.email!= ".$teacher['email'])

        			 ->getQuery();
        $entities= $query->getResult();
        return 	$entities;	*/

       /* $car = $this->getDoctrine()
	    ->getRepository('AppBundle:Teacher')
	    ->findOneBy(array('email' => $teacher['email']));
	    return $car;*/
		/*$qb = $this->getDoctrine()->getManager();
		$qb->select('COUNT(u)')->from('AppBundle:Teacher', 't');
		$count = $qb->getQuery()->getSingleScalarResult();
		return $count;*/

		$db = $this->get('database_connection');
		$query = 'select email from  teachers';
		//$query->where('email','=',$teacher['email']);
		$sth = $db->prepare($query);
		$sth->execute();
		$db_email = $sth->fetchAll();
		$myArray= array();

		foreach ($db_email as $key => $arremail) {
			foreach ($arremail as $key => $email) {
				$myArray[] = $email;
			}
		}
		$emailvalidate = 0;
		foreach ($myArray as $key => $checkemail) {
			if($checkemail != $teacher['email']){
				$emailvalidate = 1;
			}else{
				$emailvalidate = 0;
			}
		}
		//return $emailvalidate;
		/*while($row = $sth->fetch()) {
		    return $row;
		}*/

		/*$profilis= $em->select('t.id')
              ->from('AppBundle:Teacher', 't')
              ->getQuery()
              ->getResult();
		//$profilis = $query->getResult();
		return $profilis;*/

		if($emailvalidate === 1){
			$em = $this->getDoctrine()->getManager();
			$TD = new Teacher();
			$TD->setName($teacher['username']);
			$TD->setSurname($teacher['surname']);
			$TD->setEmail($teacher['email']);
			$TD->setPassword($teacher['password']);
			$TD->setUniversity($teacher['university']);
			$TD->setCreated_by(1);
			$em->persist($TD);
		    $em->flush();

			return $this->json(array('status' => 'success','teacher_id' => $TD->getId(),'reason' => 'Teacher Saved Successfully','reaponse' => 200));
		}else{
			return $this->json(array('status' => 'failed','reason' => 'Email is already Exits'));
		}
	}

    public function saveTeacherAction(Request $request)
    {    	    	
		$teacher = $request->request->get('teacher');		
		$file = $request->files->get('file');
		
		
		$em = $this->getDoctrine()->getManager();		
		$emails_list = $teacher['mail_list'];
		$emails = explode(',', $emails_list);		

		//$em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:Teacher')->find(33);
        $statusCode = 200;

        $view = $this->view($entities, $statusCode);
        return $this->handleView($view);
        //return 	$entities;	 
        $id = 3;
        $repository = $this->getDoctrine()
    			->getRepository('AppBundle:Teacher'); 
    	$product = $repository->find($id);
    	return $product;
		$group = new Group();
		$group->setTeacher_id($teacher['id']);
		$group->setGroup_name($teacher['group_name']);
		$group->setLeague_name($teacher['league_name']);
		$group->setFeedback($teacher['feedback']);
		$group->setAssets($teacher['assets']);
		$group->setVirtual_money($teacher['virtual_money']);
		$group->setStart_date($teacher['start_date']);
		$group->setEnd_date($teacher['end_date']);
		$group->setCreated_by(1);

		$em->persist($group);
	    $em->flush();

	    foreach ($emails as $email) 
	    {
	    	$GM = new GroupEmail;
	    	$GM->setGroup_id($group->getId());
	    	$GM->setEmail($email);
	    	$GM->setCreated_by(1);
	    	$em->persist($GM);
	    	$em->flush();
	    }
	    if(0)
		{
			$reader = $this->get("arodiss.xls.reader");
			$content = $reader->readAll($file);
			return $this->json($content);
			$excel = $this->get('os.excel');
	    	$excel->loadFile($file);
			$rows = $excel->getRowCount();
			$data = $excel->getSheetData();
				return $this->json(['count'=>$data]);
			for($i=0;$i<$rows;$i++) 			
			{
				return $this->json( $excel->getCellData([0], [0]));
				return $this->json(['count'=>$excel->getRowData([$i])]);
				$data[] = $excel->getRowData([$i]);
				/*$GM = new GroupEmail;
		    	$GM->setGroup_id($group->getId());
		    	$GM->setEmail($excel->getCellData([1], ['A']));
		    	$GM->setCreated_by(1);
		    	$em->persist($GM);
		    	$em->flush();*/
			}
		}	    

    	return $this->json(array('status' => 'success','reason' => 'Group Saved Successfully','reaponse' => 200));

    }
    
    public function homeAction()
    {
    	return $this->render('staff/index.html.twig', array(
            'profileName' => 'Admin',
        ));
    }
}