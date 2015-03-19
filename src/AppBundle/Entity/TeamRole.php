<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity
 * @UniqueEntity("name", message="name is already used")
 */
class TeamRole
{
    use TimestampableTrait;

    const NAME_CAPTAIN = 'Капитан';
    const NAME_SPARROW = 'Ласточка';
    const NAME_IDEAGEN = 'Генератор идей';
    const NAME_LOGICIAN = 'Логик';
    const NAME_INTUITIONIST = 'Интуит';
    const NAME_ERUDITE = 'Эрудит';
    const NAME_CRITICIST = 'Критик';
    const NAME_LIFE_OF_THE_TEAM = 'Душа команды';
    const NAME_USSR = 'Совок';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30, unique=true, nullable=false)
     * @Assert\Regex("/^[A-zА-я іїє]{2,30}$/", message="name is not valid")
     * @Assert\NotBlank()
     */
    private $name;

    public static function getNames()
    {
        return [
            teamRole:: NAME_CAPTAIN => 'Капитан',
            teamRole:: NAME_SPARROW => 'Ласточка',
            teamRole:: NAME_IDEAGEN => 'Генератор идей',
            teamRole:: NAME_LOGICIAN => 'Логик',
            teamRole:: NAME_INTUITIONIST => 'Интуит',
            teamRole:: NAME_ERUDITE => 'Эрудит',
            teamRole:: NAME_CRITICIST => 'Критик',
            teamRole:: NAME_LIFE_OF_THE_TEAM => 'Душа команды',
            teamRole:: NAME_USSR => 'Совок',
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
     * @return TeamRole
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
