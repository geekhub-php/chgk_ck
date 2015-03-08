<?php

namespace AppBundle\Entity\Opinion;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as CustomAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @UniqueEntity(fields={"author", "gameResult"})
 */
class GameResultOpinion extends Opinion
{
	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\GameResult")
	 * @CustomAssert\EntitiesExist(associatedEntity="GameResult", message="user with id %ids% is non-exist")
	 * @Assert\NotNull(message="opinion on game result should have game result")
	 */
	private $gameResult; 

    /**
     * Set gameResult
     *
     * @param \AppBundle\Entity\GameResult $gameResult
     * @return GameResultOpinion
     */
    public function setGameResult(\AppBundle\Entity\GameResult $gameResult = null)
    {
        $this->gameResult = $gameResult;

        return $this;
    }

    /**
     * Get gameResult
     *
     * @return \AppBundle\Entity\GameResult 
     */
    public function getGameResult()
    {
        return $this->gameResult;
    }
}
