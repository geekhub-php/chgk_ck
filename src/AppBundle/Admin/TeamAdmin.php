<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TeamAdmin extends Admin
{
    protected $baseRouteName = "admin_teams";
    protected $baseRoutePattern = "teams";

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ->add('description', 'text')
            ->add('rating', 'integer')
            ->add('city', 'text')
            ->add('ageCategory', 'entity', array(
                'class' => 'AppBundle:AgeCategory',
                'property' => 'name',
            ))
            ->add('image', 'sonata_media_type', array(
                 'provider' => 'sonata.media.provider.image',
                 'context'  => 'default',
                 'required' => false,
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, array(), 'text')
            ->add('rating', null, array(), 'integer')
            ->add('city', null, array(), 'text')
            ->add('ageCategory', null, array(), 'entity', array('property' => 'name', 'placeholder' => 'any category'));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', 'text')
            ->add('description', 'text')
            ->add('rating', 'integer')
            ->add('city', 'text')
            ->add('ageCategory', null, array('associated_property' => 'name'));
    }
}
