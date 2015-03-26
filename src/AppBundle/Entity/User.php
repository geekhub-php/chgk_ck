<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Player")
     */
    private $assignedPlayer;

    /**
     * @Gedmo\Slug(fields={"email"})
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
     * @return User
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get assignedPlayer
     *
     * @return \AppBundle\Entity\Player
     */
    public function getAssignedPlayer()
    {
        return $this->assignedPlayer;
    }

    /**
     * Set assignedPlayer
     *
     * @param  \AppBundle\Entity\Player $assignedPlayer
     * @return User
     */
    public function setAssignedPlayer(\AppBundle\Entity\Player $assignedPlayer = null)
    {
        $this->assignedPlayer = $assignedPlayer;

        return $this;
    }
}
