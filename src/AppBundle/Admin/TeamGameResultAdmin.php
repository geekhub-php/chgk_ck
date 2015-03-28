<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TeamGameResultAdmin extends Admin
{
    protected $baseRouteName = "admin_team_game_result";
    protected $baseRoutePattern = "teamGameResults";

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
       		->add('game', 'entity', array(
                'class' => 'AppBundle:Game',
                'property' => 'name'
            ))
			->add('place', 'integer')
			->add('score', 'integer')
			->add('team', 'entity', array(
				'class' => 'AppBundle:Team',
				'property' => 'name'
			))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
        	->add('game', null, array(), 'entity', array('property' => 'name', 'placeholder' => 'any game'))
			->add('score', null, array(), 'integer')
			->add('place', null, array(), 'integer')
            ->add('team', null, array(), 'entity', array('property' => 'name', 'placeholder' => 'any team'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
			->add('game', null, array('associated_property' => 'name'))
			->add('place', 'integer')
			->add('score', 'integer')
            ->add('team', null, array('associated_property' => 'name'))
        ;
    }
}
