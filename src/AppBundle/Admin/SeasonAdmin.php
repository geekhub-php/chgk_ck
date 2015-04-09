<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class SeasonAdmin extends Admin
{
    protected $baseRouteName = "admin_seasons";
    protected $baseRoutePattern = "seasons";

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ->add('startDate', 'timestamp_date')
            ->add('endDate', 'timestamp_date');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, array(), 'text')
            ->add('startDate', null, array(), 'sonata_type_date_picker')
            ->add('endDate', null, array(), 'timestamp_date');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', 'text')
            ->add('startDate', 'date', array(
                'pattern' => 'dd.MM.yyyy',
            ))
            ->add('endDate', 'date', array(
                'pattern' => 'dd.MM.yyyy',
            ));
    }
}
