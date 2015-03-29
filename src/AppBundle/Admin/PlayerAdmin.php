<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\Entity\Player;

class PlayerAdmin extends Admin

{
    protected $baseRouteName = "admin_players";
    protected $baseRoutePattern = "players";

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('firstName', 'text')
            ->add('middleName', 'text')
            ->add('lastName', 'text')
            ->add('dob', 'timestamp_date');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('firstName', null, array(), 'text')
            ->add('middleName', null, array(), 'text')
            ->add('lastName', null, array(), 'text')
            ->add('dob', null, array(), 'timestamp_date');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('lastName', 'text')
            ->add('firstName', 'text')
            ->add('middleName', 'text')
            ->add('dob', 'date', array(
                'pattern' => 'dd.MM.yyyy'
            ))
			;
    }
}