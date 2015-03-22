<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\TeamRole;
use FOS\RestBundle\Controller\Annotations as REST;

class TeamRolesController extends FOSRestController
{
	/**
	 * @REST\View(serializerGroups={"teamRoleFull", "short"})
	 * @REST\Get("teamRoles")
	 */
    public function getTeamRolesAction()
    {
    	return $this->getDoctrine()->getRepository('AppBundle:TeamRole')->findAll();
    }
	
	/**
	 * @REST\View(serializerGroups={"teamRoleFull", "short"})
	 * @REST\Get("teamRoles/{teamRole}")
	 */
	public function getTeamRoleAction(TeamRole $teamRole)
    {
    	return $teamRole;
    }
}
