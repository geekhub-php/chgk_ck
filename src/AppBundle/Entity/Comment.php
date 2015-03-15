<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as CustomAssert;
use AppBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity
 */
class Comment
{
    use TimestampableTrait;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="comments")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id", nullable=false)
     * @CustomAssert\EntitiesExist(associatedEntity="Event", message="event with id %ids% is non-exist")
     * @Assert\NotNull(message="comment should have author")
     */
    private $event;

    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
     * @CustomAssert\EntitiesExist(associatedEntity="User", message="user with id %ids% is non-exist")
     * @Assert\NotNull(message="comment should have author")
     */
    private $author;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotBlank()
     */
    private $text;

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
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set text
     *
     * @param  string $text
     * @return Comment
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get event
     *
     * @return \AppBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set event
     *
     * @param  \AppBundle\Entity\Event $event
     * @return Comment
     */
    public function setEvent(\AppBundle\Entity\Event $event)
    {
        $this->event = $event;

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
     * Set author
     *
     * @param  \AppBundle\Entity\User $author
     * @return Comment
     */
    public function setAuthor(\AppBundle\Entity\User $author)
    {
        $this->author = $author;

        return $this;
    }
}
