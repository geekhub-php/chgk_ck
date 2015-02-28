<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Validator\Constraints as CustomAssert;

/**
 * @ORM\Entity
 */
class PlayerEvent extends Event
{
    /**
     * @ORM\ManyToMany(targetEntity="Player")
     * @CustomAssert\EntitiesExist(associatedEntity="Player", message="players with ids %ids% are non-exist")
     */
    private $players;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->players = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add players
     *
     * @param  \AppBundle\Entity\Player $players
     * @return PlayerEvent
     */
    public function addPlayer(\AppBundle\Entity\Player $players)
    {
        $this->players[] = $players;

        return $this;
    }

    /**
     * Remove players
     *
     * @param \AppBundle\Entity\Player $players
     */
    public function removePlayer(\AppBundle\Entity\Player $players)
    {
        $this->players->removeElement($players);
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayers()
    {
        return $this->players;
    }
}
