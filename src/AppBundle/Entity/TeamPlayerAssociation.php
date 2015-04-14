<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as CustomAssert;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity
 */
class TeamPlayerAssociation
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"associationFull", "short"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="teamPlayerAssociations")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id", nullable=false)
     * @CustomAssert\EntitiesExist(associatedEntity="Player", message="player with id %ids% is non-exist")
     * @Assert\NotNull()
     * @JMS\Groups({"associationFull"})
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="teamPlayerAssociations")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id", nullable=false)
     * @CustomAssert\EntitiesExist(associatedEntity="Team", message="team with id %ids% is non-exist")
     * @Assert\NotNull()
     * @JMS\Groups({"associationFull"})
     */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity="MembershipType")
     * @ORM\JoinColumn(name="membershipType_id", referencedColumnName="id", nullable=false)
     * @CustomAssert\EntitiesExist(associatedEntity="MembershipType", message="membership type with id %ids% is non-exist")
     * @Assert\NotNull()
     * @JMS\Groups({"associationFull"})
     */
    private $membershipType;

    /**
     * @ORM\ManyToMany(targetEntity="TeamRole")
     * @CustomAssert\EntitiesExist(associatedEntity="TeamRole", message="team roles with ids %ids% are non-exist")
     * @Assert\Count(min=1)
     * @JMS\Groups({"associationFull"})
     */
    private $roles;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

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
     * @return TeamPlayerAssociation
     */
    public function setPlayer(\AppBundle\Entity\Player $player)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get team.
     *
     * @return \AppBundle\Entity\Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set team.
     *
     * @param \AppBundle\Entity\Team $team
     *
     * @return TeamPlayerAssociation
     */
    public function setTeam(\AppBundle\Entity\Team $team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get membershipType.
     *
     * @return \AppBundle\Entity\MembershipType
     */
    public function getMembershipType()
    {
        return $this->membershipType;
    }

    /**
     * Set membershipType.
     *
     * @param \AppBundle\Entity\MembershipType $membershipType
     *
     * @return TeamPlayerAssociation
     */
    public function setMembershipType(\AppBundle\Entity\MembershipType $membershipType)
    {
        $this->membershipType = $membershipType;

        return $this;
    }

    /**
     * Add roles.
     *
     * @param \AppBundle\Entity\TeamRole $roles
     *
     * @return TeamPlayerAssociation
     */
    public function addRole(\AppBundle\Entity\TeamRole $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles.
     *
     * @param \AppBundle\Entity\TeamRole $roles
     */
    public function removeRole(\AppBundle\Entity\TeamRole $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
