<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\Entity\AgeCategory;

class AgeCategoryAdmin extends Admin
{
    protected $baseRouteName = "admin_age_category";
    protected $baseRoutePattern = "ageCategory";

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            // ->add('name', array('choices' => array(
                // 'SCHOOL' => 'Школьная',
                // 'YOUTH' => 'Молодежная',
                // 'ADULT' => 'Взрослая',
            // )))
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