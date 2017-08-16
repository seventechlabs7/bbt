<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="group_emails")
 */
class GroupEmail
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="`group_id`",type="integer")
     */
    private $group_id;

    /**
     * @ORM\Column(name="`email`",type="text")
     */
    private $email;

    /**
     * @ORM\Column(name="`created_by`")
     */
    private $created_by;    

    /**
     * @ORM\Column(name="`created_at`")
     */
    private $created_at;


    	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getGroup_id(){
		return $this->group_id;
	}

	public function setGroup_id($group_id){
		$this->group_id = $group_id;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getCreated_by(){
		return $this->created_by;
	}

	public function setCreated_by($created_by){
		$this->created_by = $created_by;
	}

	public function getCreated_at(){
		return $this->created_at;
	}

	public function setCreated_at($created_at){
		$this->created_at = $created_at;
	}

}