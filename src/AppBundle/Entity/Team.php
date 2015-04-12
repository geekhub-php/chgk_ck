<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as CustomAssert;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity
 */
class Team
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"teamFull", "short"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotNull()
     * @Assert\Length(min = 2, max = 255)
     * @JMS\Groups({"teamFull"})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotBlank()
     * @JMS\Groups({"teamFull"})
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\Range(min = 0)
     * @JMS\Groups({"teamFull"})
     */
    private $rating = 0;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Regex("/^[A-zА-я іїє\-]{2,255}$/", message="city is not valid")
     * @JMS\Groups({"teamFull"})
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="TeamPlayerAssociation", mappedBy="team")
     * @JMS\Groups({"teamFull"})
     */
    private $teamPlayerAssociations;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     * @JMS\Groups({"teamFull"})
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="AgeCategory")
     * @ORM\JoinColumn(name="age_category_id", referencedColumnName="id", nullable=false)
     * @CustomAssert\EntitiesExist(associatedEntity="AgeCategory", message="age category with id %ids% is non-exist")
     * @Assert\NotNull()
     * @JMS\Groups({"teamFull"})
     */
    private $ageCategory;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
	 * @JMS\Groups({"teamFull"})
     */
    private $image;

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

    /**
     * Set image
     *
     * @param  \Application\Sonata\MediaBundle\Entity\Media $image
     * @return Team
     */
    public function setImage(\Application\Sonata\MediaBundle\Entity\Media $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getImage()
    {
        return $this->image;
    }
}
