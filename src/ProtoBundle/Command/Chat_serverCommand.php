<?php

//php bin/console sockets:start-chat

namespace ProtoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
// Ratchet libs
use Ratchet\App;
// Chat instance
use ProtoBundle\Sockets\Chat_listener;
class Chat_serverCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this->setName('sockets:start-chat')
		->setHelp("Starts the chat socket demo")
		->setDescription('Starts the chat socket demo')
		;
	}
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln([
				'Chat socket',
				'============',
		]);
		
		$app = new App('127.0.0.1', 8080,'0.0.0.0');
		
		$this->em = $this->getContainer()->get('doctrine')->getManager();
		
		$conversations = $this->em->getRepository('ProtoBundle:Conversation')->findAll();
		foreach($conversations as $conversation){
			$app->route('/'.$conversation->getId(), new Chat_listener);
			$output->writeln(['adding: "/'.$conversation->getId().'" to routes',]);
		}
		$output->writeln([
				'============',
				'Starting chat, open your browser.',
		]);
		$app->run();
		
	}
}