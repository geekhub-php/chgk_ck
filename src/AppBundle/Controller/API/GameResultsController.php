<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\GameResult;
use AppBundle\Entity\Game;
use FOS\RestBundle\Controller\Annotations as REST;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GameResultsController extends FOSRestController
{
	/**
	 * @REST\View(serializerGroups={"gameResultFull", "short"})
	 * @REST\Get("games/{game}/gameResults")
	 */
    public function getGameresultsAction(Game $game)
    {
    	return $game->getGameResults();
    }
	
	/**
	 * @REST\View(serializerGroups={"gameResultFull", "short"})
	 * @REST\Get("games/{game}/gameResults/{gameResultId}")
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
