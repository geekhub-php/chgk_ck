<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\Entity\ MembershipType;

class MembershipTypeAdmin extends Admin
{
    protected $baseRouteName = "admin_ membership_type ";
    protected $baseRoutePattern = " membershipType ";

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'sonata_type_translatable_choice', array('choices' => membershipType::getNames()))
            ->add('description', 'text');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('description', 'text');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('description', 'text');
    }
}