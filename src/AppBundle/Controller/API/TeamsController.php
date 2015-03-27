<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\Team;
use FOS\RestBundle\Controller\Annotations as REST;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class TeamsController extends FOSRestController
{
	/**
	 * @REST\View(serializerGroups={"teamFull", "short"})
	 * @ApiDoc(
	 * 	description="returns teams",
	 * 	statusCodes={
	 * 		200="ok",
	 * 	},
	 * 	output="AppBundle\Entity\Team"
	 * )
	 */
    public function getTeamsAction()
    {
    	return $this->getDoctrine()->getRepository('AppBundle:Team')->findAll();
    }
	
	/**
	 * @REST\View(serializerGroups={"teamFull", "short"})
	 * @ApiDoc(
	 * 	description="returns team",
	 * 	parameters={
	 * 		{"name"="team", "dataType"="integer", "required"="true", "description"="team id"},
	 * 	},
	 * 	requirements={
     *      {"name"="team","dataType"="integer","requirement"="\d+", "description"="team id"},
     *  },
	 * 	statusCodes={
	 * 		200="ok",
	 * 		404="team was not found"
	 * 	},
	 * 	output="AppBundle\Entity\Team"
	 * )
	 */
	public function getTeamAction(Team $team)
    {
    	return $team;
    }
}
