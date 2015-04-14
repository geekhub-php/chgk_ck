<?php
namespace AppBundle\Tests\Controller;

class MembershipTypesControllerTest extends AbstractController
{
    public function testGetMembershipTypes()
    {
        $this->request('/api/membershipTypes');
    }

    public function testGetMembershipType()
    {
        $id = $this->getEm()->getRepository('AppBundle:MembershipType')->findAll();
        $this->request('/membershipTypes /' . base_convert(md5(uniqid()), 11, 10), 'GET', 404);
    }

    /**
     * @dataProvider providerMembershipTypesResponseFields
     */
    public function testMembershipTypesResponseFields($field)
    {
        $client = $this->getClient();
        $crawler = $client->request('GET', '/membershipTypes');
        $this->assertContains($field, $client->getResponse()->getContent());
    }

    public function providerMembershipTypesResponseFields()
    {
        return [
            [' membershipTypes '],
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
