<?php
namespace AppBundle\DataFixtures\ORM;

use Hautelook\AliceBundle\Alice\DataFixtureLoader;
use Nelmio\Alice\Fixtures;
use Application\Sonata\MediaBundle\Entity\Media;

class LoadData extends DataFixtureLoader
{
    public function getMedia($name, $context = 'default')
    {
        $media = new Media();

        $media->setBinaryContent(__DIR__ . '/../data/' . $name);
        $media->setContext($context);
        $media->setProviderName('sonata.media.provider.image');

        $this->container->get('sonata.media.manager.media')->save($media, $andFlush = true);

        return $media;
    }

    protected function getFixtures()
    {
        return array(
            __DIR__ . '/fixtures.yml',
        );
    }
}