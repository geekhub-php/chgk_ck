<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\Annotations as REST;
use FOS\RestBundle\Controller\FOSRestController;
use Application\Sonata\MediaBundle\Entity\Gallery;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class MediasController extends FOSRestController
{
    /**
     * @REST\Get("gallerys/{gallery}/medias", requirements={
     * 		"gallery" = "\d+"
     * })
     * @ApiDoc(
     * 	description="returns medias",
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
    public function getMediasAction(Gallery $gallery)
    {
        $query = $this->getDoctrine()->getManager()->createQuery('SELECT m
			FROM Application\Sonata\MediaBundle\Entity\GalleryHasMedia ghm
			JOIN Application\Sonata\MediaBundle\Entity\Media m WITH m.id = ghm.media
			WHERE ghm.gallery = :galleryId
			ORDER BY m.createdAt ASC
		');
        $query->setParameter('galleryId', $gallery->getId());

        return $query->getResult();
    }
}
