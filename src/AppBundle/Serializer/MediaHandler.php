<?php

namespace AppBundle\Serializer;

use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\GraphNavigator;
use Application\Sonata\MediaBundle\Entity\Media;
use JMS\Serializer\Context;
use JMS\Serializer\JsonSerializationVisitor;
use Symfony\Component\DependencyInjection\Container;

class MediaHandler implements SubscribingHandlerInterface
{
    private $container;

    private $format;

    public function __construct(Container $container, $format)
    {
        $this->container = $container;
        $this->format = $format;
    }

    public static function getSubscribingMethods()
    {
        return array(
            array(
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format' => 'json',
                'type' => 'Application\Sonata\MediaBundle\Entity\Media',
                'method' => 'serializeMediaToJson',
            ),
        );
    }

    public function serializeMediaToJson(JsonSerializationVisitor $visitor, Media $media, array $type, Context $context)
    {
        $provider = $this->container->get($media->getProviderName());

        return $provider->generatePublicUrl($media, $this->format);
    }
}
