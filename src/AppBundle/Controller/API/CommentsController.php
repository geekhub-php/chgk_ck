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

class CommentsController extends FOSRestController
{
	/**
	 * @ParamConverter("comment", class="AppBundle:Comment")
	 * @REST\View(serializerGroups={"commentFull", "short"})
	 * @REST\Get("comments/{comment}") 
	 */
	public function getCommentAction(Comment $comment)
	{
		return $comment;
	}
	
	/**
	 * @ParamConverter("event", class="AppBundle:Event")
	 * @REST\View(serializerGroups={"commentFull", "short"})
	 */
	public function getCommentsAction(Event $event)
	{
		return $event->getComments();
	}
	
	/**
	 * @REST\Post("events/{event}/comments")
	 * @ParamConverter("event", class="AppBundle:Event")
	 * @ParamConverter("comment", converter="fos_rest.request_body")
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
