<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ligas")
 */
class League
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="`nom_liga`",type="string" ,length=60)
     */
    private $leagueName;

    /**
     * @ORM\Column(name="`fecha_inicio`",type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(name="`fecha_fin`",type="datetime")
     */
    private $endDate;


    /**
     * @ORM\Column(name="`activo`",type="integer")
     */
    private $active;

    /**
     * @ORM\Column(name="`reseteada`",type="integer")
    */
    private $reset;
    


    public function getId()
    {
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}	

	public function getLeagueName(){
		return $this->leagueName;
	}

	public function setLeagueName($leagueName){
		$this->leagueName = $leagueName;
	}

	public function getActive(){
		return $this->active;
	}

	public function setActive($active){
		$this->active = $active;
	}

	public function getReset(){
		return $this->reset;
	}

	public function setReset($reset){
		$this->reset = $reset;
	}

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate ;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     */
    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate ;
    }


}