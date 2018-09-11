<?php

namespace Tests\Feature\Login;

use Illuminate\Support\Facades\Session;
use Tests\AbstractTestCase;

class LoginPageTest extends AbstractTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginTest()
    {
        $response = $this->call('get', '/login');
        $response->assertRedirect('/home');

        Session::start();
        foreach ($this->user::all() as $user) {
            $response = $this->call(
                'POST', '/login', [
                    'email' => $user->email,
                    'password' => 'secret',
                    '_token' => csrf_token(),
                ]
            );
            $response->assertRedirect('/home');
            $this->assertEquals(302, $response->getStatusCode());
        }
    }
}
