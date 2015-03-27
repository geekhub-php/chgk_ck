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
class MembershipType
{
    use TimestampableTrait;

    const NAME_MAIN = 'Основной игрок';
    const NAME_LEGIONNAIRE = 'Легионер';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
	 * @JMS\Groups({"membershipTypesFull", "short"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true, nullable=false)
     * @Assert\Regex("/^[A-zА-я іїє]{2,50}$/", message="name is not valid")
     * @Assert\NotBlank()
	 * @JMS\Groups({"membershipTypesFull"})
     */
    private $name;

    public static function getNames()
    {
        return [
            membershipType:: NAME_MAIN => 'Основной игрок',
            membershipType:: NAME_LEGIONNAIRE => 'Легионер',
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
     * @return MembershipType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
