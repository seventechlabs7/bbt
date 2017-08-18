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
use AppBundle\Entity\GroupAsset;
use AppBundle\Entity\GroupFeedback;
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
		if(array_key_exists('group_name',$teacher) && $teacher['group_name'] != null)
			$group->setGroup_name($teacher['group_name']);
		else
		{
			$group->setGroup_name('Group'.rand());
		}
		$group->setLeague_name($teacher['league_name']);		
		$group->setVirtual_money($teacher['virtual_money']);
		$group->setStart_date($teacher['start_date']);
		$group->setEnd_date($teacher['end_date']);
		$group->setCreated_by(1);

		$em->persist($group);
	    $em->flush();

	    $assets = $teacher['assets'];
	    foreach ($assets as $asset) 
	    {
	    	if($asset)
	    	{
	    		$GA = new GroupAsset;
	    		$GA->setGroup_id($group->getId());
	    		$GA->setAsset_id($asset);
	    		$em->persist($GA);
	    		$em->flush();
	    	}
	    }

	    $feedbacks = $teacher['feedback'];
	    foreach ($feedbacks as $feedback) 
	    {
	    	if($feedbacks)
	    	{
	    		$GF = new GroupFeedback;
	    		$GF->setGroup_id($group->getId());
	    		$GF->setFeedback_id($feedback);
	    		$em->persist($GF);
	    		$em->flush();
	    	}	    	
	    }

	    foreach ($emails as $email) 
	    {
	    	$valid = $this->CheckValidEmail($email);
	    	if(!$valid)
	    		continue;
	    	$exists = $this->CheckDupeEmail($email);
	    	
	    	if($exists)
	    		continue;
	    	$GM = new GroupEmail;
	    	$GM->setGroup_id($group->getId());
	    	$GM->setEmail($email);
	    	$GM->setCreated_by(1);
	    	$em->persist($GM);
	    	$em->flush();
	    }
			//path 			
			$absolute_path = getcwd();
			$fileCo = file_get_contents($file);
			file_put_contents('temp.xls', $fileCo);
			$reader = $this->get("arodiss.xls.reader");
			$path = $absolute_path."/temp.xls";
			$path = str_replace('/', '//', $path);
			$content = $reader->readAll($path);
			
			 foreach ($content as $c) 
	    {
	    	$valid = $this->CheckValidEmail(array_values($c)[0]);
	    	if(!$valid)
	    		continue;
	    	$exists = $this->CheckDupeEmail(array_values($c)[0]);
			//return $this->json($exists);
	    	if($exists)
	    		continue;
	    	$GM = new GroupEmail;
	    	$GM->setGroup_id($group->getId());
	    	$GM->setEmail(array_values($c)[0]);
	    	$GM->setCreated_by(1);
	    	$em->persist($GM);
	    	$em->flush();
	    	//var_dump($content)
	    	//return $this->json($content);
	    }
	    unlink($path);
	    //return $this->json(($path));
/*
			for($i=0;$i<$content;$i++)
	    {

	    	$GM = new GroupEmail;
	    	$GM->setGroup_id($group->getId());
	    	$GM->setEmail($content[$i]);
	    	$GM->setCreated_by(1);
	    	$em->persist($GM);
	    	$em->flush();
	    	//var_dump($content)
	    	return $this->json($content);
	    }*/

			//return $this->json($content);
			//$excel = $this->get('os.excel');
	    	//$excel->loadFile($path);
			//$rows = $excel->getRowCount();
			//$data = $excel->getSheetData();
				//return $this->json(['count'=>$data]);
			/*for($i=0;$i<$rows;$i++) 			
			{
				return $this->json( $excel->getCellData([0], [0]));
				return $this->json(['count'=>$excel->getRowData([$i])]);
				$data[] = $excel->getRowData([$i]);
				$GM = new GroupEmail;
		    	$GM->setGroup_id($group->getId());
		    	$GM->setEmail($excel->getCellData([1], ['A']));
		    	$GM->setCreated_by(1);
		    	$em->persist($GM);
		    	$em->flush();
			}*/	    

    	return $this->json(array('status' => 'success','reason' => 'Group Saved Successfully','reaponse' => 200));

    }
    
    public function homeAction()
    {
    	return $this->render('staff/index.html.twig', array(
            'profileName' => 'Admin',
        ));
    }

   	public function CheckDupeEmail($email)
    {
    	$em = $this->getDoctrine()->getManager();

        $RAW_QUERY = 'SELECT email FROM group_emails where group_emails.email = :email LIMIT 1;';
        
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        // Set parameters 
        $statement->bindValue('email', $email);
        $statement->execute();

       return  $result = $statement->fetchAll();

        $repository = $this->getDoctrine()->getRepository(GroupEmail::class);

       return $product = $repository->findOneByEmail('hello@hello.com');



    }
    	public function CheckValidEmail($email)
    {
    	return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}