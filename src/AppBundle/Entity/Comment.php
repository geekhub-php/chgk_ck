<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Traits\TimestampableTrait;
use JMS\Serializer\Annotation as JMS;
use AppBundle\Interfaces\Opinionable;
use AppBundle\Interfaces\UserCreatable;

/**
 * @ORM\Entity
 */
class Comment implements Opinionable, UserCreatable
{
    use TimestampableTrait;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Groups({"commentFull", "short"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
     * @JMS\Groups({"commentFull"})
     */
    private $author;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotBlank()
     * @JMS\Groups({"commentFull"})
     */
    private $text;

    /**
     * @ORM\ManyToMany(targetEntity="Opinion")
     */
    private $opinions;

    /**
     * @JMS\Groups({"commentFull"})
     * @JMS\Type("boolean")
     */
    private $madeByCurrentUser;

    /**
     * Get id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get text.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set text.
     *
     * @param string $text
     *
     * @return Comment
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get event.
     *
     * @return \AppBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Get author.
     *
     * @return \AppBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set author.
     *
     * @param \AppBundle\Entity\User $author
     *
     * @return Comment
     */
    public function setAuthor(\AppBundle\Entity\User $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Add opinions.
     *
     * @param \AppBundle\Entity\Opinion $opinions
     *
     * @return Comment
     */
    public function addOpinion(\AppBundle\Entity\Opinion $opinions)
    {
        $this->opinions[] = $opinions;

        return $this;
    }

    /**
     * Remove opinions.
     *
     * @param \AppBundle\Entity\Opinion $opinions
     */
    public function removeOpinion(\AppBundle\Entity\Opinion $opinions)
    {
        $this->opinions->removeElement($opinions);
    }

    /**
     * Get opinions.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOpinions()
    {
        return $this->opinions;
    }

    public function getOpinion($id)
    {
        return $this->opinions->filter(function ($opinion) use ($id) {
            return $opinion->getId() == $id;
        })->first();
    }

    public function markAsMadeByCurrentUser()
    {
        $this->madeByCurrentUser = true;

        return $this;
    }

    public function isMadeByCurrentUser()
    {
        return $this->madeByCurrentUser;
    }
}
