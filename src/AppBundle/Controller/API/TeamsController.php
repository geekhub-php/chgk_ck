<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\Team;
use FOS\RestBundle\Controller\Annotations as REST;

class TeamsController extends FOSRestController
{
	/**
	 * @REST\View(serializerGroups={"teamFull", "short"})
	 */
    public function getTeamsAction()
    {
    	return $this->getDoctrine()->getRepository('AppBundle:Team')->findAll();
    }
	
	/**
	 * @REST\View(serializerGroups={"teamFull", "short"})
	 */
	public function getTeamAction(Team $team)
    {
    	return $team;
    }
}
