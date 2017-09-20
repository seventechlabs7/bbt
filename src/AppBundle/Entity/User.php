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
 * @AttributeOverrides({
 *      @AttributeOverride(name="usernameCanonical",
 *          column=@Column(
 *              name=     "nombre",
 *              type     = "string",
 *          )
 *      ),
 *      @AttributeOverride(name="emailCanonical",
 *          column=@Column(
 *              name     = "telefono",
 *             
 *          )
 *      ),
 *      @AttributeOverride(name="enabled",
 *          column=@Column(
 *              type     = "boolean",
 * 				 name=     "activo",
 *          )
 *      ),
 *      @AttributeOverride(name="salt",
 *          column=@Column(
 *              type     = "string",
 * 				name      ="nombre_completo",
 *          )
 *      ),
 *      @AttributeOverride(name="lastLogin",
 *          column=@Column(
 *              type     = "datetime",
 * 				name = "fecha_alta",
 *          )
 *      ),
 *      @AttributeOverride(name="confirmationToken",
 *          column=@Column(
 *              type     = "string",
 *				name     = "direccion",
 *          )
 *      ),
 *      @AttributeOverride(name="passwordRequestedAt",
 *          column=@Column(
 *              type     = "datetime",
 *  			name     = "fecha_max_prueba",
 *          )
 *      ),
 *      @AttributeOverride(name="id",
 *          column=@Column(
 *              name=    "id_admin",
 *              type     = "integer",
 *          )
 *      )
 * })
 */
class User extends BaseUser
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
}