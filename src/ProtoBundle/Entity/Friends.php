<?php

namespace ProtoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Friends
 *
 * @ORM\Table(name="friends", indexes={@ORM\Index(name="fk_friend", columns={"fk_friend"}), @ORM\Index(name="fk_user", columns={"fk_user"})})
 * @ORM\Entity
 */
class Friends
{
    /**
     * @var string
     *
     * @ORM\Column(name="fk_user", type="string", length=250, nullable=false)
     */
    private $fkUser;

    /**
     * @var string
     *
     * @ORM\Column(name="fk_friend", type="string", length=250, nullable=false)
     */
    private $fkFriend;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set fkUser
     *
     * @param string $fkUser
     *
     * @return Friends
     */
    public function setFkUser($fkUser)
    {
        $this->fkUser = $fkUser;

        return $this;
    }

    /**
     * Get fkUser
     *
     * @return string
     */
    public function getFkUser()
    {
        return $this->fkUser;
    }

    /**
     * Set fkFriend
     *
     * @param string $fkFriend
     *
     * @return Friends
     */
    public function setFkFriend($fkFriend)
    {
        $this->fkFriend = $fkFriend;

        return $this;
    }

    /**
     * Get fkFriend
     *
     * @return string
     */
    public function getFkFriend()
    {
        return $this->fkFriend;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
