<?php

namespace AppBundle\Controller\API\Opinion;

use FOS\RestBundle\Controller\Annotations as REST;
use AppBundle\Entity\Opinion;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Event;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class CommentOpinionsController extends OpinionsController
{
    /**
     * @REST\View(serializerGroups={"opinionFull", "short"})
     * @REST\Get("events/{event}/comments/{commentId}/opinions/{opinionId}", requirements={
     * 		"opinionId" = "\d+",
     * 		"commentId" = "\d+",
     * 		"event" = "\d+"
     * })
     * @ApiDoc(
     * 	description="returns commnents opinion",
     * 	parameters={
     * 		{"name"="event", "dataType"="integer", "required"="true", "description"="event id"},
     * 		{"name"="commentId", "dataType"="integer", "required"="true", "description"="comment id"},
     * 		{"name"="opinionId", "dataType"="integer", "required"="true", "description"="opinion id"}
     * 	},
     * 	requirements={
     *      {"name"="event","dataType"="integer","requirement"="\d+", "description"="event id"},
     * 		{"name"="commentId","dataType"="integer","requirement"="\d+", "description"="comment id"},
     * 		{"name"="opinionId","dataType"="integer","requirement"="\d+", "description"="opinion id"}
     *  },
     * 	statusCodes={
     * 		200="ok",
     * 		404="opinion not found"
     * 	},
     * 	output="AppBundle\Entity\Opinion"
     * )
     */
    public function getOpinionAction(Event $event, $commentId, $opinionId)
    {
        $comment = $this->getComment($event, $commentId);

        return parent::handleGetOpinion($comment, $opinionId);
    }

    /**
     * @REST\View(serializerGroups={"opinionFull", "short"})
     * @REST\Get("events/{event}/comments/{commentId}/opinions", requirements={
     * 		"commentId" = "\d+",
     * 		"event" = "\d+"
     * })
     * @ApiDoc(
     * 	description="returns commnents opinions",
     * 	parameters={
     * 		{"name"="event", "dataType"="integer", "required"="true", "description"="event id"},
     * 		{"name"="commentId", "dataType"="integer", "required"="true", "description"="comment id"}
     * 	},
     * 	requirements={
     *      {"name"="event","dataType"="integer","requirement"="\d+", "description"="event id"},
     * 		{"name"="commentId","dataType"="integer","requirement"="\d+", "description"="comment id"}
     *  },
     * 	statusCodes={
     * 		200="ok",
     * 	},
     * 	output="array<AppBundle\Entity\Opinion>"
     * )
     */
    public function getOpinionsAction(Event $event, $commentId)
    {
        $comment = $this->getComment($event, $commentId);

        return parent::handleGetOpinions($comment);
    }

    /**
     * @ParamConverter("opinion", converter="fos_rest.request_body")
     * @REST\Post("events/{event}/comments/{commentId}/opinions", requirements={
     * 		"commentId" = "\d+",
     * 		"event" = "\d+"
     * })
     * @ApiDoc(
     * 	description="creates new opinion",
     * 	parameters={
     * 		{"name"="event", "dataType"="integer", "required"="true", "description"="event id"},
     * 		{"name"="commentId", "dataType"="integer", "required"="true", "description"="comment id"}
     * 	},
     * 	requirements={
     *      {"name"="event","dataType"="integer","requirement"="\d+", "description"="event id"},
     * 		{"name"="commentId","dataType"="integer","requirement"="\d+", "description"="comment id"}
     *  },
     * 	statusCodes={
     * 		201="created",
     * 		409="opinion by curret user is already created",
     * 		403="access denied"
     * 	},
     * 	output="AppBundle\Entity\Opinion",
     * 	input="AppBundle\Entity\Opinion"
     * )
     */
    public function postOpinionAction(Event $event, $commentId, Opinion $opinion)
    {
        $comment = $this->getComment($event, $commentId);

        return parent::handlePostOpinion($comment, $opinion);
    }

    /**
     * @REST\View(statusCode=204)
     * @REST\Delete("events/{event}/comments/{commentId}/opinions/{opinionId}", requirements={
     * 		"opinionId" = "\d+",
     * 		"commentId" = "\d+",
     * 		"event" = "\d+"
     * })
     * @ApiDoc(
     * 	description="deletes opinion",
     * 	parameters={
     * 		{"name"="event", "dataType"="integer", "required"="true", "description"="event id"},
     * 		{"name"="commentId", "dataType"="integer", "required"="true", "description"="comment id"},
     * 		{"name"="opinionId", "dataType"="integer", "required"="true", "description"="opinion id"}
     * 	},
     * 	requirements={
     *      {"name"="event","dataType"="integer","requirement"="\d+", "description"="event id"},
     * 		{"name"="commentId","dataType"="integer","requirement"="\d+", "description"="comment id"},
     * 		{"name"="opinionId","dataType"="integer","requirement"="\d+", "description"="opinion id"}
     *  },
     * 	statusCodes={
     * 		204="deleted",
     * 		404="event or comment was not found",
     * 		403="access denied"
     * 	}
     * )
     */
    public function deleteOpinionAction(Event $event, $commentId, $opinionId)
    {
        $comment = $this->getComment($event, $commentId);

        return parent::handleDeleteOpinion($comment, $opinionId);
    }

    private function getComment(Event $event, $commentId)
    {
        $comment = $event->getComment($commentId);

        if (!$comment) {
            throw new NotFoundHttpException();
        }

        return $comment;
    }
}
