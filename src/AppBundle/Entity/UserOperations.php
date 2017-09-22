<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserOperationsRepository")
 * @ORM\Table(name="hist_user_compra")
 */
class UserOperations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="integer")
     */
    private $id_liga;
     /**
     * @ORM\Column(type="integer")
     */
    private $id_user;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $id_empresa;
    /**
     * @ORM\Column(type="string")
     */
    private $prec_apertura_compra ;
     /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_apertura_compra;
     /**
     * @ORM\Column(type="string")
     */
    private $volumen ;
     /**
     * @ORM\Column(type="string")
     */
    private $volumen_ya_vendido ;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
     public function getIdLiga()
    {
        return $this->id_liga;
    }
    public function setIdLiga($id_liga)
    {
        $this->idLiga = $id_liga;
    }
     public function getIdUser()
    {
        return $this->idUser;
    }
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }
     public function getIdEmpressa()
    {
        return $this->id_empresa;
    }
    public function setIdEmpressa($name)
    {
        $this->id_empresa = $id_empresa;
    }
     public function getprec_apertura_compra()
    {
        return $this->prec_apertura_compra;
    }
    public function setprec_apertura_compra($prec_apertura_compra)
    {
        $this->prec_apertura_compra = $prec_apertura_compra;
    }
      public function getvolumen()
    {
        return $this->volumen;
    }
    public function setvolumen($volumen)
    {
        $this->volumen = $volumen;
    }
      public function getvolumen_ya_vendido()
    {
        return $this->volumen_ya_vendido;
    }
    public function setvolumen_ya_vendido($volumen_ya_vendido)
    {
        $this->volumen_ya_vendido = $volumen_ya_vendido;
    }

}