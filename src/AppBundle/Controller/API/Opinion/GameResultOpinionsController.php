<?php

namespace AppBundle\Controller\API\Opinion;

use FOS\RestBundle\Controller\Annotations as REST;
use AppBundle\Entity\Opinion;
use AppBundle\Entity\Game;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GameResultOpinionsController extends OpinionsController
{
	/**
	 * @REST\View(serializerGroups={"opinionFull", "short"})
	 * @REST\Get("games/{game}/gameResults/{gameResultId}/opinions/{opinionId}")
	 */
	public function getOpinionAction(Game $game, $gameResultId, $opinionId)
	{
		$gameResult = $this->getGameResult($game, $gameResultId);
		
		return parent::handleGetOpinion($gameResult, $opinionId);
	}
	
	/**
	 * @REST\View(serializerGroups={"opinionFull", "short"})
	 * @REST\Get("games/{game}/gameResults/{gameResultId}/opinions")
	 */
	public function getOpinionsAction(Game $game, $gameResultId)
	{
		$gameResult = $this->getGameResult($game, $gameResultId);
		
		return parent::handleGetOpinions($gameResult);
	}
	
	/**
	 * @ParamConverter("opinion", converter="fos_rest.request_body")
	 * @REST\Post("games/{game}/gameResults/{gameResultId}/opinions")
	 */
	public function postOpinionAction(Game $game, $gameResultId, Opinion $opinion)
	{
		$gameResult = $this->getGameResult($game, $gameResultId);
		
		return parent::handlePostOpinion($gameResult, $opinion);
	}
	
	/**
	 * @REST\View(statusCode=204)
	 * @REST\Delete("games/{game}/gameResults/{gameResultId}/opinions/{opinionId}")
	 */
	public function deleteOpinionAction(Game $game, $gameResultId, $opinionId)
	{
		$gameResult = $this->getGameResult($game, $gameResultId);
		
		parent::handleDeleteOpinion($gameResult, $opinionId);
	}
	
	private function getGameResult(Game $game, $gameResultId)
	{
		$gameResult = $game->getGameResult($gameResultId);
		
		if (!$gameResult) {
			throw new NotFoundHttpException();
		}
		
		return $gameResult;
	}
	
}
