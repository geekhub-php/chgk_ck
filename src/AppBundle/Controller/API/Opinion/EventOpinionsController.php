<?php

namespace AppBundle\Controller\API\Opinion;

use FOS\RestBundle\Controller\Annotations as REST;
use AppBundle\Entity\Opinion;
use AppBundle\Entity\Event;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class EventOpinionsController extends OpinionsController
{
	/**
	 * @REST\View(serializerGroups={"opinionFull", "short"})
	 * @REST\Get("events/{event}/opinions/{opinionId}")
	 */
	public function getOpinionAction(Event $event, $opinionId)
	{
		return parent::handleGetOpinion($event, $opinionId);;
	}
	
	/**
	 * @REST\View(serializerGroups={"opinionFull", "short"})
	 * @REST\Get("events/{event}/opinions")
	 */
	public function getOpinionsAction(Event $event)
	{
		return parent::handleGetOpinions($event);
	}
	
	/**
	 * @ParamConverter("opinion", converter="fos_rest.request_body")
	 * @REST\Post("events/{event}/opinions")
	 */
	public function postOpinionAction(Event $event, Opinion $opinion)
	{
		return parent::handlePostOpinion($event, $opinion);
	}
	
	/**
	 * @REST\View(statusCode=204)
	 * @REST\Delete("events/{event}/opinions/{opinionId}")
	 */
	public function deleteOpinionAction(Event $event, $opinionId)
	{
		parent::handleDeleteOpinion($event, $opinionId);
	}
	
}
