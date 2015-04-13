<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Handler\HandlerRegistry;

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

            $builder = SerializerBuilder::create();
            $handler = $this->get('app.serializer.media.handler');
            $builder->configureHandlers(function (HandlerRegistry $registry) use ($handler) {
                $registry->registerSubscribingHandler($handler);
            });
            $serializer = $builder->build();
            $serializationContext = SerializationContext::create()->setGroups(array('userInfo'));
            $response->setContent($serializer->serialize($user, 'json', $serializationContext));
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Cache-Control', 'no-cache');
        } catch (\Exception $e) {
        }

        return $response;
    }
}
