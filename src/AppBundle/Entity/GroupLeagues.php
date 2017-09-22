<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="group_leagues")
 */
class GroupLeagues
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
    private $groupId;

    /**
     * @ORM\Column(name="`league_id`",type="integer")
     */
    private $leagueId;

     /**
     * @ORM\Column(name="`virtual_money`",type="string")
     */
    private $virtualMoney;
    


    public function getId()
    {
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}	

		public function getGroupId(){
		return $this->groupId;
	}

	public function setGroupId($groupId){
		$this->groupId = $groupId;
	}

	public function getLeagueId(){
		return $this->asset_id;
	}

	public function setLeagueId($leagueId){
		$this->leagueId = $leagueId;
	}

	public function getVirtualMoney(){
		return $this->virtualMoney;
	}

	public function setVirtualMoney($virtualMoney){
		$this->virtualMoney = $virtualMoney;
	}

}