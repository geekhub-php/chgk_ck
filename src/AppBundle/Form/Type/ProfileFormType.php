<?php

namespace AppBundle\Form\Type;

use FOS\UserBundle\Form\Type\ProfileFormType as FOSProfileFormType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileFormType extends FOSProfileFormType
{
    const DATA_CLASS = 'AppBundle\Entity\User';

    public function __construct()
    {
        parent::__construct(self::DATA_CLASS);
    }

    public function getName()
    {
        return 'user_profile';
    }

    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('image', 'sonata_media_type', array(
                 'provider' => 'sonata.media.provider.image',
                 'context'  => 'default',
                 'required' => false,
            ))
            ;
    }
}
