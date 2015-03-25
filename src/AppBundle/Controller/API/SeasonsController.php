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
	 * @ApiDoc(
	 * 	description="returns seasons",
	 * 	statusCodes={
	 * 		200="ok",
	 * 	},
	 * 	output="AppBundle\Entity\Season"
	 * )
	 */
    public function getSeasonsAction()
    {
    	return $this->getDoctrine()->getRepository('AppBundle:Season')->findAll();
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
