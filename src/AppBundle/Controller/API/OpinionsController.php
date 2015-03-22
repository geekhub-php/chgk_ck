<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as REST;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\Opinion;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use JMS\Serializer\SerializationContext;

class OpinionsController extends FOSRestController
{
	
	const COMMENT_OPINION = 'comment';

	const EVENT_OPINION = 'event';

	const GAME_RESULT_OPINION = 'gameResult';

	/**
	 * @REST\Get("{opType}/{opParentId}/opinions/{opId}")
	 * @REST\View(serializerGroups={"opinionFull", "short"})
	 */
	public function getOpinionAction($opType, $opParentId, $opId)
	{
		$opParent = $this->fetchOpinionParent($opParentId, $opType);
		if (!$opParent) {
			throw new NotFoundHttpException($opType.' with id '.$opParentId.' was not found');
		}
		
		$opinion = $opParent->getOpinions()->filter(function ($opinion) use ($opId) {
			return $opinion->getId() == $opId;	
		})->first();
		
		if (!$opinion) {
			throw new NotFoundHttpException('opinion with id '.$opParentId.' and type '.$opType.' and parent id '.$opParent->getId().' was not found');
		}
		
		return $opinion;
	}
	
	/**
	 * @REST\Get("{opType}/{opParentId}/opinions")
	 * @REST\View(serializerGroups={"opinionFull", "short"})
	 */
	public function getOpinionsAction($opType, $opParentId)
	{
		$opParent = $this->fetchOpinionParent($opParentId, $opType);
		if (!$opParent) {
			throw new NotFoundHttpException($opType.' with id '.$opParentId.' was not found');
		}
		
		return $opParent->getOpinions();
	}
	
	/**
	 * @REST\Post("{opType}/{opParentId}/opinions")
	 * @ParamConverter("opinion", converter="fos_rest.request_body")
	 */
	public function postOpinionAction($opType, $opParentId, Opinion $opinion)
	{
		$opParent = $this->fetchOpinionParent($opParentId, $opType);
		if (!$opParent) {
			throw new NotFoundHttpException($opType.' with id '.$opParentId.' was not found');
		}
		
		$author = $this->getDoctrine()->getRepository('AppBundle:User')->find(1);//TODO get user from session
		$opinion->setAuthor($author);
		$opParent->addOpinion($opinion);
		
		$validationErrors = $this->get('validator')->validate($opinion);
		$view = View::create($validationErrors, 400);
		if (count($validationErrors) == 0) {
			$this->getDoctrine()->getManager()->persist($opinion);
			$this->getDoctrine()->getManager()->flush();
			
			$view->setStatusCode(201);
			$view->setData($opinion);
			$view->setHeader('Location', $this->generateUrl('get_opinion', array(
				'opType' => $opType,
				'opParentId' => $opParent->getId(),
				'opId' => $opinion->getId()
			)));
			$view->setSerializationContext(SerializationContext::create()->setGroups(array('opinionFull', 'short')));
		}
		
		return $view;
	}
	
	/**
	 * @REST\Delete("{opType}/{opParentId}/opinions/{opId}")
	 * @REST\View(statusCode=204)
	 */
	public function deleteOpinionAction($opType, $opParentId, $opId)
	{
		$opParent = $this->fetchOpinionParent($opParentId, $opType);
		
		if (!$opParent) {
			return;
		}
		
		$opinion = $opParent->getOpinions()->filter(function ($opinion) use ($opId) {
			return $opinion->getId() == $opId;	
		})->first();
		
		if (!$opinion) {
			return;
		}
		
		$this->getDoctrine()->getManager()->remove($opinion);
		$this->getDoctrine()->getManager()->flush();
	}
	
	private function fetchOpinionParent($id, $opType)
	{
		switch ($opType) {
			case self::COMMENT_OPINION:
				return $this->getDoctrine()->getRepository('AppBundle:Comment')->find($id);
			case self::EVENT_OPINION:
				return $this->getDoctrine()->getRepository('AppBundle:Event')->find($id);
			case self::GAME_RESULT_OPINION:
				return $this->getDoctrine()->getRepository('AppBundle:GameResult')->find($id);
			default:
				throw new \Exception('opinion type '.$opType.' is not acceptable');
		}
	}
}
