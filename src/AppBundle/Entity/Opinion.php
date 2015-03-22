<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity
 */
class Opinion
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
	 * @JMS\Groups({"opinionFull", "short"})
     */
    private $id;	
	
	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
	 * @ORM\JoinColumn(name="author_id", referencedColumnName="id", nullable=false)
	 * @JMS\Groups({"opinionFull"})
	 */
	private $author;
	
	/**
	 * @ORM\Column(type="boolean")
	 * @JMS\Groups({"opinionFull"})
	 */
	private $isPositive;
	
	public function __construct()
	{
		$this->isPositive = false;
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
     * Set isPositive
     *
     * @param boolean $isPositive
     * @return Opinion
     */
    public function setIsPositive($isPositive)
    {
        $this->isPositive = $isPositive;

        return $this;
    }

    /**
     * Get isPositive
     *
     * @return boolean 
     */
    public function getIsPositive()
    {
        return $this->isPositive;
    }

    /**
     * Set author
     *
     * @param \AppBundle\Entity\User $author
     * @return Opinion
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
}
