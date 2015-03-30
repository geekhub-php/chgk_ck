<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EventAdmin extends Admin
{
	protected $baseRouteName = "admin_event";
    protected $baseRoutePattern = "event";
	
	protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text')
            ->add('text', 'text')
            ->add('author', 'entity', array(
                'class' => 'AppBundle:User',
                'property' => 'email',
            ))
            ->add('eventDate', 'timestamp_date')
			->add('tags', 'tags', array('required' => false))
			;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('author', null, array(), 'entity', array('property' => 'email', 'placeholder' => 'any author'))
            ->add('eventDate', null, array(), 'timestamp_date');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('title')
            ->add('author', null, array('associated_property' => 'email'))
            ->add('createdAt', 'date', array(
                'pattern' => 'dd.MM.yyyy'
            ))
            ->add('deletedAt', 'date', array(
                'pattern' => 'dd.MM.yyyy'
            ))
            ->add('eventDate', 'date', array(
                'pattern' => 'dd.MM.yyyy'
            ))
			->add('tags', 'array')
			;
    }
	
	public function createQuery($context = 'list')
	{
	    $query = parent::createQuery($context);
				
		$query->select('e')
			->from('AppBundle:Event', 'e')
			->where('e INSTANCE OF AppBundle:Event');
			
		return $query;
	}
}
