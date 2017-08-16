<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="`teacher_id`",type="number")
     */
    private $teacher_id;

    /**
     * @ORM\Column(name="`group_name`",type="string", length=100)
     */
    private $group_name;

    /**
     * @ORM\Column(name="`league_name`",type="string", length=100)
     */
    private $league_name;

    /**
     * @ORM\Column(name="`feedback`",type="text", length=100)
     */
    private $feedback;

    /**
     * @ORM\Column(name="`assets`",type="text", length=100)
     */
    private $assets;
    
    /**
     * @ORM\Column(name="`virtual_money`",type="number")
     */
    private $virtual_money;

    /**
     * @ORM\Column(name="`start_date`",type="date")
     */
    private $start_date;

    /**
     * @ORM\Column(name="`end_date`",type="date")
     */
    private $end_date;

    /**
     * @ORM\Column(name="`created_by`")
     */
    private $created_by;    

    /**
     * @ORM\Column(name="`created_at`")
     */
    private $created_at;

    /**
     * @ORM\Column(name="`updated_by`",type="number")
     */
    private $updated_by;

    /**
     * @ORM\Column(name="`updated_at`")
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

    public function getLeague_name(){
        return $this->league_name;
    }

    public function setLeague_name($league_name){
        $this->league_name = $league_name;
    }

    public function getFeedback(){
        return $this->feedback;
    }

    public function setFeedback($feedback){
        $this->feedback = $feedback;
    }

    public function getAssets(){
        return $this->assets;
    }

    public function setAssets($assets){
        $this->assets = $assets;
    }

    public function getVirtual_money(){
        return $this->virtual_money;
    }

    public function setVirtual_money($virtual_money){
        $this->virtual_money = $virtual_money;
    }

    public function getStart_date(){
        return $this->start_date;
    }

    public function setStart_date($start_date){
        $this->start_date = $start_date;
    }

    public function getEnd_date(){
        return $this->end_date;
    }

    public function setEnd_date($end_date){
        $this->end_date = $end_date;
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

    public function getUpdated_by(){
        return $this->updated_by;
    }

    public function setUpdated_by($updated_by){
        $this->updated_by = $updated_by;
    }

    public function getUpdated_at(){
        return $this->updated_at;
    }

    public function setUpdated_at($updated_at){
        $this->updated_at = $updated_at;
    }    

}