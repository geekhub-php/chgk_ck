<?php

namespace AppBundle\Tests\Controller;

class TeamControllerTest extends AbstractController
{
    public function testGetTeam()
    {
        $id = $this->getEm()->getRepository('AppBundle:Team')->findAll();
        $this->request('/teams/{team}/' . base_convert(md5(uniqid()), 11, 10), 'GET', 404);
    }

    /**
     * @dataProvider providerTeamsResponseFields
     */
    public function testTeamsResponseFields($field)
    {
        $client = $this->getClient();
        $crawler = $client->request('GET', '/teams');
        $this->assertContains($field, $client->getResponse()->getContent());
    }

    public function providerTeamsResponseFields()
    {
        return [
            ['teams'],
            ['name'],
            ['rating'],
            ['description'],
            ['city'],
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
