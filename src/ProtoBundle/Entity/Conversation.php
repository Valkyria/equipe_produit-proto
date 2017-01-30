<?php

namespace ProtoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Conversation
 *
 * @ORM\Table(name="conversation")
 * @ORM\Entity
 */
class Conversation
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=250, nullable=false)
     */
    private $color;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

	
    public function newConversation($name,$color){
    	$this->name = $name;
    	$this->color = $color;
    	 
    	return $this;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Conversation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Conversation
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
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
