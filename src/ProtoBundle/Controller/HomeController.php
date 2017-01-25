<?php

namespace ProtoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProtoBundle:Home:index.html.twig');
    }
    public function messengerAction()
    {
    	return $this->render('ProtoBundle:Home:messenger.html.twig');
    }
}
