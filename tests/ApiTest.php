<?php

namespace tests;

class ApiTest extends TestCase
{
    public function testUserDetails()
    {
        $expected = [
            'data' => [
                'user_name' => 'john doe',
                'address' => '12 Street, Brisbane, Australia',
                'membership' => 'Premium Membership',
            ],
        ];
        $this->json('GET', '/api/self')->seeJson($expected);
    }

    public function testUserLicenses()
    {
        $this->json('GET', '/api/users/1/licences');
        $resultArray = json_decode($this->response, true);
        $this->assertEquals(1, count($resultArray['data']));
        $firstResult = $resultArray['data'][0];
        $this->assertEquals('john doe', $firstResult['user_name']);
        $this->assertEquals('Premium Membership', $firstResult['product']);
        $this->assertNotNull($firstResult['licence_key']);
    }
}
