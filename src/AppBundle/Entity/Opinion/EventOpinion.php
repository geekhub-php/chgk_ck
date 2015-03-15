<?php

namespace AppBundle\Entity\Opinion;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as CustomAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @UniqueEntity(fields={"author", "event"})
 */
class EventOpinion extends Opinion
{
	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Event")
	 * @CustomAssert\EntitiesExist(associatedEntity="Event", message="user with id %ids% is non-exist")
	 * @Assert\NotNull(message="opinion on event should have event")
	 */
	private $event; 

    /**
     * Set event
     *
     * @param \AppBundle\Entity\Event $event
     * @return EventOpinion
     */
    public function setEvent(\AppBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \AppBundle\Entity\Event 
     */
    public function getEvent()
    {
        return $this->event;
    }
}
