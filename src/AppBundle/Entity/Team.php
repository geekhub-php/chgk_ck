<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as CustomAssert;
use Gedmo\Mapping\Annotation as Gedmo;
use AppBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity
 */
class Team
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotNull()
     * @Assert\Regex("/^[A-zА-я іїє'-]{2,255}$/", message="name is not valid")
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\Range(min = 0)
     */
    private $rating = 0;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 100)
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="TeamPlayerAssociation", mappedBy="team")
     */
    private $teamPlayerAssociations;

    /**
     * @Gedmo\Slug(fields={"name"})
	 * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="AgeCategory")
     * @ORM\JoinColumn(name="age_category_id", referencedColumnName="id", nullable=false)
     * @CustomAssert\EntitiesExist(associatedEntity="AgeCategory", message="age category with id %ids% is non-exist")
     * @Assert\NotNull()
     */
    private $ageCategory;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->teamPlayerAssociations = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param  string $name
     * @return Team
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * Set description
     *
     * @param  string $description
     * @return Team
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set rating
     *
     * @param  integer $rating
     * @return Team
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set city
     *
     * @param  string $city
     * @return Team
     */
    public function setCity($city)
    {
        $this->city = $city;

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
     * Set slug
     *
     * @param  string $slug
     * @return Team
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Add teamPlayerAssociations
     *
     * @param  \AppBundle\Entity\TeamPlayerAssociation $teamPlayerAssociations
     * @return Team
     */
    public function addTeamPlayerAssociation(\AppBundle\Entity\TeamPlayerAssociation $teamPlayerAssociations)
    {
        $this->teamPlayerAssociations[] = $teamPlayerAssociations;

        return $this;
    }

    /**
     * Remove teamPlayerAssociations
     *
     * @param \AppBundle\Entity\TeamPlayerAssociation $teamPlayerAssociations
     */
    public function removeTeamPlayerAssociation(\AppBundle\Entity\TeamPlayerAssociation $teamPlayerAssociations)
    {
        $this->teamPlayerAssociations->removeElement($teamPlayerAssociations);
    }

    /**
     * Get teamPlayerAssociations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeamPlayerAssociations()
    {
        return $this->teamPlayerAssociations;
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

    /**
     * Set ageCategory
     *
     * @param  \AppBundle\Entity\AgeCategory $ageCategory
     * @return Team
     */
    public function setAgeCategory(\AppBundle\Entity\AgeCategory $ageCategory)
    {
        $this->ageCategory = $ageCategory;

        return $this;
    }
}
