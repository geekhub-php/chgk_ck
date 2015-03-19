<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as CustomAssert;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="eventType", type="string")
 * @ORM\DiscriminatorMap({"event" = "Event", "gameEvent" = "GameEvent", "playerEvent" = "PlayerEvent"})
 */
class Event
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
	 * @JMS\Groups({"eventFull", "short"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 255)
	 * @JMS\Groups({"eventFull"})
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotBlank()
	 * @JMS\Groups({"eventFull"})
     */
    private $text;

    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
     * @CustomAssert\EntitiesExist(associatedEntity="User", message="user with id %ids% is non-exist")
	 * @Assert\NotNull()
	 * @JMS\Groups({"eventFull"})
     */
    private $author;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotNull()
	 * @JMS\Groups({"eventFull"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
	 * @JMS\Groups({"eventFull"})
     */
    private $deletedAt;

    /**
     * @Gedmo\Slug(fields={"title"})
	 * @ORM\Column(type="string", length=255, unique=true, nullable=false)
	 * @JMS\Groups({"eventFull"})
     */
    private $slug;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotNull()
	 * @JMS\Groups({"eventFull"})
     */
    private $eventDate;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="event")
	 * @JMS\Groups({"eventFull"})
     */
    private $comments;

	/**
	 * @ORM\Column(type="array")
	 * @Assert\All({
     *     @Assert\Regex("/^[A-zА-яіїє']+$/")
     * })
	 * @JMS\Groups({"eventFull"})
	 */
	private $tags;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createdAt = time();
        $this->tags = array();
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
     * Set title
     *
     * @param  string $title
     * @return Event
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set text
     *
     * @param  string $text
     * @return Event
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set createdAt
     *
     * @param  integer $createdAt
     * @return Event
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return integer
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set deletedAt
     *
     * @param  integer $deletedAt
     * @return Event
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return integer
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set slug
     *
     * @param  string $slug
     * @return Event
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
     * Set eventDate
     *
     * @param  integer $eventDate
     * @return Event
     */
    public function setEventDate($eventDate)
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    /**
     * Get eventDate
     *
     * @return integer
     */
    public function getEventDate()
    {
        return $this->eventDate;
    }

    /**
     * Set author
     *
     * @param  \AppBundle\Entity\User $author
     * @return Event
     */
    public function setAuthor(\AppBundle\Entity\User $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \AppBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add comments
     *
     * @param  \AppBundle\Entity\Comment $comments
     * @return Event
     */
    public function addComment(\AppBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \AppBundle\Entity\Comment $comments
     */
    public function removeComment(\AppBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    public function setTags(array $tags)
    {
        $this->tags = $tags;

        return $this;
    }

    public function getTags()
    {
        return $this->tags;
    }

}
