<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as CustomAssert;

/**
 * @ORM\Entity
 */
class TeamGameResult extends GameResult
{
    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @Assert\NotNull()
     * @CustomAssert\EntitiesExist(associatedEntity="Team", message="team with id %ids% is non-exist")
     */
    private $team;

    /**
     * Set team
     *
     * @param  \AppBundle\Entity\Team $team
     * @return TeamGameResult
     */
    public function setTeam(\AppBundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \AppBundle\Entity\Team
     */
    public function getTeam()
    {
        return $this->team;
    }
}
