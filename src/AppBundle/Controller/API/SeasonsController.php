<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\Season;
use FOS\RestBundle\Controller\Annotations as REST;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class SeasonsController extends FOSRestController
{
	/**
	 * @REST\View(serializerGroups={"seasonFull", "short"})
	 * @REST\QueryParam(name="startDate", requirements="\d+", default="")
	 * @REST\QueryParam(name="endDate", requirements="\d+", default="")
	 * @REST\QueryParam(name="name", default="")
	 * @ApiDoc(
	 * 	description="returns seasons",
	 * 	statusCodes={
	 * 		200="ok",
	 * 	},
	 * 	filters={
     *      {"name"="startDate", "dataType"="integer"},
	 * 		{"name"="endDate", "dataType"="integer"},
	 * 		{"name"="name", "dataType"="string"}
     *  },
	 * 	output="AppBundle\Entity\Season"
	 * )
	 */
    public function getSeasonsAction($startDate, $endDate, $name)
    {
    	$criteria = [];
		if ($startDate) {
			$criteria['startDate'] = $startDate;
		}
		if ($endDate) {
			$criteria['endDate'] = $endDate;
		}
		if ($name) {
			$criteria['name'] = $name;
		}
		
    	return $this->getDoctrine()->getRepository('AppBundle:Season')->findBy($criteria);
    }
	
	/**
	 * @REST\View(serializerGroups={"seasonFull", "short"})
	 * @ApiDoc(
	 * 	description="returns season",
	 * 	parameters={
	 * 		{"name"="season", "dataType"="integer", "required"="true", "description"="season id"},
	 * 	},
	 * 	requirements={
     *      {"name"="season","dataType"="integer","requirement"="\d+", "description"="season id"},
     *  },
	 * 	statusCodes={
	 * 		200="ok",
	 * 		404="season was not found"
	 * 	},
	 * 	output="AppBundle\Entity\Season"
	 * )
	 */
	public function getSeasonAction(Season $season)
    {
    	return $season;
    }
}
