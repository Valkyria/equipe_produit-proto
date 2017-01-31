<?php

namespace ProtoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use ProtoBundle\Entity\User;
use ProtoBundle\Entity\Conversation;
use ProtoBundle\Entity\Message;
use ProtoBundle\Entity\Friends;
use \DateTime;

class HomeController extends Controller
{
	public function instantiate(){
	
		$this->em = $this->getDoctrine()->getManager();
		$this->user = new User();
		$this->conversation = new Conversation();
		$this->message = new Message();
		$this->friends = new Friends();
		$this->session = $this->container->get('session');
		//$this->session->invalidate();
		
		if(!$this->session->isStarted() || !$this->session->get('mail')){
			$user = $this->em->getRepository('ProtoBundle:User')->findOneByUsername("cedric");
			$this->session->start();
			$this->session->set('mail', $user->getId());
			$this->session->set('lastname', $user->getUserfamilyname());
			$this->session->set('name', $user->getUsername());
			$this->session->set('psedo', $user->getDisplayname());
			$this->session->set('avatar', $user->getAvatar());
		}
	}
	
    public function indexAction()
    {
    	
    	$this->instantiate();
    	
    	//$conversations_array = array();
    	$conversations = array();
    	$friends = array();
    	$messages_get = $this->em->getRepository('ProtoBundle:Message')->findByFkUser($this->session->get('mail'));
    	
    	foreach ($messages_get as $message){
    		if(!isset($conversations_array[$message->getfkConversation()])){
    			$conversation = $this->em->getRepository('ProtoBundle:Conversation')->findOneById($message->getfkConversation());
    			$conversations_array[$message->getfkConversation()]['id']=$conversation->getId();
    			$conversations_array[$message->getfkConversation()]['title']=$conversation->getName();
    			$conversations_array[$message->getfkConversation()]['color']=$conversation->getColor();
    		}
    	}
    	foreach ($conversations_array as $key=>$conversation){
    		$messages_get = $this->em->getRepository('ProtoBundle:Message')->findByfkConversation($key);
    		$date = new Datetime('1800-01-01 00:00:00');
    		foreach ($messages_get as $message){
    			$date_msg = $message->getDatetime();
    			if($date_msg > $date){
    				$date = $date_msg;
    				$user = $this->em->getRepository('ProtoBundle:User')->findOneById($message->getFkUser());
    				$conversations[$key]['conv_id']= $conversation['id'];
    				$conversations[$key]['conv_link']= $conversation['id'];
    				$conversations[$key]['conv_title']= $conversation['title'];
    				$conversations[$key]['conv_color']= $conversation['color'];
    				$conversations[$key]['sender_name']= $user->getDisplayname();
    				$conversations[$key]['sender_avatar']= $user->getAvatar();
    				$conversations[$key]['msg_content']= $message->getContent();
    				$conversations[$key]['msg_date']= $message->getDatetime()->format('d-m-Y H:i:s');
    			}
    		}
    	}
    	
    	$friends_array = $this->friends->getFriendsList($this->em, $this->session->get('mail'));
    	foreach ($friends_array as $friend_id){
    		$friend = $this->em->getRepository('ProtoBundle:User')->findOneById($friend_id);
    		$friends[$friend_id]['friend_link']=$friend->getId();
    		$friends[$friend_id]['friend_mail']=$friend->getId();
    		$friends[$friend_id]['friend_username']=$friend->getUsername();
    		$friends[$friend_id]['friend_firstname']=$friend->getUserfamilyname();
    		$friends[$friend_id]['friend_psedo']=$friend->getDisplayname();
    		$friends[$friend_id]['friend_avatar']=$friend->getAvatar();
    	}
		//print_r($friends);
    	
        return $this->render('ProtoBundle:Home:index.html.twig',
    				array('conversations'=> $conversations, 'friends' => $friends)
    			);
    }
    
    public function messengerAction($conv_id = 1)
    {
    	
    	return $this->render('ProtoBundle:Home:chat_test.html.twig',
    			array('conversations'=> $conv_id)
    			);
    }
    
    public function user_creationAction()
    {
    	$this->instantiate();
    	
    	$mail = "";
    	$lastname ="";
    	$name = "";
    	$psedo = "";
    	$password="";
    	
    	$this->user->newUser($mail,$lastname, $name, $psedo, $password);
    	$this->em->persist($this->user);
    	$metadata = $this->em->getClassMetaData(get_class($this->user));
    	$metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
    	$metadata->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());
    	$this->em->flush();
    	return $this->render('ProtoBundle:Home:messenger.html.twig');
    }
}
