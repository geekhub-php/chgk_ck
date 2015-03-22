<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\Season;
use FOS\RestBundle\Controller\Annotations as REST;

class SeasonsController extends FOSRestController
{
	/**
	 * @REST\View(serializerGroups={"seasonFull", "short"})
	 */
    public function getSeasonsAction()
    {
    	return $this->getDoctrine()->getRepository('AppBundle:Season')->findAll();
    }
	
	/**
	 * @REST\View(serializerGroups={"seasonFull", "short"})
	 */
	public function getSeasonAction(Season $season)
    {
    	return $season;
    }
}
