<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\Entity\ TeamRole;

class TeamRoleAdmin extends Admin
{
    protected $baseRouteName = "admin_ team_role ";
    protected $baseRoutePattern = "teamRole";

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', 'text')
            // ->add('name', array('choices' => array(
                // 'CAPTAIN' => 'Капитан',
                // 'SPARROW' => 'Ласточка',
                // 'IDEAGEN' => 'Генератор идей',
                // 'LOGICIAN' => 'Логик',
                // 'INTUITIONIST' => 'Интуит',
                // 'ERUDITE' => 'Эрудит',
                // 'CRITICIST' => 'Критик',
                // 'LIFE_OF_THE_TEAM' => 'Душа команды',
                // 'USSR' => 'Совок',
            // )))
            ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
			;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
			;
    }
}
