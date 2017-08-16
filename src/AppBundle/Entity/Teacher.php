<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="teachers")
 */
class Teacher
{

	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="`username`",type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(name="`surname`",type="string", length=100)
     */
    private $surname;

    /**
     * @ORM\Column(name="`email`",type="text")
     */
    private $email;

    /**
     * @ORM\Column(name="`password`",type="text")
     */
    private $password;

    /**
     * @ORM\Column(name="`university`",type="text")
     */
    private $university;

    /**
     * @ORM\Column(name="`created_by`",type="text")
     */
    private $created_by;


    	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getSurname(){
		return $this->surname;
	}

	public function setSurname($surname){
		$this->surname = $surname;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function getUniversity(){
		return $this->university;
	}

	public function setUniversity($university){
		$this->university = $university;
	}

	public function getCreated_by(){
		return $this->created_by;
	}

	public function setCreated_by($created_by){
		$this->created_by = $created_by;
	}
}