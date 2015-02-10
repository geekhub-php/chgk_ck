<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as CustomAssert;

/**
 * @ORM\Entity
 */
class Game
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @CustomAssert\FutureTimestamp(groups={"creating"})
     * @Assert\NotNull()
     */
    private $playDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 255)
     */
    private $playPlace;

    /**
     * @ORM\ManyToOne(targetEntity="Season")
     * @CustomAssert\EntitiesExist(associatedEntity="Season", message="season with id %ids% is non-exist")
     */
    private $season;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isLocallyRated = false;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isGloballyRated = false;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isHome = false;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isComplete = false;

    /**
     * @ORM\ManyToOne(targetEntity="AgeCategory")
     * @ORM\JoinColumn(name="age_category_id", referencedColumnName="id", nullable=false)
     * @CustomAssert\EntitiesExist(associatedEntity="AgeCategory", message="age category with id %ids% is non-exist")
     */
    private $ageCategory;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotNull()
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    private $slug;

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
     * Set name
     *
     * @param  string $name
     * @return Game
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set playDate
     *
     * @param  integer $playDate
     * @return Game
     */
    public function setPlayDate($playDate)
    {
        $this->playDate = $playDate;

        return $this;
    }

    /**
     * Get playDate
     *
     * @return integer
     */
    public function getPlayDate()
    {
        return $this->playDate;
    }

    /**
     * Set playPlace
     *
     * @param  string $playPlace
     * @return Game
     */
    public function setPlayPlace($playPlace)
    {
        $this->playPlace = $playPlace;

        return $this;
    }

    /**
     * Get playPlace
     *
     * @return string
     */
    public function getPlayPlace()
    {
        return $this->playPlace;
    }

    /**
     * Set isLocallyRated
     *
     * @param  boolean $isLocallyRated
     * @return Game
     */
    public function setIsLocallyRated($isLocallyRated)
    {
        $this->isLocallyRated = $isLocallyRated;

        return $this;
    }

    /**
     * Get isLocallyRated
     *
     * @return boolean
     */
    public function getIsLocallyRated()
    {
        return $this->isLocallyRated;
    }

    /**
     * Set isGloballyRated
     *
     * @param  boolean $isGloballyRated
     * @return Game
     */
    public function setIsGloballyRated($isGloballyRated)
    {
        $this->isGloballyRated = $isGloballyRated;

        return $this;
    }

    /**
     * Get isGloballyRated
     *
     * @return boolean
     */
    public function getIsGloballyRated()
    {
        return $this->isGloballyRated;
    }

    /**
     * Set isHome
     *
     * @param  boolean $isHome
     * @return Game
     */
    public function setIsHome($isHome)
    {
        $this->isHome = $isHome;

        return $this;
    }

    /**
     * Get isHome
     *
     * @return boolean
     */
    public function getIsHome()
    {
        return $this->isHome;
    }

    /**
     * Set isComplete
     *
     * @param  boolean $isComplete
     * @return Game
     */
    public function setIsComplete($isComplete)
    {
        $this->isComplete = $isComplete;

        return $this;
    }

    /**
     * Get isComplete
     *
     * @return boolean
     */
    public function getIsComplete()
    {
        return $this->isComplete;
    }

    /**
     * Set description
     *
     * @param  string $description
     * @return Game
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set slug
     *
     * @param  string $slug
     * @return Game
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set season
     *
     * @param  \AppBundle\Entity\Season $season
     * @return Game
     */
    public function setSeason(\AppBundle\Entity\Season $season = null)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * Get season
     *
     * @return \AppBundle\Entity\Season
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Set ageCategory
     *
     * @param  \AppBundle\Entity\AgeCategory $ageCategory
     * @return Game
     */
    public function setAgeCategory(\AppBundle\Entity\AgeCategory $ageCategory)
    {
        $this->ageCategory = $ageCategory;

        return $this;
    }

    /**
     * Get ageCategory
     *
     * @return \AppBundle\Entity\AgeCategory
     */
    public function getAgeCategory()
    {
        return $this->ageCategory;
    }
}
