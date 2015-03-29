<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\Entity\MembershipType;

class MembershipTypeAdmin extends Admin
{
    protected $baseRouteName = "admin_ membership_type ";
    protected $baseRoutePattern = " membershipType ";

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            // ->add('name', array('choices' => array(
                // 'MAIN' => 'Основной игрок',
                // 'LEGIONNAIRE' => 'Легионер',
            // )))
            ->add('name', 'text');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name');
    }
}