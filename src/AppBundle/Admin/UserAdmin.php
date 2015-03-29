<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class UserAdmin extends Admin
{
    protected $baseRouteName = "admin_users";
    protected $baseRoutePattern = "users";

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            //->add('roles', 'tags')
            ->add('assignedPlayer', 'entity', array(
                'class' => 'AppBundle:Player',
                'property' => 'lastName',
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            //->add('roles', null, array(), 'tags')
            ->add('assignedPlayer', null, array(), 'entity', array('property' => 'lastName', 'placeholder' => 'any player'));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            //->add('roles', 'array')
            ->add('assignedPlayer', null, array('associated_property' => 'lastName'));
			if ($this->isGranted('MAKE_MODER')) {
				$listMapper->add('_action', 'actions', array(
		            'actions' => array(
		                'make moder' => array(
		                	'template' => 'AppBundle:Sonata\Admin:makeModeratorTemplate.html.twig'
		            	),
		            	'unmake moder' => array(
		                	'template' => 'AppBundle:Sonata\Admin:unmakeModeratorTemplate.html.twig'
		            	)
		        	)
	        	));
        	}
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
        	->remove('create')
			->add('makeModerator', $this->getRouterIdParameter().'/makeModerator')
			->add('unmakeModerator', $this->getRouterIdParameter().'/unmakeModerator');
    }
}
