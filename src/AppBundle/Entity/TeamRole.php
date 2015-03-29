<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Traits\TimestampableTrait;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity
 * @UniqueEntity("name", message="name is already used")
 */
class TeamRole
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
	 * @JMS\Groups({"teamRoleFull", "short"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30, unique=true, nullable=false)
     * @Assert\Regex("/^[A-zА-я іїє]{2,30}$/", message="name is not valid")
     * @Assert\NotBlank()
	 * @JMS\Groups({"teamRoleFull"})
     */
    private $name;

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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param  string $name
     * @return TeamRole
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
