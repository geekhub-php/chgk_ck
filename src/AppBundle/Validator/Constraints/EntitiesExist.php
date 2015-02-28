<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class EntitiesExist extends Constraint
{
    public $message = 'some attached entities are non-exist. Entity class %entityClass%, ids: %ids%';
    public $associatedEntity = '';

    public function validatedBy()
    {
        return 'entities_exist_validator';
    }
}
