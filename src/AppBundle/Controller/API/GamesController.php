<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\Game;
use FOS\RestBundle\Controller\Annotations as REST;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class GamesController extends FOSRestController
{
	/**
	 * @REST\View(serializerGroups={"gameFull", "short"})
	 * @ApiDoc(
	 * 	description="returns games",
	 * 	statusCodes={
	 * 		200="ok"
	 * 	},
	 * 	output="AppBundle\Entity\Game"
	 * )
	 */
    public function getGamesAction()
    {
    	return $this->getDoctrine()->getRepository('AppBundle:Game')->findAll();
    }
	
	/**
	 * @REST\View(serializerGroups={"gameFull", "short"})
	 * @ApiDoc(
	 * 	description="returns game",
	 * 	parameters={
	 * 		{"name"="game", "dataType"="integer", "required"="true", "description"="game id"},
	 * 	},
	 * 	requirements={
     *      {"name"="game","dataType"="integer","requirement"="\d+", "description"="game id"},
     *  },
	 * 	statusCodes={
	 * 		200="ok",
	 * 		404="game was not found"
	 * 	},
	 * 	output="AppBundle\Entity\Game"
	 * )
	 */
	public function getGameAction(Game $game)
    {
    	return $game;
    }
}
