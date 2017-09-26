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
     * @ORM\Column(name="`teacher_id`",type="integer")
    */
    private $teacherId;

    /**
     * @ORM\Column(name="`student_id`",type="integer")
    */
    private $studentId;
    
    /**
     * @ORM\Column(name="`active`",type="integer")
    */
    private $active;

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

    public function getActive(){
        return $this->active;
    }

    public function setActive($active){
        $this->active = $active;
    }

	public function getTeacherId(){
		return $this->teacherId;
	}

	public function setTeacherId($teacherId){
		$this->teacherId = $teacherId;
	}

    public function getStudentId(){
        return $this->studentId;
    }

    public function setStudentId($studentId){
        $this->studentId = $studentId;
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


    /**
     * Set groupId
     *
     * @param integer $groupId
     *
     * @return GroupEmail
     */
    public function setGroupId($groupId)
    {
        $this->group_id = $groupId;
    
        return $this;
    }

    /**
     * Get groupId
     *
     * @return integer
     */
    public function getGroupId()
    {
        return $this->group_id;
    }

    /**
     * Set createdBy
     *
     * @param string $createdBy
     *
     * @return GroupEmail
     */
    public function setCreatedBy($createdBy)
    {
        $this->created_by = $createdBy;
    
        return $this;
    }

    /**
     * Get createdBy
     *
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Set createdAt
     *
     * @param string $createdAt
     *
     * @return GroupEmail
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
}
