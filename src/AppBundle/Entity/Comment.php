<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as CustomAssert;
use JMS\Serializer\Annotation as JMS;
use AppBundle\Interfaces\Opinionable;

/**
 * @ORM\Entity
 */
class Comment implements Opinionable
{
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
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotNull()
	 * @JMS\Groups({"commentFull"})
     */
    private $createdAt;
    
    /**
	 * @ORM\ManyToMany(targetEntity="Opinion")
	 * @JMS\Groups({"commentFull"})
	 */
    private $opinions;

    public function __construct()
    {
    }
	
	public function setId($id)
	{
		$this->id = $id;
		
		return $this;
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
     * Set text
     *
     * @param  string  $text
     * @return Comment
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
     * @return Comment
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
     * Add opinions
     *
     * @param \AppBundle\Entity\Opinion $opinions
     * @return Comment
     */
    public function addOpinion(\AppBundle\Entity\Opinion $opinions)
    {
        $this->opinions[] = $opinions;

        return $this;
    }

    /**
     * Remove opinions
     *
     * @param \AppBundle\Entity\Opinion $opinions
     */
    public function removeOpinion(\AppBundle\Entity\Opinion $opinions)
    {
        $this->opinions->removeElement($opinions);
    }

    /**
     * Get opinions
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
}
