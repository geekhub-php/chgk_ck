<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

class FutureTimestampValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value && $value < time()) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
