<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Event;
use FOS\RestBundle\Controller\Annotations as RestAnnotations;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as REST;

class EventsController extends FOSRestController
{
	/**
	 * @RestAnnotations\View(serializerGroups={"eventFull", "short"})
	 * @REST\Get("events")
	 * @REST\QueryParam(name="title", default="")
	 * @REST\QueryParam(name="authorId", requirements="\d+", default="")
	 * @REST\QueryParam(name="date", requirements="\d+", default="")
	 * @ApiDoc(
	 * 	description="returns events",
	 * 	statusCodes={
	 * 		200="ok",
	 * 	},
	 * 	filters={
     *      {"name"="title", "dataType"="string"},
	 * 		{"name"="authorId", "dataType"="integer"},
	 * 		{"name"="date", "dataType"="integer"}
     *  },
	 * 	output="array<AppBundle\Entity\Event>"
	 * )
	 */
    public function getEventsAction($title, $authorId, $date)
    {
    	$criteria = [];
		if ($title) {
			$criteria['title'] = $title;
		}
		if ($authorId) {
			$criteria['author'] = $authorId;
		}
		if ($date) {
			$criteria['eventDate'] = $date;
		}
		
    	return $this->getDoctrine()->getRepository('AppBundle:Event')->findBy($criteria);
    }
	
	/**
	 * @RestAnnotations\View(serializerGroups={"eventFull", "short"})
	 * @ApiDoc(
	 * 	description="returns event",
	 * 	parameters={
	 * 		{"name"="event", "dataType"="integer", "required"="true", "description"="event id"},
	 * 	},
	 * 	requirements={
     *      {"name"="event","dataType"="integer","requirement"="\d+", "description"="event id"},
     *  },
	 * 	statusCodes={
	 * 		200="ok",
	 * 		404="event was not found"
	 * 	},
	 * 	output="AppBundle\Entity\Event"
	 * )
	 */
	public function getEventAction(Event $event)
    {
    	return $event;
    }
}
