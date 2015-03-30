<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class CommentAdmin extends Admin
{
    protected $baseRouteName = "admin_comments";
    protected $baseRoutePattern = "comments";

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('author', 'entity', array(
                'class' => 'AppBundle:User',
                'property' => 'email',
            ))
            ->add('text', 'text');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('author', null, array(), 'entity', array('property' => 'email', 'placeholder' => 'any author'));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('author', null, array('associated_property' => 'email'))
            ->add('text', 'text');
    }
	
	protected function configureRoutes(RouteCollection $collection)
    {
        $collection
        	->remove('create')
			->remove('edit');
    }
}
