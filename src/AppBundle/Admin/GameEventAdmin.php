<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class GameEventAdmin extends EventAdmin
{
    protected $baseRouteName = "admin_game_event";
    protected $baseRoutePattern = "gameEvent";

    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);
        $formMapper->add('games', 'entity', array(
            'class' => 'AppBundle:Game',
            'property' => 'name',
            'multiple' => true,
        ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        parent::configureDatagridFilters($datagridMapper);
        $datagridMapper->add('games', null, array(), 'entity', array(
            'property' => 'name',
            'placeholder' => 'any game',
        ));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        parent::configureListFields($listMapper);
        $listMapper->add('games', null, array('associated_property' => 'name'));
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        $query->select('ge')
            ->from('AppBundle:GameEvent', 'ge')
            ->where('ge INSTANCE OF AppBundle:GameEvent');

        return $query;
    }
}
