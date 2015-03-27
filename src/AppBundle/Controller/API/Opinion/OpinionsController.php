<?php

namespace AppBundle\Controller\API\Opinion;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as REST;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\Opinion;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use JMS\Serializer\SerializationContext;
use AppBundle\Interfaces\Opinionable;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class OpinionsController extends FOSRestController
{
	
	protected function handleGetOpinion(Opinionable $opinionParent, $opinionId)
	{
		$opinion = $opinionParent->getOpinion($opinionId);
		
		if (!$opinion) {
			throw new NotFoundHttpException();
		}
		
		return $opinion;
	}
	
	protected function handleGetOpinions(Opinionable $opinionsParent)
	{
		return $opinionsParent->getOpinions();
	}
	
	protected function handlePostOpinion(Opinionable $opinionParent, Opinion $opinion)
	{
		if (!$this->get('security.authorization_checker')->isGranted('add', $opinion)) {
			throw new AccessDeniedException();
		}
		
		$author = $this->get('security.token_storage')->getToken()->getUser();
		$opinion->setAuthor($author);
		
		$validationErrors = $this->get('validator')->validate($opinion);
		$view = View::create($validationErrors, 400);
		if (count($validationErrors) == 0) {
			$opinionParent->addOpinion($opinion);
			$this->getDoctrine()->getManager()->persist($opinion);
			$this->getDoctrine()->getManager()->flush();
			
			$view->setStatusCode(201);
			$view->setData($opinion);
			$view->setSerializationContext(SerializationContext::create()->setGroups(array('opinionFull', 'short')));
		}
		
		return $view;
	}
	
	protected function handleDeleteOpinion(Opinionable $opinionParent, $opinionId)
	{
		$opinion = $opinionParent->getOpinion($opinionId);
		
		if (!$opinion) {
			return;
		}
		
		if (!$this->get('security.authorization_checker')->isGranted('delete', $opinion)) {
			throw new AccessDeniedException();
		}
			
		$this->getDoctrine()->getManager()->remove($opinion);
		$this->getDoctrine()->getManager()->flush();
	}
	
}
