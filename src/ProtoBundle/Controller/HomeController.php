<?php

namespace ProtoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use ProtoBundle\Entity\User;

class HomeController extends Controller
{
	public function instantiate(){
	
		//$this->session = $this->container->get('session');
		$em = $this->getDoctrine()->getManager();
	
		$session = $this->container->get('session');
		$session->invalidate();
		if(!$session->isStarted()){
			$user = $em->getRepository('ProtoBundle:User')->findOneByUsername("cedric");
			$session->start();
			$session->set('mail', 'Tran@mail');
			$session->set('lastname', 'Tran');
			$session->set('name', 'Cedric');
			$session->set('psedo', 'Warlaine');
			$session->set('pass', '0000');
		}
	}
	
    public function indexAction()
    {
    	
    	$this->instantiate();
    	//var_dump($test);
    	
        return $this->render('ProtoBundle:Home:index.html.twig');
    }
    
    public function messengerAction()
    {
    	return $this->render('ProtoBundle:Home:messenger.html.twig');
    }
    
    public function user_creationAction()
    {
    	$this->instantiate();
    	$session = $this->container->get('session');
    	$em = $this->getDoctrine()->getManager();
    	$user = new User();
    	$user->newUser($session->get('mail'),$session->get('lastname'), $session->get('name'), $session->get('psedo'), $session->get('pass'));
    	$em->persist($user);
    	$em->flush();
    	return $this->render('ProtoBundle:Home:messenger.html.twig');
    }
}
