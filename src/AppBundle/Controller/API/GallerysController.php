<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\Annotations as REST;
use FOS\RestBundle\Controller\FOSRestController;
use Application\Sonata\MediaBundle\Entity\Gallery;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class GallerysController extends FOSRestController
{
    /**
     * @REST\Get("gallerys")
     * @ApiDoc(
     * 	description="returns Galleries",
     * 	statusCodes={
     * 		200="ok",
     * 	},
     * 	output="array<Application\Sonata\MediaBundle\Entity\Gallery>"
     * )
     */
    public function getGallerysAction()
    {
        return $this->getDoctrine()->getRepository('Application\Sonata\MediaBundle\Entity\Gallery')->findAll();
    }

    /**
     * @REST\Get("gallerys/{gallery}", requirements={
     * 		"gallery" = "\d+"
     * })
     * @ApiDoc(
     * 	description="returns gallery",
     * 	parameters={
     * 		{"name"="gallery", "dataType"="integer", "required"="true", "description"="gallery id"},
     * 	},
     * 	requirements={
     *      {"name"="gallery","dataType"="integer","requirement"="\d+", "description"="gallery id"},
     *  },
     * 	statusCodes={
     * 		200="ok",
     * 		404="gallery was not found"
     * 	}
     * )
     */
    public function getGalleryAction(Gallery $gallery)
    {
        return $gallery;
    }
}
