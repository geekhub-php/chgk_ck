<?php
namespace AppBundle\Tests\Controller;

class AgeCategoriesControllerTest extends AbstractController

{
    public function testGetAgeCategories()
    {
        $this->request('/api/ageCategories');
    }

    public function testGetAgeCategory()
    {
        $id = $this->getEm()->getRepository('AppBundle:AgeCategory')->findAll();
        $this->request('/ageCategories/' . base_convert(md5(uniqid()), 11, 10), 'GET', 404);
    }

    /**
     * @dataProvider providerAgeCategoriesResponseFields
     */
    public function testAgeCategoriesResponseFields($field)
    {
        $client = $this->getClient();
        $crawler = $client->request('GET', '/ageCategories');
        $this->assertContains($field, $client->getResponse()->getContent());
    }

    public function providerAgeCategoriesResponseFields()
    {
        return [
            ['ageCategories'],
            ['name'],
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