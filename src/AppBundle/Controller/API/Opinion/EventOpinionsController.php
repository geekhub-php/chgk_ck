<?php

namespace AppBundle\Controller\API\Opinion;

use FOS\RestBundle\Controller\Annotations as REST;
use AppBundle\Entity\Opinion;
use AppBundle\Entity\Event;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class EventOpinionsController extends OpinionsController
{
	/**
	 * @REST\View(serializerGroups={"opinionFull", "short"})
	 * @REST\Get("events/{event}/opinions/{opinionId}", requirements={
	 * 		"opinionId" = "\d+",
	 * 		"event" = "\d+"
	 * })
	 * @ApiDoc(
	 * 	description="returns events opinion",
	 * 	parameters={
	 * 		{"name"="event", "dataType"="integer", "required"="true", "description"="event id"},
	 * 		{"name"="opinionId", "dataType"="integer", "required"="true", "description"="opinion id"}
	 * 	},
	 * 	requirements={
     *      {"name"="event","dataType"="integer","requirement"="\d+", "description"="event id"},
	 * 		{"name"="opinionId","dataType"="integer","requirement"="\d+", "description"="opinion id"}
     *  },
	 * 	statusCodes={
	 * 		200="ok",
	 * 		404="opinion or event was not found"
	 * 	},
	 * 	output="AppBundle\Entity\Opinion"
	 * )
	 */
	public function getOpinionAction(Event $event, $opinionId)
	{
		return parent::handleGetOpinion($event, $opinionId);;
	}
	
	/**
	 * @REST\View(serializerGroups={"opinionFull", "short"})
	 * @REST\Get("events/{event}/opinions", requirements={
	 * 		"event" = "\d+"
	 * })
	 * @ApiDoc(
	 * 	description="returns events opinions",
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
	 * 	output="array<AppBundle\Entity\Opinion>"
	 * )
	 */
	public function getOpinionsAction(Event $event)
	{
		return parent::handleGetOpinions($event);
	}
	
	/**
	 * @ParamConverter("opinion", converter="fos_rest.request_body")
	 * @REST\Post("events/{event}/opinions", requirements={
	 * 		"event" = "\d+"
	 * })
	 * @ApiDoc(
	 * 	description="creates new event opinion",
	 * 	parameters={
	 * 		{"name"="event", "dataType"="integer", "required"="true", "description"="event id"},
	 * 	},
	 * 	requirements={
     *      {"name"="event","dataType"="integer","requirement"="\d+", "description"="event id"},
     *  },
	 * 	statusCodes={
	 * 		201="ok",
	 * 		409="opinion by curret user is already created",
	 * 		403="access denied"
	 * 	},
	 * 	output="AppBundle\Entity\Opinion",
	 * 	input="AppBundle\Entity\Opinion"
	 * )
	 */
	public function postOpinionAction(Event $event, Opinion $opinion)
	{
		return parent::handlePostOpinion($event, $opinion);
	}
	
	/**
	 * @REST\View(statusCode=204)
	 * @REST\Delete("events/{event}/opinions/{opinionId}", requirements={
	 * 		"opinionId" = "\d+",
	 * 		"event" = "\d+"
	 * })
	 * @ApiDoc(
	 * 	description="deletes event opinion",
	 * 	parameters={
	 * 		{"name"="event", "dataType"="integer", "required"="true", "description"="event id"},
	 * 		{"name"="opinionId", "dataType"="integer", "required"="true", "description"="opinion id"}
	 * 	},
	 * 	requirements={
     *      {"name"="event","dataType"="integer","requirement"="\d+", "description"="event id"},
	 * 		{"name"="opinionId","dataType"="integer","requirement"="\d+", "description"="opinion id"}
     *  },
	 * 	statusCodes={
	 * 		204="deleted",
	 * 		404="event was not found",
	 * 		403="access denied"
	 * 	}
	 * )
	 */
	public function deleteOpinionAction(Event $event, $opinionId)
	{
		parent::handleDeleteOpinion($event, $opinionId);
	}
	
}
