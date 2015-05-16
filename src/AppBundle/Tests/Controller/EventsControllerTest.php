<?php

namespace AppBundle\Tests\Controller;

class EventsControllerTest extends AbstractController
{
    public function testGetEvents()
    {
        $this->request('/api/events');
    }

    public function testGetEvent()
    {
        $id = $this->getEm()->getRepository('AppBundle:Event')->findAll();
        $this->request('/events /' . base_convert(md5(uniqid()), 11, 10), 'GET', 404);
    }

    /**
     * @dataProvider providerEventsResponseFields
     */
    public function testEventsResponseFields($field)
    {
        $client = $this->getClient();
        $crawler = $client->request('GET', '/events');
        $this->assertContains($field, $client->getResponse()->getContent());
    }

    public function providerEventsResponseFields()
    {
        return [
            ['events'],
            ['title'],
            ['text'],
            ['author'],
            ['image'],
            ['eventDate'],
            ['tags'],
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
