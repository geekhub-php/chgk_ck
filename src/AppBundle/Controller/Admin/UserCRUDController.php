<?php

namespace AppBundle\Controller\Admin;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserCRUDController extends Controller
{
	public function makeModeratorAction()
	{
		if (!$this->admin->isGranted('MAKE_MODER')) {
			throw new AccessDeniedException();
		}
		
		$user = $this->admin->getSubject();
		if (!$user) {
            throw new NotFoundHttpException(sprintf('unable to find the user with id : %s', $id));
        }
		$userMng = $this->get('fos_user.user_manager');
		
		$user->addRole('ROLE_MODERATOR');
		$userMng->updateUser($user);
		
		$this->addFlash('sonata_flash_success', 'user '.$user->getId().' is moderator');
		
		return new RedirectResponse($this->admin->generateUrl('list'));
	}
	
	public function unmakeModeratorAction()
	{
		if (!$this->admin->isGranted('MAKE_MODER')) {
			throw new AccessDeniedException();
		}
		
		$user = $this->admin->getSubject();
		if (!$user) {
            throw new NotFoundHttpException(sprintf('unable to find the user with id : %s', $id));
        }
		$userMng = $this->get('fos_user.user_manager');

		$user->removeRole('ROLE_MODERATOR');
		$userMng->updateUser($user);
		
		$this->addFlash('sonata_flash_success', 'user '.$user->getId().' is not moderator');
		
		return new RedirectResponse($this->admin->generateUrl('list'));
	}
	
}
