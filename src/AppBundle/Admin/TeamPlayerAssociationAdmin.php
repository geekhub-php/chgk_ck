<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\Entity\TeamPlayerAssociation;

class TeamPlayerAssociationAdmin extends Admin
{
    protected $baseRouteName = "admin_team_player_association";
    protected $baseRoutePattern = "teamPlayerAssociation";

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('player', 'entity', array(
                'class' => 'AppBundle:Player',
                'property' => 'lastName',
            ))
            ->add('team', 'entity', array(
                'class' => 'AppBundle:Team',
                'property' => 'name',
            ))
            ->add('membershipType', 'entity', array(
                'class' => 'AppBundle:MembershipType',
                'property' => 'name',
            ))
            ->add('roles', 'entity', array(
                'class' => 'AppBundle:TeamRole',
                'property' => 'name',
                'multiple' => true,
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('player', null, array(), 'entity', array('property' => 'lastName', 'placeholder' => 'any player'))
            ->add('team', null, array(), 'entity', array('property' => 'name', 'placeholder' => 'any team'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('player', null, array('associated_property' => 'lastName'))
            ->add('team', null, array('associated_property' => 'name'))
            ->add('membershipType', null, array('associated_property' => 'name'))
            ->add('roles', null, array('associated_property' => 'name'));
    }
}
