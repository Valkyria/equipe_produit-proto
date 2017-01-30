<?php

namespace ProtoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
{
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=250, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="displayname", type="string", length=250, nullable=false)
     */
    private $displayname;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=250, nullable=false)
     */
    private $avatar;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=250, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="userfamilyname", type="string", length=250, nullable=false)
     */
    private $userfamilyname;

    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=250)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    public function newUser($mail, $nom, $prenom, $psedo, $pass){
    	$this->id = $mail;
    	$this->userfamilyname = $nom;
    	$this->username = $prenom;
    	$this->displayname = $psedo;
    	$this->password = $pass;
    	
    	return $this;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set displayname
     *
     * @param string $displayname
     *
     * @return User
     */
    public function setDisplayname($displayname)
    {
        $this->displayname = $displayname;

        return $this;
    }

    /**
     * Get displayname
     *
     * @return string
     */
    public function getDisplayname()
    {
        return $this->displayname;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set userfamilyname
     *
     * @param string $userfamilyname
     *
     * @return User
     */
    public function setUserfamilyname($userfamilyname)
    {
        $this->userfamilyname = $userfamilyname;

        return $this;
    }

    /**
     * Get userfamilyname
     *
     * @return string
     */
    public function getUserfamilyname()
    {
        return $this->userfamilyname;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}
