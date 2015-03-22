<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\MembershipType;
use FOS\RestBundle\Controller\Annotations as REST;

class MembershipTypesController extends FOSRestController
{
	/**
	 * @REST\View(serializerGroups={"membershipTypesFull", "short"})
	 * @REST\Get("membershipTypes")
	 */
    public function getMembershipTypesAction()
    {
    	return $this->getDoctrine()->getRepository('AppBundle:MembershipType')->findAll();
    }
	
	/**
	 * @REST\View(serializerGroups={"membershipTypesFull", "short"})
	 * @REST\Get("membershipTypes/{membershipType}")
	 */
	public function getMembershipTypeAction(MembershipType $membershipType)
    {
    	return $membershipType;
    }
}
