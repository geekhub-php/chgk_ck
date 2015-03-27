<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\MembershipType;
use FOS\RestBundle\Controller\Annotations as REST;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class MembershipTypesController extends FOSRestController
{
	/**
	 * @REST\View(serializerGroups={"membershipTypesFull", "short"})
	 * @REST\Get("membershipTypes")
	 * @ApiDoc(
	 * 	description="returns membership types",
	 * 	statusCodes={
	 * 		200="ok",
	 * 	},
	 * 	output="AppBundle\Entity\MembershipType"
	 * )
	 */
    public function getMembershipTypesAction()
    {
    	return $this->getDoctrine()->getRepository('AppBundle:MembershipType')->findAll();
    }
	
	/**
	 * @REST\View(serializerGroups={"membershipTypesFull", "short"})
	 * @REST\Get("membershipTypes/{membershipType}")
	 * @ApiDoc(
	 * 	description="returns membership type",
	 * 	parameters={
	 * 		{"name"="membershipType", "dataType"="integer", "required"="true", "description"="membership type id"},
	 * 	},
	 * 	requirements={
     *      {"name"="membershipType","dataType"="integer","requirement"="\d+", "description"="membership type id"},
     *  },
	 * 	statusCodes={
	 * 		200="ok",
	 * 		404="membership type was not found"
	 * 	},
	 * 	output="AppBundle\Entity\MembershipType"
	 * )
	 */
	public function getMembershipTypeAction(MembershipType $membershipType)
    {
    	return $membershipType;
    }
}
