<?php

namespace Labor\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * Labor\BackendBundle\Entity\Users
 *
 * @ORM\Table(name="users")
* @ORM\Entity()
 */
class Users implements UserInterface, \Serializable
{
    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=16, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=16, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=16, nullable=false)
     */
    private $username;


    /**
     * @var string
     *
     * @ORM\Column(name="profil_image", type="string", length=160, nullable=false)
     */
    private $profilImage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="date", nullable=false)
     */
    private $createDate;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=444, nullable=false)
     */
    private $password;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=128, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="blob", length=16, nullable=false)
     */
    private $salt;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

   /**
     * @inheritDoc
     */
    public function getcreateDate()
    {
        return $this->create_date;
    }

   /**
     * @inheritDoc
     */
    public function getLastname()
    {
        return $this->lastname;
    }

   /**
     * @inheritDoc
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
            // see section on salt below
            $this->salt,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            // see section on salt below
            $this->salt
        ) = unserialize($serialized);
    }


}
