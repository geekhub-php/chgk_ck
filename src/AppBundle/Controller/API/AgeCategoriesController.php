<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\AgeCategory;
use FOS\RestBundle\Controller\Annotations as REST;

class AgeCategoriesController extends FOSRestController
{
	/**
	 * @REST\View(serializerGroups={"ageCategoryFull", "short"})
	 * @REST\Get("ageCategories")
	 */
    public function getAgeCategoriesAction()
    {
    	return $this->getDoctrine()->getRepository('AppBundle:AgeCategory')->findAll();
    }
	
	/**
	 * @REST\View(serializerGroups={"ageCategoryFull", "short"})
	 * @REST\Get("ageCategories/{ageCategory}")
	 */
	public function getAgeCategoryAction(AgeCategory $ageCategory)
    {
    	return $ageCategory;
    }
}
