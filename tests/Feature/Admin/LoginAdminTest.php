<?php

namespace Tests\Feature\Admin;

use App\Http\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginAdminTest extends TestCase
{
    use RefreshDatabase;
    /** @test */

    public function check_email_and_password()  //validation
    {
        $this->json('POST', 'api/loginAdmin', [
            'email' => null,
            'password' => null,
        ])->assertStatus(422)
            ->assertjson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "email" => [
                        0 => "email is required",
                    ],
                    "password" => [
                        0 => "password is required",
                    ],
                ],

            ]);
    }

    /** @test */
    public function login_admin()
    {
        $admin = $this->create('Admin', [
            'email' => 'mohamed@gmail.com',
            'password' => bcrypt('123123')
        ]);
        $loginData = ['email' => 'mohamed@gmail.com', 'password' => '123123'];
        $response = $this->json('POST', 'api/loginAdmin', $loginData, ['Accept' => 'application/json']);
        $response->assertStatus(200)
            ->assertJsonStructure([     // not add here any another value only in AdminResource
                'id', 'name', 'email',
            ]);

    }
}
