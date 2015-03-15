<?php

namespace AppBundle\Entity\Opinion;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as CustomAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @UniqueEntity(fields={"author", "comment"})
 */
class CommentOpinion extends Opinion
{
	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Comment")
	 * @CustomAssert\EntitiesExist(associatedEntity="Comment", message="user with id %ids% is non-exist")
	 * @Assert\NotNull(message="opinion on comment should have comment")
	 */
	private $comment; 

    /**
     * Set comment
     *
     * @param \AppBundle\Entity\Comment $comment
     * @return CommentOpinion
     */
    public function setComment(\AppBundle\Entity\Comment $comment = null)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return \AppBundle\Entity\Comment 
     */
    public function getComment()
    {
        return $this->comment;
    }
}
