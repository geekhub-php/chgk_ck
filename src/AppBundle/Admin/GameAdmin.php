<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class GameAdmin extends Admin
{
    protected $baseRouteName = "admin_games";
    protected $baseRoutePattern = "games";

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
			->add('name', 'text')
			->add('playDate', 'integer')
			->add('playPlace', 'text')
			->add('season', 'entity', array(
				'class' => 'AppBundle:Season',
				'property' => 'name',
				'required' => false
			))
			->add('isLocallyRated', 'checkbox' , array('required' => false))
			->add('isGloballyRated', 'checkbox' , array('required' => false))
			->add('isHome', 'checkbox' , array('required' => false))
			->add('isComplete', 'checkbox', array('required' => false))
			->add('ageCategory', 'entity', array(
				'class' => 'AppBundle:AgeCategory',
				'property' => 'name'
			))
			->add('description', 'text')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
        	->add('name', null, array(), 'text')
			->add('playDate', null, array(), 'integer')
			->add('playPlace', null, array(), 'text')
			->add('season', null, array(), 'entity', array('property' => 'name', 'placeholder' => 'any season'))
			->add('isLocallyRated', null, array(), 'checkbox')
			->add('isGloballyRated', null, array(), 'checkbox')
			->add('isHome', null, array(), 'checkbox')
			->add('isComplete', null, array(), 'checkbox')
        	->add('ageCategory', null, array(), 'entity', array('property' => 'name', 'placeholder' => 'any category'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
			->addIdentifier('name', 'text')
			->add('playDate', 'text')
			->add('playPlace', 'text')
            ->add('season', null, array('associated_property' => 'name'))
			->add('isLocallyRated', 'boolean')
			->add('isGloballyRated', 'boolean')
			->add('isHome', 'boolean')
			->add('isComplete', 'boolean')
			->add('ageCategory', null, array('associated_property' => 'name'))
			->add('description', 'text')
        ;
    }
}
