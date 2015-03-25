<?php

namespace AppBundle\Controller\API\Opinion;

use FOS\RestBundle\Controller\Annotations as REST;
use AppBundle\Entity\Opinion;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Event;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentOpinionsController extends OpinionsController
{
	/**
	 * @REST\View(serializerGroups={"opinionFull", "short"})
	 * @REST\Get("events/{event}/comments/{commentId}/opinions/{opinionId}")
	 */
	public function getOpinionAction(Event $event, $commentId, $opinionId)
	{
		$comment = $this->getComment($event, $commentId);
		
		return parent::handleGetOpinion($comment, $opinionId);;
	}
	
	/**
	 * @REST\View(serializerGroups={"opinionFull", "short"})
	 * @REST\Get("events/{event}/comments/{commentId}/opinions")
	 */
	public function getOpinionsAction(Event $event, $commentId)
	{
		$comment = $this->getComment($event, $commentId);
		
		return parent::handleGetOpinions($comment);
	}
	
	/**
	 * @ParamConverter("opinion", converter="fos_rest.request_body")
	 * @REST\Post("events/{event}/comments/{commentId}/opinions")
	 */
	public function postOpinionAction(Event $event, $commentId, Opinion $opinion)
	{
		$comment = $this->getComment($event, $commentId);
		
		return parent::handlePostOpinion($comment, $opinion);
	}
	
	/**
	 * @REST\View(statusCode=204)
	 * @REST\Delete("events/{event}/comments/{commentId}/opinions/{opinionId}")
	 */
	public function deleteOpinionAction(Event $event, $commentId, $opinionId)
	{
		$comment = $this->getComment($event, $commentId);
		
		return parent::handleDeleteOpinion($comment, $opinionId);
	}
	
	private function getComment(Event $event, $commentId)
	{
		$comment = $event->getComment($commentId);
		
		if (!$comment) {
			throw new NotFoundHttpException();
		}
		
		return $comment;
	}
	
}
