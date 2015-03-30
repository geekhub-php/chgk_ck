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
	 * @REST\QueryParam(name="name", default="")
	 * @REST\QueryParam(name="date", requirements="\d+", default="")
	 * @REST\QueryParam(name="place", default="")
	 * @REST\QueryParam(name="season", requirements="(\d+|null)", default="")
	 * @REST\QueryParam(name="isLocallyRated", requirements="(true|false)", default="")
	 * @REST\QueryParam(name="isGloballyRated", requirements="(true|false)", default="")
	 * @REST\QueryParam(name="isHome", requirements="(true|false)", default="")
	 * @REST\QueryParam(name="isComplete", requirements="(true|false)", default="")
	 * @REST\QueryParam(name="ageCategory", requirements="\d+", default="")
	 * @ApiDoc(
	 * 	description="returns games",
	 * 	statusCodes={
	 * 		200="ok"
	 * 	},
	 * 	output="array<AppBundle\Entity\Game>",
	 * 	filters={
     *      {"name"="name", "dataType"="string"},
	 * 		{"name"="date", "dataType"="integer"},
	 * 		{"name"="place", "dataType"="string"},
	 * 		{"name"="season", "dataType"="integer"},
	 * 		{"name"="isLocallyRated", "dataType"="boolean"},
	 * 		{"name"="isGloballyRated", "dataType"="boolean"},
	 * 		{"name"="isHome", "dataType"="boolean"},
	 * 		{"name"="isComplete", "dataType"="boolean"},
	 * 		{"name"="ageCategory", "dataType"="integer"}
     *  }
	 * )
	 */
    public function getGamesAction($name, $date, $place, $season, $isLocallyRated, $isGloballyRated, $isHome, $isComplete, $ageCategory)
    {
    	$criteria = [];
		if ($name) {
			$criteria['name'] = $name;
		}
		if ($date) {
			$criteria['playDate'] = $date;
		}
		if ($place) {
			$criteria['playPlace'] = $place;
		}
		if ($season) {
			$criteria['season'] = $season === 'null' ? null : $season;
		}
		if ($isLocallyRated) {
			$criteria['isLocallyRated'] = filter_var($isLocallyRated, FILTER_VALIDATE_BOOLEAN);
		}
		if ($isGloballyRated) {
			$criteria['isGloballyRated'] = filter_var($isGloballyRated, FILTER_VALIDATE_BOOLEAN);
		}
		if ($isHome) {
			$criteria['isHome'] = filter_var($isHome, FILTER_VALIDATE_BOOLEAN);
		}
		if ($isComplete) {
			$criteria['isComplete'] = filter_var($isComplete, FILTER_VALIDATE_BOOLEAN);
		}
		if ($ageCategory) {
			$criteria['ageCategory'] = $ageCategory;
		}

		return $this->getDoctrine()->getRepository('AppBundle:Game')->findBy($criteria);
    }
	
	/**
	 * @REST\View(serializerGroups={"gameFull", "short"})
	 * @REST\Get("games/{game}", requirements={
	 * 		"game" = "\d+"
	 * })
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
