<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;
use Doctrine\Common\Collections\ArrayCollection;

class EntitiesExistValidator extends ConstraintValidator
{
    private $doctrine;

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function validate($value, Constraint $constraint)
    {
        $assignedEntitiesIds = $this->getEntitiesIds($value);

        $entityRepository = $this->doctrine->getRepository("AppBundle:".$constraint->associatedEntity);
        $fetchedEntities = $entityRepository->findBy(array('id' => $assignedEntitiesIds));
        $actualEntitiesIds = $this->getEntitiesIds($fetchedEntities);

        $nonExistentIds = array_diff($assignedEntitiesIds, $actualEntitiesIds);
        if (count($nonExistentIds) != 0) {
            $nonExistentIds = array_map(function ($value) {
                    return is_null($value) ? 'null' : $value;
            }, $nonExistentIds);

            $this->context->buildViolation($constraint->message)
                ->setParameter('%ids%', implode(", ", $nonExistentIds))
                ->setParameter('%entityClass%', $constraint->associatedEntity)
                ->addViolation();
        }
    }

    private function getEntitiesIds($value)
    {
        $ids = [];
        if ($value instanceof ArrayCollection || is_array($value)) {
            foreach ($value as $entity) {
                $ids[] = $entity->getId();
            }
        } elseif ($value) {
            $ids[] = $value->getId();
        }

        return $ids;
    }
}
