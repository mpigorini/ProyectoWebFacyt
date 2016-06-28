<?php
use Doctrine\ORM\Mapping as ORM;

namespace application\models\entities;
/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class Users {
    
     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
 
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $login;
    
     /**
     * @ORM\Column(type="string", length=100)
     */
    protected $password;
     /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;
    
     /**
     * @ORM\Column(type="string", length=100)
     */
    protected $lastname;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $type;
    
}