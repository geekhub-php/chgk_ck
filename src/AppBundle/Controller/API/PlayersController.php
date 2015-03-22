<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\Player;
use FOS\RestBundle\Controller\Annotations as REST;

class PlayersController extends FOSRestController
{
	/**
	 * @REST\View(serializerGroups={"playerFull", "short"})
	 */
    public function getPlayersAction()
    {
    	return $this->getDoctrine()->getRepository('AppBundle:Player')->findAll();
    }
	
	/**
	 * @REST\View(serializerGroups={"playerFull", "short"})
	 */
	public function getPlayerAction(Player $player)
    {
    	return $player;
    }
}
