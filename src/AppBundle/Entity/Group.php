<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="groups")
 */
class Group
{

	 /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="`teacher_id`",type="integer")
     */
    private $teacher_id;

    /**
     * @ORM\Column(name="`group_name`",type="string", length=100)
     */
    private $group_name;

    /**
     * @ORM\Column(name="`created_by`")
     */
    private $created_by;    

    /**
     * @ORM\Column(name="`created_at`",type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(name="`updated_by`",type="integer")
     */
    private $updated_by;

    /**
     * @ORM\Column(name="`updated_at`",type="datetime")
     */
    private $updated_at;


        public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getTeacher_id(){
        return $this->teacher_id;
    }

    public function setTeacher_id($teacher_id){
        $this->teacher_id = $teacher_id;
    }

    public function getGroup_name(){
        return $this->group_name;
    }

    public function setGroup_name($group_name){
        $this->group_name = $group_name;
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

    public function setCreated_at(\DateTime $created_at){
        $this->created_at = $created_at;
    }

    public function getUpdated_by(){
        return $this->updated_by;
    }

    public function setUpdated_by($updated_by){
        $this->updated_by = $updated_by;
    }

    public function getUpdated_at(){
        return $this->updated_at;
    }

    public function setUpdated_at(\DateTime $updated_at){
        $this->updated_at = $updated_at;
    }
}