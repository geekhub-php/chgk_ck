<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;

class DefaultController extends Controller
{
    /**
     * @Route("/userInfo", name="user_info")
     */
    public function indexAction()
    {
        $response = new Response();

        try {
            $user = $this->get('security.token_storage')->getToken()->getUser();

            $serializer = SerializerBuilder::create()->build();
            $serializationContext = SerializationContext::create()->setGroups(array('userInfo'));
            $response->setContent($serializer->serialize($user, 'json', $serializationContext));
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Cache-Control', 'no-cache');
        } catch (\Exception $e) {
        }

        return $response;
    }
}
