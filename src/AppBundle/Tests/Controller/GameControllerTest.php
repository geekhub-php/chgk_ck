<?php
namespace AppBundle\Tests\Controller;

class GameControllerTest extends AbstractController
{
    public function testGetGames()
    {
        $id = $this->getEm()->getRepository('AppBundle:Game')->findAll();
        $this->request('/games/{game}/' . base_convert(md5(uniqid()), 11, 10), 'GET', 404);
    }

    /**
     * @dataProvider providerGamesResponseFields
     */
    public function testGamesResponseFields($field)
    {
        $client = $this->getClient();
        $crawler = $client->request('GET', '/games');
        $this->assertContains($field, $client->getResponse()->getContent());
    }

    public function providerGamesResponseFields()
    {
        return [
            ['games'],
            ['name'],
            ['playDate'],
            ['playPlace'],
            ['season'],
            ['description'],
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
