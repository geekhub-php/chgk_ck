<?php

namespace AppBundle\Tests\Controller;

class TeamRolesControllerTest extends AbstractController
{
    public function testGetTeamRoles()
    {
        $this->request('/api/teamRoles');
    }

    public function testGetMembershipType()
    {
        $id = $this->getEm()->getRepository('AppBundle:TeamRole')->findAll();
        $this->request('/teamRoles /' . base_convert(md5(uniqid()), 11, 10), 'GET', 404);
    }

    /**
     * @dataProvider providerTeamRolesResponseFields
     */
    public function testTeamRolesResponseFields($field)
    {
        $client = $this->getClient();
        $crawler = $client->request('GET', '/teamRoles');
        $this->assertContains($field, $client->getResponse()->getContent());
    }

    public function providerTeamRolesResponseFields()
    {
        return [
            ['teamRoles '],
            ['name'],
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
