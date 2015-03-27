<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use AppBundle\Traits\TimestampableTrait;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity
 * @UniqueEntity("name", message="name is already used")
 */
class AgeCategory
{
    use TimestampableTrait;

    const NAME_SCHOOL = 'Школьная';
    const NAME_YOUTH = 'Молодежная';
    const NAME_ADULT = 'Взрослая';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
	 * @JMS\Groups({"ageCategoryFull", "short"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\Regex("/^[A-zА-я іїє]{2,255}$/", message="name is not valid")
     * @Assert\NotBlank(message="should not be blank")
	 * @JMS\Groups({"ageCategoryFull"})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotBlank(message="should not be blank")
	 * @JMS\Groups({"ageCategoryFull"})
     */
    private $description;

    /**
     * @Gedmo\Slug(fields={"name"})
	 * @ORM\Column(type="string", length=255, unique=true, nullable=false)
	 * @JMS\Groups({"ageCategoryFull"})
     */
    private $slug;

    public static function getNames()
    {
        return [
            ageCategory::NAME_SCHOOL => 'Школьная',
            ageCategory::NAME_YOUTH => 'Молодежная',
            ageCategory::NAME_ADULT => 'Взрослая',
        ];

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
