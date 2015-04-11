<?php

namespace AppBundle\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\Team;
use FOS\RestBundle\Controller\Annotations as REST;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Entity\Player;

class TeamsController extends FOSRestController
{
    /**
     * @REST\View(serializerGroups={"teamFull", "ageCategoryFull", "short"})
     * @REST\QueryParam(name="name", default="")
     * @REST\QueryParam(name="rating", requirements="\d+", default="")
     * @REST\QueryParam(name="city", default="")
     * @REST\QueryParam(name="ageCategory", requirements="\d+", default="")
     * @REST\QueryParam(name="orderByRating", requirements="(asc|desc)", default="")
     * @ApiDoc(
     * 	description="returns teams",
     * 	statusCodes={
     * 		200="ok",
     * 	},
     * 	filters={
     *      {"name"="name", "dataType"="string"},
     * 		{"name"="rating", "dataType"="integer"},
     * 		{"name"="city", "dataType"="string"},
     * 		{"name"="ageCategory", "dataType"="integer"},
     * 		{"name"="orderByRating", "dataType"="string"}
     *  },
     * 	output="array<AppBundle\Entity\Team>"
     * )
     */
    public function getTeamsAction($name, $rating, $city, $ageCategory, $orderByRating)
    {
        $criteria = array();
        $orderBy = array();
        if ($name) {
            $criteria['name'] = $name;
        }
        if ($rating) {
            $criteria['rating'] = $rating;
        } elseif ($orderByRating) {
            $orderBy['rating'] = $orderByRating;
        }
        if ($city) {
            $criteria['city'] = $city;
        }
        if ($ageCategory) {
            $criteria['ageCategory'] = $ageCategory;
        }

        return $this->getDoctrine()->getRepository('AppBundle:Team')->findBy($criteria, $orderBy);
    }

    /**
     * @REST\View(serializerGroups={"teamFull", "ageCategoryFull", "short"})
     * @REST\Get("teams/{team}", requirements={
     * 		"team" = "\d+"
     * })
     * @ApiDoc(
     * 	description="returns team",
     * 	parameters={
     * 		{"name"="team", "dataType"="integer", "required"="true", "description"="team id"},
     * 	},
     * 	requirements={
     *      {"name"="team","dataType"="integer","requirement"="\d+", "description"="team id"},
     *  },
     * 	statusCodes={
     * 		200="ok",
     * 		404="team was not found"
     * 	},
     * 	output="AppBundle\Entity\Team"
     * )
     */
    public function getTeamAction(Team $team)
    {
        return $team;
    }

    /**
     * @REST\Get("teams/{team}/players")
     * @REST\View(serializerGroups={"playerFull", "associationFull", "membershipTypesFull", "teamRoleFull", "short"})
     * @ApiDoc(
     * 	description="returns team's players",
     * 	parameters={
     * 		{"name"="team", "dataType"="integer", "required"="true", "description"="team's id"},
     * 	},
     * 	requirements={
     *      {"name"="team","dataType"="integer","requirement"="\d+", "description"="team's id"},
     *  },
     * 	statusCodes={
     * 		200="ok",
     * 		404="team was not found"
     * 	},
     * 	output="array<AppBundle\Entity\Player>"
     * )
     */
    public function getPlayersAction(Team $team)
    {
        $query = $this->getDoctrine()->getManager()->createQuery('SELECT p, ta
		FROM AppBundle:Player p
		JOIN p.teamPlayerAssociations ta WITH ta.team = :teamId');
        $query->setParameter('teamId', $team->getId());

        return $query->getResult();
    }
}
