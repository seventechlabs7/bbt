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
	}

    public function saveTeacherAction(Request $request)
    {    	    	
		$teacher = $request->request->get('teacher');		
		$file = $request->files->get('file');
			    		    	    	  
		
		$em = $this->getDoctrine()->getManager();		
		$emails_list = $teacher['mail_list'];
		$emails = explode(',', $emails_list);		

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