<?php

namespace AppBundle\Tests\Controller;

class GameResultsControllerTest extends AbstractController
{
    public function testGetGameresults()
    {
        $id = $this->getEm()->getRepository('AppBundle:GameResult')->findAll();
        $this->request('/games/{game}/gameResults /' . base_convert(md5(uniqid()), 11, 10), 'GET', 404);
    }

    /**
     * @dataProvider providerGameresultsResponseFields
     */
    public function testGameresultsResponseFields($field)
    {
        $client = $this->getClient();
        $crawler = $client->request('GET', '/gameResults');
        $this->assertContains($field, $client->getResponse()->getContent());
    }

    public function providerGameresultsResponseFields()
    {
        return [
            ['gameResults'],
            ['game'],
            ['place'],
            ['score'],
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
