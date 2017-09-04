<?php
namespace AppBundle\Entity;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements /*UserInterface*/
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $email;
    // needed by the security system
    public function getUsername()
    {
        return $this->email;
    }
    public function getRoles()
    {
        return ['ROLE_USER'];
    }
    public function getPassword()
    {
        // leaving blank - I don't need/have a password!
    }
    public function getSalt()
    {
        // leaving blank - I don't need/have a password!
    }
    public function eraseCredentials()
    {
        // leaving blank - I don't need/have a password!
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
}