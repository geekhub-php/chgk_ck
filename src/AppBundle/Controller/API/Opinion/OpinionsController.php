<?php

namespace AppBundle\Controller\API\Opinion;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\Opinion;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializationContext;
use AppBundle\Interfaces\Opinionable;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\HttpException;

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

        if (!$this->isOpinionUnique($opinionParent, $opinion)) {
            throw new HttpException(409, 'opinion by curret user is already created');
        }

        $opinionParent->addOpinion($opinion);

        $this->getDoctrine()->getManager()->persist($opinion);
        $this->getDoctrine()->getManager()->flush();

        $view = View::create($opinion, 201);
        $view->setSerializationContext(SerializationContext::create()->setGroups(array('opinionFull', 'short')));

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

    private function isOpinionUnique(Opinionable $opinionParent, Opinion $chekingOpinion)
    {
        return !$opinionParent->getOpinions()->filter(function ($opinion) use ($chekingOpinion) {
            return $opinion->getAuthor()->getId() == $chekingOpinion->getAuthor()->getId();
        })->first();
    }
}
