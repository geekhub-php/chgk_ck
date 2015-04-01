<?php

namespace AppBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class OpinionVoter implements VoterInterface
{
    const DELETE = 'delete';
    const ADD = 'add';

    public function supportsAttribute($attribute)
    {
        return in_array($attribute, array(
            self::DELETE,
            self::ADD,
        ));
    }

    public function supportsClass($class)
    {
        return 'AppBundle\Entity\Opinion' === $class;
    }

    public function vote(TokenInterface $token, $opinion, array $attributes)
    {
        $attribute = $attributes[0];

        if (!$this->supportsClass(get_class($opinion)) || !$this->supportsAttribute($attribute)) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return VoterInterface::ACCESS_DENIED;
        }

        switch ($attribute) {
            case self::DELETE:
                if ($opinion->getAuthor()->getId() == $user->getId()) {
                    return VoterInterface::ACCESS_GRANTED;
                }
                break;
            case self::ADD:
                return VoterInterface::ACCESS_GRANTED;//whether user is logged in was checked above
        }

        return VoterInterface::ACCESS_DENIED;
    }
}
