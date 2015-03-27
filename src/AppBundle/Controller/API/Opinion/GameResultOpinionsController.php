<?php

namespace AppBundle\Controller\API\Opinion;

use FOS\RestBundle\Controller\Annotations as REST;
use AppBundle\Entity\Opinion;
use AppBundle\Entity\Game;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class GameResultOpinionsController extends OpinionsController
{
	/**
	 * @REST\View(serializerGroups={"opinionFull", "short"})
	 * @REST\Get("games/{game}/gameResults/{gameResultId}/opinions/{opinionId}")
	 * @ApiDoc(
	 * 	description="returns game results opinion",
	 * 	parameters={
	 * 		{"name"="game", "dataType"="integer", "required"="true", "description"="game id"},
	 * 		{"name"="gameResultId", "dataType"="integer", "required"="true", "description"="game result id"},
	 * 		{"name"="opinionId", "dataType"="integer", "required"="true", "description"="opinion id"}
	 * 	},
	 * 	requirements={
     *      {"name"="game","dataType"="integer","requirement"="\d+", "description"="game id"},
	 * 		{"name"="gameResultId","dataType"="integer","requirement"="\d+", "description"="game result id"},
	 * 		{"name"="opinionId","dataType"="integer","requirement"="\d+", "description"="opinion id"}
     *  },
	 * 	statusCodes={
	 * 		200="ok",
	 * 		404="opinion or game or game result was not found"
	 * 	},
	 * 	output="AppBundle\Entity\Opinion"
	 * )
	 */
	public function getOpinionAction(Game $game, $gameResultId, $opinionId)
	{
		$gameResult = $this->getGameResult($game, $gameResultId);
		
		return parent::handleGetOpinion($gameResult, $opinionId);
	}
	
	/**
	 * @REST\View(serializerGroups={"opinionFull", "short"})
	 * @REST\Get("games/{game}/gameResults/{gameResultId}/opinions")
	 * @ApiDoc(
	 * 	description="returns game results opinions",
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
	 * 		404="game or game result was not found"
	 * 	},
	 * 	output="AppBundle\Entity\Opinion"
	 * )
	 */
	public function getOpinionsAction(Game $game, $gameResultId)
	{
		$gameResult = $this->getGameResult($game, $gameResultId);
		
		return parent::handleGetOpinions($gameResult);
	}
	
	/**
	 * @ParamConverter("opinion", converter="fos_rest.request_body")
	 * @REST\Post("games/{game}/gameResults/{gameResultId}/opinions")
	 * @ApiDoc(
	 * 	description="creates new game results opinion",
	 * 	parameters={
	 * 		{"name"="game", "dataType"="integer", "required"="true", "description"="game id"},
	 * 		{"name"="gameResultId", "dataType"="integer", "required"="true", "description"="game result id"},
	 * 	},
	 * 	requirements={
     *      {"name"="game","dataType"="integer","requirement"="\d+", "description"="game id"},
	 * 		{"name"="gameResultId","dataType"="integer","requirement"="\d+", "description"="game result id"},
     *  },
	 * 	statusCodes={
	 * 		201="created",
	 * 		400="opinion is already created"
	 * 	},
	 * 	output="AppBundle\Entity\Opinion",
	 * 	input="AppBundle\Entity\Opinion"
	 * )
	 */
	public function postOpinionAction(Game $game, $gameResultId, Opinion $opinion)
	{
		$gameResult = $this->getGameResult($game, $gameResultId);
		
		return parent::handlePostOpinion($gameResult, $opinion);
	}
	
	/**
	 * @REST\View(statusCode=204)
	 * @REST\Delete("games/{game}/gameResults/{gameResultId}/opinions/{opinionId}")
	 * @ApiDoc(
	 * 	description="deletes game results opinion",
	 * 	parameters={
	 * 		{"name"="game", "dataType"="integer", "required"="true", "description"="game id"},
	 * 		{"name"="gameResultId", "dataType"="integer", "required"="true", "description"="game result id"},
	 * 		{"name"="opinionId", "dataType"="integer", "required"="true", "description"="opinion id"}
	 * 	},
	 * 	requirements={
     *      {"name"="game","dataType"="integer","requirement"="\d+", "description"="game id"},
	 * 		{"name"="gameResultId","dataType"="integer","requirement"="\d+", "description"="game result id"},
	 * 		{"name"="opinionId","dataType"="integer","requirement"="\d+", "description"="opinion id"}
     *  },
	 * 	statusCodes={
	 * 		204="deleted",
	 * 		404="game or game result was not found"
	 * 	}
	 * )
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
