<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\GameResult;
use FOS\RestBundle\Controller\Annotations as REST;

class GameResultsController extends FOSRestController
{
	/**
	 * @REST\View(serializerGroups={"gameResultFull", "short"})
	 * @REST\Get("gameResults")
	 */
    public function getGameResultsAction()
    {
    	return $this->getDoctrine()->getRepository('AppBundle:GameResult')->findAll();
    }
	
	/**
	 * @REST\View(serializerGroups={"gameResult", "short"})
	 * @REST\Get("gameResults/{gameResult}")
	 */
	public function getGameResultAction(GameResult $gameResult)
    {
    	return $gameResult;
    }
}
