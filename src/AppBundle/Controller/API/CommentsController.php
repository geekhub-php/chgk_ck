<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as REST;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Event;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializationContext;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class CommentsController extends FOSRestController
{
	/**
	 * @ParamConverter("comment", class="AppBundle:Comment")
	 * @REST\View(serializerGroups={"commentFull", "short"})
	 * @REST\Get("comments/{comment}") 
	 * @ApiDoc(
	 * 	description="returns commnent",
	 * 	parameters={
	 * 		{"name"="comment", "dataType"="integer", "required"="true", "description"="comment id"}
	 * 	},
	 * 	requirements={
     *      {"name"="comment","dataType"="integer","requirement"="\d+", "description"="comment id"}
     *  },
	 * 	statusCodes={
	 * 		200="ok",
	 * 		404="comment was not found"
	 * 	},
	 * 	output="AppBundle\Entity\Comment"
	 * )
	 */
	public function getCommentAction(Comment $comment)
	{
		return $comment;
	}
	
	/**
	 * @ParamConverter("event", class="AppBundle:Event")
	 * @REST\View(serializerGroups={"commentFull", "short"})
	 * @ApiDoc(
	 * 	description="returns events commnents",
	 * 	parameters={
	 * 		{"name"="event", "dataType"="integer", "required"="true", "description"="event id"}
	 * 	},
	 * 	requirements={
     *      {"name"="event","dataType"="integer","requirement"="\d+", "description"="event id"}
     *  },
	 * 	statusCodes={
	 * 		200="ok",
	 * 		404="event was not found"
	 * 	},
	 * 	output="AppBundle\Entity\Comment"
	 * )
	 */
	public function getCommentsAction(Event $event)
	{
		return $event->getComments();
	}
	
	/**
	 * @REST\Post("events/{event}/comments")
	 * @ParamConverter("event", class="AppBundle:Event")
	 * @ParamConverter("comment", converter="fos_rest.request_body")
	 * @ApiDoc(
	 * 	description="creates new commnent",
	 * 	parameters={
	 * 		{"name"="event", "dataType"="integer", "required"="true", "description"="event id"}
	 * 	},
	 * 	requirements={
     *      {"name"="event","dataType"="integer","requirement"="\d+", "description"="event id"}
     *  },
	 * 	statusCodes={
	 * 		201="created",
	 * 		404="event was not found",
	 * 		400="comment is not valid"
	 * 	},
	 * 	output="AppBundle\Entity\Comment",
	 * 	input="AppBundle\Entity\Comment"
	 * )
	 */
	public function postCommentAction(Event $event, Comment $comment)
	{
		$author = $this->getDoctrine()->getRepository('AppBundle:User')->find(1);//TODO get user from session
		$comment->setAuthor($author);
		$comment->setCreatedAt(time());
		
		$validationErrors = $this->get('validator')->validate($comment);
		$view = View::create($validationErrors, 400);
		if (count($validationErrors) == 0) {
			$event->addComment($comment);
			$this->getDoctrine()->getManager()->persist($comment);
			$this->getDoctrine()->getManager()->flush();
			
			$view->setStatusCode(201);
			$view->setData($comment);
			$view->setHeader('Location', $this->generateUrl('get_event_comment', array(
				'eventId' => 0,
				'comment' => $comment->getId()
			)));
			$view->setSerializationContext(SerializationContext::create()->setGroups(array('commentFull', 'short')));
		}
		
		return $view;
	}
	
	/**
	 * @REST\Delete("comments/{commentId}")
	 * @REST\View(statusCode=204)
	 * @ApiDoc(
	 * 	description="deletes commnent",
	 * 	parameters={
	 * 		{"name"="commentId", "dataType"="integer", "required"="true", "description"="comment id"}
	 * 	},
	 * 	requirements={
     *      {"name"="commentId","dataType"="integer","requirement"="\d+", "description"="comment id"}
     *  },
	 * 	statusCodes={
	 * 		204="deleted"
	 * 	}
	 * )
	 */
	public function deleteCommentAction($commentId)
	{
		$comment = $this->getDoctrine()->getRepository('AppBundle:Comment')->find($commentId);
		if ($comment) {
			$this->getDoctrine()->getManager()->remove($comment);
			$this->getDoctrine()->getManager()->flush();
		}
	}
	
	/**
	 * @REST\Put("comments/{commentId}")
	 * @ParamConverter("comment", converter="fos_rest.request_body")
	 * @ApiDoc(
	 * 	description="updates commnent",
	 * 	parameters={
	 * 		{"name"="commentId", "dataType"="integer", "required"="true", "description"="comment id"}
	 * 	},
	 * 	requirements={
     *      {"name"="commentId","dataType"="integer","requirement"="\d+", "description"="comment id"}
     *  },
	 * 	statusCodes={
	 * 		201="updated",
	 * 		400="comment is not valid"
	 * 	},
	 * 	output="AppBundle\Entity\Comment",
	 * 	input="AppBundle\Entity\Comment"
	 * )
	 */
	public function putCommentAction(Comment $comment, $commentId)
	{
		$comment->setId($commentId);
		$comment->setCreatedAt(time());
		$author = $this->getDoctrine()->getRepository('AppBundle:User')->find(1);//TODO get user from session
		$comment->setAuthor($author);
		$comment = $this->getDoctrine()->getManager()->merge($comment);
		
		$validationErrors = $this->get('validator')->validate($comment);
		$view = View::create($validationErrors, 400);
		if (count($validationErrors) == 0) {
			$this->getDoctrine()->getManager()->flush();
			
			$view->setStatusCode(201);
			$view->setData($comment);
			$view->setSerializationContext(SerializationContext::create()->setGroups(array('commentFull', 'short')));
		}
		
		return $view;
	}
}