<?php

namespace AppBundle\Tests\Controller;

class PlayerControllerTest extends AbstractController
{
    public function testGetPlayer()
    {
        $id = $this->getEm()->getRepository('AppBundle:Player')->findAll();
        $this->request('/players/{player}/' . base_convert(md5(uniqid()), 11, 10), 'GET', 404);
    }

    /**
     * @dataProvider providerPlayersResponseFields
     */
    public function testPlayersResponseFields($field)
    {
        $client = $this->getClient();
        $crawler = $client->request('GET', '/players');
        $this->assertContains($field, $client->getResponse()->getContent());
    }

    public function providerPlayersResponseFields()
    {
        return [
            ['players'],
            ['firstName'],
            ['lastName'],
            ['dob'],
            ['image'],
            ['url'],
            ['properties'],
            ['alt'],
            ['title'],
            ['src'],
            ['width'],
            ['height'],
            ['slug'],
            ['tags'],
            ['id'],
            ['created_at'],
            ['updated_at'],
            ['page'],
            ['count'],
            ['total_count'],
            ['_links'],
            ['self'],
            ['first'],
            ['prev'],
            ['next'],
            ['last'],
            ['href'],
        ];
    }
}
