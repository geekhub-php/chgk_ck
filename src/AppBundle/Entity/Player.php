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
class Player
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"playerFull", "short"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     * @Assert\Regex("/^[A-zА-яіїє']{1,50}$/")
     * @Assert\NotBlank()
     * @JMS\Groups({"playerFull"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     * @Assert\Regex("/^[A-zА-яіїє']{1,50}$/")
     * @Assert\NotBlank()
     * @JMS\Groups({"playerFull"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     * @Assert\Regex("/^[A-zА-яіїє']{1,50}$/")
     * @Assert\NotBlank()
     * @JMS\Groups({"playerFull"})
     */
    private $middleName;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @CustomAssert\PastTimestamp()
     * @Assert\NotNull()
     * @JMS\Groups({"playerFull"})
     */
    private $dob;

    /**
     * @ORM\OneToMany(targetEntity="TeamPlayerAssociation", mappedBy="player")
     * @JMS\Groups({"playerFull"})
     */
    private $teamPlayerAssociations;

    /**
     * @Gedmo\Slug(fields={"lastName"})
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     * @JMS\Groups({"playerFull"})
     */
    private $slug;

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
     * Set firstName
     *
     * @param  string $firstName
     * @return Player
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param  string $lastName
     * @return Player
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set middleName
     *
     * @param  string $middleName
     * @return Player
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;

        return $this;
    }

    /**
     * Get middleName
     *
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * Set dob
     *
     * @param  integer $dob
     * @return Player
     */
    public function setDob($dob)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Get dob
     *
     * @return integer
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set slug
     *
     * @param  string $slug
     * @return Player
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
     * Add teamPlayerAssociations
     *
     * @param  \AppBundle\Entity\TeamPlayerAssociation $teamPlayerAssociations
     * @return Player
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
}
