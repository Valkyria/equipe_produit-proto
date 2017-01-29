<?php

namespace ProtoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message", indexes={@ORM\Index(name="fk_user", columns={"fk_user"}), @ORM\Index(name="fk_conversation", columns={"fk_conversation"})})
 * @ORM\Entity
 */
class Message
{
    /**
     * @var string
     *
     * @ORM\Column(name="fk_user", type="string", length=250, nullable=false)
     */
    private $fkUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_conversation", type="integer", nullable=false)
     */
    private $fkConversation;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=250, nullable=false)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime", nullable=false)
     */
    private $datetime;

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
     * @return Message
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
     * Set fkConversation
     *
     * @param integer $fkConversation
     *
     * @return Message
     */
    public function setFkConversation($fkConversation)
    {
        $this->fkConversation = $fkConversation;

        return $this;
    }

    /**
     * Get fkConversation
     *
     * @return integer
     */
    public function getFkConversation()
    {
        return $this->fkConversation;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Message
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return Message
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
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
