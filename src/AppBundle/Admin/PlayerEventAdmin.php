<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PlayerEventAdmin extends EventAdmin
{
    protected $baseRouteName = "admin_player_event";
    protected $baseRoutePattern = "playerEvent";

    protected function configureFormFields(FormMapper $formMapper)
    {
    	parent::configureFormFields($formMapper);
        $formMapper->add('players', 'entity', array(
            'class' => 'AppBundle:Player',
            'property' => 'slug',
            'multiple' => true,
        ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    	parent::configureDatagridFilters($datagridMapper);
        $datagridMapper->add('players', null, array(), 'entity', array(
        	'property' => 'slug',
        	'placeholder' => 'any player'
		));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
    	parent::configureListFields($listMapper);
        $listMapper->add('players', null, array('associated_property' => 'slug'));
    }
	
	public function createQuery($context = 'list')
	{
	    $query = parent::createQuery($context);
				
		$query->select('pe')->from('AppBundle:PlayerEvent', 'pe');
			
		return $query;
	}
}
