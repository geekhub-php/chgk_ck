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
	 * @REST\QueryParam(name="name", default="")
	 * @REST\QueryParam(name="rating", requirements="\d+", default="")
	 * @REST\QueryParam(name="city", default="")
	 * @REST\QueryParam(name="ageCategory", requirements="\d+", default="")
	 * @ApiDoc(
	 * 	description="returns teams",
	 * 	statusCodes={
	 * 		200="ok",
	 * 	},
	 * 	filters={
     *      {"name"="name", "dataType"="string"},
	 * 		{"name"="rating", "dataType"="integer"},
	 * 		{"name"="city", "dataType"="string"},
	 * 		{"name"="ageCategory", "dataType"="intger"}
     *  },
	 * 	output="array<AppBundle\Entity\Team>"
	 * )
	 */
    public function getTeamsAction($name, $rating, $city, $ageCategory)
    {
    	$criteria = [];
		if ($name) {
			$criteria['name'] = $name;
		}
		if ($rating) {
			$criteria['rating'] = $rating;
		}
		if ($city) {
			$criteria['city'] = $city;
		}
		if ($ageCategory) {
			$criteria['ageCategory'] = $ageCategory;
		}
		
    	return $this->getDoctrine()->getRepository('AppBundle:Team')->findBy($criteria);
    }
	
	/**
	 * @REST\View(serializerGroups={"teamFull", "short"})
	 * @REST\Get("teams/{team}", requirements={
	 * 		"team" = "\d+"
	 * })
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
