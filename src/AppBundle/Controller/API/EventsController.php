<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\Event;
use FOS\RestBundle\Controller\Annotations as RestAnnotations;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as REST;

class EventsController extends FOSRestController
{
    /**
     * @RestAnnotations\View(serializerGroups={"eventFull", "opinionFull", "userFull", "short"})
     * @REST\Get("events")
     * @REST\QueryParam(name="title", default="")
     * @REST\QueryParam(name="authorId", requirements="\d+", default="")
     * @REST\QueryParam(name="date", requirements="\d+", default="")
     * @REST\QueryParam(name="maxCount", requirements="\d+", default="")
     * @REST\QueryParam(name="offset", requirements="\d+", default="")
     * @ApiDoc(
     * 	description="returns events",
     * 	statusCodes={
     * 		200="ok",
     * 	},
     * 	filters={
     *      {"name"="title", "dataType"="string"},
     * 		{"name"="authorId", "dataType"="integer"},
     * 		{"name"="date", "dataType"="integer"},
     * 		{"name"="maxCount", "dataType"="integer"},
     * 		{"name"="offset", "dataType"="integer"}
     *  },
     * 	output="array<AppBundle\Entity\Event>"
     * )
     */
    public function getEventsAction($title, $authorId, $date, $maxCount, $offset)
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

        $query = $this->getDoctrine()->getManager()->createQuery('SELECT e FROM AppBundle:Event e ORDER BY e.eventDate ASC');

        if ($maxCount !== '' && $offset !== '') {
            $query->setFirstResult($offset);
            $query->setMaxResults($maxCount);
        }

        $events = $query->execute();

        foreach ($events as $event) {
            $this->get('user_creatable_marker')->mark($event->getOpinions()->toArray());
        }

        return $events;
    }

    /**
     * @RestAnnotations\View(serializerGroups={"eventFull", "opinionFull", "userFull", "short"})
     * @REST\Get("events/{event}", requirements={
     * 		"event" = "\d+"
     * })
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
        $this->get('user_creatable_marker')->mark($event->getOpinions()->toArray());

        return $event;
    }
}
