<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="group_feedback")
 */
class GroupFeedback
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
     * @ORM\Column(name="`feedback_id`",type="integer")
     */
    private $feedback_id;

    


    public function getId()
    {
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}	

	public function getGroup_id()
	{
		return $this->group_id;
	}

	public function setGroup_id($group_id){
		$this->group_id = $group_id;
	}

	public function getFeedback_id(){
		return $this->feedback_id;
	}

	public function setFeedback_id($feedback_id){
		$this->feedback_id = $feedback_id;
	}


    /**
     * Set groupId
     *
     * @param integer $groupId
     *
     * @return GroupFeedback
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
     * Set feedbackId
     *
     * @param integer $feedbackId
     *
     * @return GroupFeedback
     */
    public function setFeedbackId($feedbackId)
    {
        $this->feedback_id = $feedbackId;
    
        return $this;
    }

    /**
     * Get feedbackId
     *
     * @return integer
     */
    public function getFeedbackId()
    {
        return $this->feedback_id;
    }
}
