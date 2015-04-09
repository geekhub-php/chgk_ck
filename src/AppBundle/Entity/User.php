<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use FOS\UserBundle\Model\User as BaseUser;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"userFull", "short"})
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Player")
     * @JMS\Groups({"userFull"})
     */
    private $assignedPlayer;

    /**
     * @Gedmo\Slug(fields={"email"})
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     * @JMS\Groups({"userFull"})
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
     */
    private $image;

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

    /**
     * Set image
     *
     * @param  \Application\Sonata\MediaBundle\Entity\Media $image
     * @return User
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
