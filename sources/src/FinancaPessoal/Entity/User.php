<?php

namespace FinancaPessoal\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;
use Zend\Math\Rand;
use Zend\Crypt\Key\Derivation\Pbkdf2;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class User
{

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue
     * @var int 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @var string 
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @var string 
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string 
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     * @var string 
     */
    private $avatar;

    /**
     *
     * @var string 
     */
    private $salt;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * 
     * @param string $password
     * @return \FinancaPessoal\Entity\User
     */
    public function setPassword($password)
    {
        $this->password = base64_encode(Pbkdf2::calc('sha256', $password, $this->salt, 10000, strlen($password * 2)));

        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * 
     * @return array
     */
    public function toArray()
    {
        $hydrator = new Hydrator\ClassMethods();
        return $hydrator->extract($this);
    }

    public function __construct($data = array())
    {
        $this->salt = base64_encode(Rand::getBytes(8, true));

        $hydrator = new Hydrator\ClassMethods();
        $hydrator->hydrate($data, $this);
    }

}
