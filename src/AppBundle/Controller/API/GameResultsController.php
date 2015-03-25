<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\GameResult;
use AppBundle\Entity\Game;
use FOS\RestBundle\Controller\Annotations as REST;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class GameResultsController extends FOSRestController
{
	/**
	 * @REST\View(serializerGroups={"gameResultFull", "short"})
	 * @REST\Get("games/{game}/gameResults")
	 * @ApiDoc(
	 * 	description="returns game results",
	 * 	parameters={
	 * 		{"name"="game", "dataType"="integer", "required"="true", "description"="game id"},
	 * 	},
	 * 	requirements={
     *      {"name"="game","dataType"="integer","requirement"="\d+", "description"="game id"},
     *  },
	 * 	statusCodes={
	 * 		200="ok",
	 * 		404="game result was not found"
	 * 	},
	 * 	output="AppBundle\Entity\GameResult"
	 * )
	 */
    public function getGameresultsAction(Game $game)
    {
    	return $game->getGameResults();
    }
	
	/**
	 * @REST\View(serializerGroups={"gameResultFull", "short"})
	 * @REST\Get("games/{game}/gameResults/{gameResultId}")
	 * @ApiDoc(
	 * 	description="returns game result",
	 * 	parameters={
	 * 		{"name"="game", "dataType"="integer", "required"="true", "description"="game id"},
	 * 		{"name"="gameResultId", "dataType"="integer", "required"="true", "description"="game result id"},
	 * 	},
	 * 	requirements={
     *      {"name"="game","dataType"="integer","requirement"="\d+", "description"="game id"},
	 * 		{"name"="gameResultId","dataType"="integer","requirement"="\d+", "description"="game result id"},
     *  },
	 * 	statusCodes={
	 * 		200="ok",
	 * 		404="game or game result result was not found"
	 * 	},
	 * 	output="AppBundle\Entity\GameResult"
	 * )
	 */
	public function getGameresultAction(Game $game, $gameResultId)
    {
    	$gameResult = $game->getGameResult($gameResultId);
		
		if (!$gameResult) {
			throw new NotFoundHttpException();
		}
		
		return $gameResult;
    }
}
