<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Event;
use FOS\RestBundle\Controller\Annotations as RestAnnotations;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class EventsController extends FOSRestController
{
	/**
	 * @RestAnnotations\View(serializerGroups={"eventFull", "short"})
	 * @ApiDoc(
	 * 	description="returns events",
	 * 	statusCodes={
	 * 		200="ok",
	 * 	},
	 * 	output="AppBundle\Entity\Event"
	 * )
	 */
    public function getEventsAction()
    {
    	return $this->getDoctrine()->getRepository('AppBundle:Event')->findAll();
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
