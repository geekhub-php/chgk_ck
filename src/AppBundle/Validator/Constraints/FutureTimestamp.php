<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class FutureTimestamp extends Constraint
{
    public $message = 'timestamp should be future';
}
