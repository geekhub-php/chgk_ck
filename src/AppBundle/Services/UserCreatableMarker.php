<?php

namespace AppBundle\Services;

use AppBundle\Interfaces\UserCreatable;

class UserCreatableMarker
{
    private $tokenStorage;

    public function __construct($tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function mark(array $entities)
    {
        $user = $this->tokenStorage->getToken()->getUser();

        if ($user !== 'anon.') {
            foreach ($entities as $entity) {
                if (!$entity instanceof UserCreatable) {
                    throw new \Exception('Must be of the type UserCreatable, ' . get_class($entity) . ' given');
                }

                if ($entity->getAuthor()->getId() == $user->getId()) {
                    $entity->markAsMadeByCurrentUser();
                }
            }
        }
    }
}
