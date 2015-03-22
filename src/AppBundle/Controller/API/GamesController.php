<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\Game;
use FOS\RestBundle\Controller\Annotations as REST;

class GamesController extends FOSRestController
{
	/**
	 * @REST\View(serializerGroups={"gameFull", "short"})
	 */
    public function getGamesAction()
    {
    	return $this->getDoctrine()->getRepository('AppBundle:Game')->findAll();
    }
	
	/**
	 * @REST\View(serializerGroups={"gameFull", "short"})
	 */
	public function getGameAction(Game $game)
    {
    	return $game;
    }
}
