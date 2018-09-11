<?php

namespace Tests\Feature\Login;

use Tests\AbstractTestCase;

class UserControllerTest extends AbstractTestCase
{
    public function testUserControllerIndexTest()
    {
        $response = $this->get('/user');
        $response->assertStatus(200);
    }

}
