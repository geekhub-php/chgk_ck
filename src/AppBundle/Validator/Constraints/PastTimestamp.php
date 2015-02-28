<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PastTimestamp extends Constraint
{
    public $message = 'timestamp should be in past';
}
