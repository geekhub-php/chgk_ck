<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\TeamRole;
use FOS\RestBundle\Controller\Annotations as REST;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class TeamRolesController extends FOSRestController
{
    /**
     * @REST\View(serializerGroups={"teamRoleFull", "short"})
     * @REST\Get("teamRoles")
     * @ApiDoc(
     * 	description="returns team roles",
     * 	statusCodes={
     * 		200="ok",
     * 	},
     * 	output="array<AppBundle\Entity\TeamRole>"
     * )
     */
    public function getTeamRolesAction()
    {
        return $this->getDoctrine()->getRepository('AppBundle:TeamRole')->findAll();
    }

    /**
     * @REST\View(serializerGroups={"teamRoleFull", "short"})
     * @REST\Get("teamRoles/{teamRole}", requirements={
     * 		"teamRole" = "\d+"
     * })
     * @ApiDoc(
     * 	description="returns team role",
     * 	parameters={
     * 		{"name"="teamRole", "dataType"="integer", "required"="true", "description"="team role id"},
     * 	},
     * 	requirements={
     *      {"name"="teamRole","dataType"="integer","requirement"="\d+", "description"="team role id"},
     *  },
     * 	statusCodes={
     * 		200="ok",
     * 		404="team role was not found"
     * 	},
     * 	output="AppBundle\Entity\TeamRole"
     * )
     */
    public function getTeamRoleAction(TeamRole $teamRole)
    {
        return $teamRole;
    }
}
