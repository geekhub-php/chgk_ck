<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PlayerGameResultAdmin extends Admin
{
    protected $baseRouteName = "admin_player_game_result";
    protected $baseRoutePattern = "playerGameResults";

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('game', 'entity', array(
                'class' => 'AppBundle:Game',
                'property' => 'name'
            ))
            ->add('place', 'integer')
            ->add('score', 'integer')
            ->add('player', 'entity', array(
                'class' => 'AppBundle:Player',
                'property' => 'slug'
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('game', null, array(), 'entity', array('property' => 'name', 'placeholder' => 'any game'))
            ->add('score', null, array(), 'integer')
            ->add('place', null, array(), 'integer')
            ->add('player', null, array(), 'entity', array('property' => 'slug', 'placeholder' => 'any player'));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('game', null, array('associated_property' => 'name'))
            ->add('place', 'integer')
            ->add('score', 'integer')
            ->add('player', null, array('associated_property' => 'slug'));
    }
}
