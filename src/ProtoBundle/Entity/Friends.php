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


    public function newFriends($user1, $user2)
    {
    	$this->fkUser = $user1;
    	$this->FkFriend = $user2;
    	
    	return $this;
    }
    
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
    
    //return a list of friends'ids (string)
    public function getFriendsList($em, $user) {
    	$friends = array();
    	$qb = $em->getRepository('ProtoBundle:Friends')->createQueryBuilder('cm');
    	$qb
    	->select('cm')
    	->where($qb->expr()->orX(
    			$qb->expr()->eq('cm.fkUser', ':fkUser'),
    			$qb->expr()->eq('cm.fkFriend', ':fkFriend')
    			))
    			->setParameter('fkUser', $user)
    			->setParameter('fkFriend', $user)
    			;
    	$friends_array = $qb->getQuery()->getResult();
    	
    	foreach($friends_array as $friend){
    		$user1=$friend->getFkUser();
    		$user2=$friend->getFkFriend();
    		if($user1 != $user){
    			 $friends[]=$user1;
    		}
    		if($user2 != $user){
    			$friends[]=$user2;
    		}
    	}
    	return $friends;
    }
}
