<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as CustomAssert;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity
 */
class PlayerGameResult extends GameResult
{
    /**
     * @ORM\ManyToOne(targetEntity="Player")
     * @Assert\NotNull()
     * @CustomAssert\EntitiesExist(associatedEntity="Player", message="player with id %ids% is non-exist")
     * @JMS\Groups({"gameResultFull"})
     */
    private $player;

    /**
     * Get player.
     *
     * @return \AppBundle\Entity\Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set player.
     *
     * @param \AppBundle\Entity\Player $player
     *
     * @return PlayerGameResult
     */
    public function setPlayer(\AppBundle\Entity\Player $player = null)
    {
        $this->player = $player;

        return $this;
    }
}
