<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use AppBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity
 * @UniqueEntity("name", message="name is already used")
 */
class AgeCategory
{
    use TimestampableTrait;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\Regex("/^[A-zА-я іїє]{2,255}$/", message="name is not valid")
     * @Assert\NotBlank(message="should not be blank")
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotBlank(message="should not be blank")
     */
    private $description;

    /**
     * @Gedmo\Slug(fields={"name"})
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
     * @return AgeCategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param  string $description
     * @return AgeCategory
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
     * Set slug
     *
     * @param  string $slug
     * @return AgeCategory
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
}
