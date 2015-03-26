<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class GameEventAdmin extends Admin
{
    protected $baseRouteName = "admin_game_event";
    protected $baseRoutePattern = "gameEvent";

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text')
            ->add('text', 'text')
            ->add('author', 'entity', array(
                'class' => 'AppBundle:User',
                'property' => 'email',
            ))
            ->add('eventDate', 'timestamp_date')
            ->add('games', 'entity', array(
                'class' => 'AppBundle:Game',
                'property' => 'name',
                'multiple' => true,
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('author', null, array(), 'entity', array('property' => 'email', 'placeholder' => 'any author'))
            ->add('eventDate', null, array(), 'timestamp_date')
            ->add('games', null, array(), 'entity', array('property' => 'name', 'placeholder' => 'any game'));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('title')
            ->add('author', null, array('associated_property' => 'email'))
            ->add('createdAt', 'date', array(
                'pattern' => 'dd.MM.yyyy'
            ))
            ->add('deletedAt', 'date', array(
                'pattern' => 'dd.MM.yyyy'
            ))
            ->add('eventDate', 'date', array(
                'pattern' => 'dd.MM.yyyy'
            ))
            ->add('games', null, array('associated_property' => 'name'));
    }
}
