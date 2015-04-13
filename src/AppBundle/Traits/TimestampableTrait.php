<?php
namespace AppBundle\Traits;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * @ExclusionPolicy("all")
 */
trait TimestampableTrait
{
    /**
     * @ORM\Column(type="integer", name="createdAt")
     * @Expose
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="integer", nullable=true, name="updatedAt")
     * @Expose
     */
    protected $updatedAt;

    /**
     * Get createdAt
     *
     * @return integer Created at
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param  integer $createdAt Created at
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return integer Updated at
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set updated At
     *
     * @param  integer $updatedAt Updated at
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
