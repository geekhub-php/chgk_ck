<?php

namespace AppBundle\Tests\Controller;

class GallerysControllerTest extends AbstractController
{
    public function testGetGallerys()
    {
        $this->request('/api/gallerys');
    }

    public function testGetGallery()
    {
        $id = $this->getEm()->getRepository('Application\Sonata\MediaBundle\Entity\Gallery')->findAll();
        $this->request('/gallerys/' . base_convert(md5(uniqid()), 11, 10), 'GET', 404);
    }
}
