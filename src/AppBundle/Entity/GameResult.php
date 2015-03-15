<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as CustomAssert;
use AppBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="resultType", type="string")
 * @ORM\DiscriminatorMap({"team" = "TeamGameResult", "player" = "PlayerGameResult"})
 */
abstract class GameResult
{
    use TimestampableTrait;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Game")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id", nullable=false)
     * @Assert\NotNull(message="game result should have game")
     * @CustomAssert\EntitiesExist(associatedEntity="Game", message="game with id %ids% is non-exist")
     */
    private $game;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotNull()
     * @Assert\Range(min=1)
     */
    private $place;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotNull()
     * @Assert\Range(min=0)
     */
    private $score;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set place
     *
     * @param  integer    $place
     * @return GameResult
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return integer
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set score
     *
     * @param  integer    $score
     * @return GameResult
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set game
     *
     * @param  \AppBundle\Entity\Game $game
     * @return GameResult
     */
    public function setGame(\AppBundle\Entity\Game $game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \AppBundle\Entity\Game
     */
    public function getGame()
    {
        return $this->game;
    }
}
