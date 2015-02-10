<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as CustomAssert;

/**
 * @ORM\Entity
 */
class Player
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     * @Assert\Regex("/^[A-zА-яіїє']{1,50}$/")
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     * @Assert\Regex("/^[A-zА-яіїє']{1,50}$/")
     * @Assert\NotBlank()
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     * @Assert\Regex("/^[A-zА-яіїє']{1,50}$/")
     * @Assert\NotBlank()
     */
    private $middleName;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @CustomAssert\PastTimestamp()
     * @Assert\NotNull()
     */
    private $dob;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="TeamRole")
     * @ORM\JoinColumn(name="teamRole_id", referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     * @CustomAssert\EntitiesExist(associatedEntity="TeamRole", message="team role with id %ids% is non-exist")
     */
    private $teamRole;

    /**
     * @ORM\ManyToOne(targetEntity="MembershipType")
     * @ORM\JoinColumn(name="membershipType_id", referencedColumnName="id", nullable=false)
     * @Assert\NotNull()
     * @CustomAssert\EntitiesExist(associatedEntity="MembershipType", message="membership type with id %ids% is non-exist")
     */
    private $membershipType;

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
     * Set teamRole
     *
     * @param  \AppBundle\Entity\TeamRole $teamRole
     * @return Player
     */
    public function setTeamRole(\AppBundle\Entity\TeamRole $teamRole)
    {
        $this->teamRole = $teamRole;

        return $this;
    }

    /**
     * Get teamRole
     *
     * @return \AppBundle\Entity\TeamRole
     */
    public function getTeamRole()
    {
        return $this->teamRole;
    }

    /**
     * Set membershipType
     *
     * @param  \AppBundle\Entity\MembershipType $membershipType
     * @return Player
     */
    public function setMembershipType(\AppBundle\Entity\MembershipType $membershipType)
    {
        $this->membershipType = $membershipType;

        return $this;
    }

    /**
     * Get membershipType
     *
     * @return \AppBundle\Entity\MembershipType
     */
    public function getMembershipType()
    {
        return $this->membershipType;
    }
}
