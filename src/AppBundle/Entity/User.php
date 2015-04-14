<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="password", column=@ORM\Column(nullable=true)),
 *      @ORM\AttributeOverride(name="email", column=@ORM\Column(nullable=true)),
 *      @ORM\AttributeOverride(name="emailCanonical", column=@ORM\Column(nullable=true)),
 * })
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(name="facebook_id", type="string", length=255, nullable=true) */
    protected $facebook_id;

    /** @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) */
    protected $facebook_access_token;

    /** @ORM\Column(name="vkontakte_id", type="string", length=255, nullable=true) */
    protected $vkontakte_id;

    /** @ORM\Column(name="vkontakte_access_token", type="string", length=255, nullable=true) */
    protected $vkontakte_access_token;

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
     * Get id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug.
     *
     * @param string $slug
     *
     * @return User
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get assignedPlayer.
     *
     * @return \AppBundle\Entity\Player
     */
    public function getAssignedPlayer()
    {
        return $this->assignedPlayer;
    }

    /**
     * Set assignedPlayer.
     *
     * @param \AppBundle\Entity\Player $assignedPlayer
     *
     * @return User
     */
    public function setAssignedPlayer(\AppBundle\Entity\Player $assignedPlayer = null)
    {
        $this->assignedPlayer = $assignedPlayer;

        return $this;
    }

    /**
     * Get facebook_id.
     *
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * Set facebook_id.
     *
     * @param string $facebookId
     *
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebook_id = $facebookId;

        return $this;
    }

    /**
     * Get facebook_access_token.
     *
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }

    /**
     * Set facebook_access_token.
     *
     * @param string $facebookAccessToken
     *
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVkontakteAccessToken()
    {
        return $this->vkontakte_access_token;
    }

    /**
     * @param mixed $vkontakte_access_token
     */
    public function setVkontakteAccessToken($vkontakte_access_token)
    {
        $this->vkontakte_access_token = $vkontakte_access_token;
    }

    /**
     * @return mixed
     */
    public function getVkontakteId()
    {
        return $this->vkontakte_id;
    }

    /**
     * @param mixed $vkontakte_id
     */
    public function setVkontakteId($vkontakte_id)
    {
        $this->vkontakte_id = $vkontakte_id;
    }
}
