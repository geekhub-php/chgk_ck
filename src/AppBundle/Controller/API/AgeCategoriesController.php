<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\AgeCategory;
use FOS\RestBundle\Controller\Annotations as REST;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class AgeCategoriesController extends FOSRestController
{
	/**
	 * @REST\View(serializerGroups={"ageCategoryFull", "short"})
	 * @REST\Get("ageCategories")
	 * @ApiDoc(
	 * 	description="returns age categories",
	 * 	statusCodes={
	 * 		200="ok"
	 * 	},
	 * 	output="array<AppBundle\Entity\AgeCategory>"
	 * )
	 */
    public function getAgeCategoriesAction()
    {
    	return $this->getDoctrine()->getRepository('AppBundle:AgeCategory')->findAll();
    }
	
	/**
	 * @REST\View(serializerGroups={"ageCategoryFull", "short"})
	 * @REST\Get("ageCategories/{ageCategory}")
	 * @ApiDoc(
	 * 	description="returns age category",
	 * 	parameters={
	 * 		{"name"="ageCategory", "dataType"="integer", "required"="true", "description"="age category id"},
	 * 	},
	 * 	requirements={
     *      {"name"="ageCategory","dataType"="integer","requirement"="\d+", "description"="age category id"},
     *  },
	 * 	statusCodes={
	 * 		200="ok",
	 * 		404="age category not found"
	 * 	},
	 * 	output="AppBundle\Entity\AgeCategory"
	 * )
	 */
	public function getAgeCategoryAction(AgeCategory $ageCategory)
    {
    	return $ageCategory;
    }
}
