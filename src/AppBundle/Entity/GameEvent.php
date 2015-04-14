<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Validator\Constraints as CustomAssert;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity
 */
class GameEvent extends Event
{
    /**
     * @ORM\ManyToMany(targetEntity="Game")
     * @CustomAssert\EntitiesExist(associatedEntity="Game", message="games with ids %ids% are non-exist")
     * @JMS\Groups({"eventFull"})
     */
    private $games;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->games = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add games.
     *
     * @param \AppBundle\Entity\Game $games
     *
     * @return GameEvent
     */
    public function addGame(\AppBundle\Entity\Game $games)
    {
        $this->games[] = $games;

        return $this;
    }

    /**
     * Remove games.
     *
     * @param \AppBundle\Entity\Game $games
     */
    public function removeGame(\AppBundle\Entity\Game $games)
    {
        $this->games->removeElement($games);
    }

    /**
     * Get games.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGames()
    {
        return $this->games;
    }
}
