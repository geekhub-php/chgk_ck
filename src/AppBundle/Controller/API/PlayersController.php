<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\Player;
use FOS\RestBundle\Controller\Annotations as REST;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class PlayersController extends FOSRestController
{
	/**
	 * @REST\View(serializerGroups={"playerFull", "short"})
	 * @REST\QueryParam(name="lastName", default="")
	 * @REST\QueryParam(name="dob", requirements="\d+", default="")
	 * @ApiDoc(
	 * 	description="returns players",
	 * 	statusCodes={
	 * 		200="ok",
	 * 	},
	 * 	filters={
     *      {"name"="lastName", "dataType"="string"},
	 * 		{"name"="dob", "dataType"="integer"}
     *  },
	 * 	output="AppBundle\Entity\Player"
	 * )
	 */
    public function getPlayersAction($lastName, $dob)
    {
    	$criteria = [];
    	if ($lastName) {
    		$criteria['lastName'] = $lastName;
    	}
		if ($dob) {
			$criteria['dob'] = $dob;
		}
		
    	return $this->getDoctrine()->getRepository('AppBundle:Player')->findBy($criteria);
    }
	
	/**
	 * @REST\View(serializerGroups={"playerFull", "short"})
	 * @ApiDoc(
	 * 	description="returns player",
	 * 	parameters={
	 * 		{"name"="player", "dataType"="integer", "required"="true", "description"="player id"},
	 * 	},
	 * 	requirements={
     *      {"name"="player","dataType"="integer","requirement"="\d+", "description"="player id"},
     *  },
	 * 	statusCodes={
	 * 		200="ok",
	 * 		404="player was not found"
	 * 	},
	 * 	output="AppBundle\Entity\Player"
	 * )
	 */
	public function getPlayerAction(Player $player)
    {
    	return $player;
    }
}
