<?php
 
// src/UserBundle/Entity/User.php
 
namespace AppBundle\Entity;
 
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\AttributeOverride;
use Doctrine\ORM\Mapping\AttributeOverrides;
use Doctrine\ORM\Mapping\Column;
 
/**
 * User.
 *
 * @ORM\Table("users")
 * @ORM\Entity
 */
class User 
{
    const ROLE_ADMIN = 'ROLE_ADMIN';
 
    /**
     * @var int
     *
     * @ORM\Column(name="id_admin", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    private $email;
}