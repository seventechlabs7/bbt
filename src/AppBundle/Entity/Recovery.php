<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="recovery")
 */
class Recovery
{

	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="`user_id`",type="integer",)
     */
    private $userId;
     /**
     * @ORM\Column(name="`otp`",type="string", length=255)
     */
    private $otp;
	 /**
	 * @ORM\Column(name="`created_at`",type="datetime",)
	 */
    private $createdAt;




   	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getUserId(){
		return $this->userId;
	}

	public function setUserId($userId){
		$this->userId = $userId;
	}

	public function getOtp(){
		return $this->otp;
	}

	public function setOtp($otp){
		$this->otp = $otp;
	}

	public function getCreatedAt(){
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt){
        $this->createdAt = $createdAt;
    }
}