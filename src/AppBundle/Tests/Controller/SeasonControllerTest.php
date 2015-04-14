<?php

namespace AppBundle\Tests\Controller;

class SeasonControllerTest extends AbstractController
{
    public function testGetSeason()
    {
        $id = $this->getEm()->getRepository('AppBundle:Season')->findAll();
        $this->request('/seasons/{season}/' . base_convert(md5(uniqid()), 11, 10), 'GET', 404);
    }

    /**
     * @dataProvider providerSeasonsResponseFields
     */
    public function testSeasonsResponseFields($field)
    {
        $client = $this->getClient();
        $crawler = $client->request('GET', '/seasons');
        $this->assertContains($field, $client->getResponse()->getContent());
    }

    public function providerSeasonsResponseFields()
    {
        return [
            ['seasons'],
            ['name'],
            ['startDate'],
            ['endDate'],
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
