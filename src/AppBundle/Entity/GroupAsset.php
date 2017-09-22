<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="group_assets")
 */
class GroupAsset
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
     * @ORM\Column(name="`league_id`",type="integer")
     */
    private $leagueId;

    /**
     * @ORM\Column(name="`asset_id`",type="integer")
     */
    private $asset_id;

    


    public function getId()
    {
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

	public function getAsset_id(){
		return $this->asset_id;
	}

	public function setAsset_id($asset_id){
		$this->asset_id = $asset_id;
	}

	public function getLeagueId(){
		return $this->league_id;
	}

	public function setLeagueId($leagueId){
		$this->leagueId = $leagueId;
	}


}