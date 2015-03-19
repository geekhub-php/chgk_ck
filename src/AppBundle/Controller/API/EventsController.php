<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Event;
use FOS\RestBundle\Controller\Annotations as RestAnnotations;

class EventsController extends FOSRestController
{
	/**
	 * @RestAnnotations\View(serializerGroups={"eventFull", "short"})
	 */
    public function getEventsAction()
    {
    	return $this->getDoctrine()->getRepository('AppBundle:Event')->findAll();
    }
	
	/**
	 * @RestAnnotations\View(serializerGroups={"eventFull", "short"})
	 */
	public function getEventAction(Event $event)
    {
    	return $event;
    }
}
