<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
    }

    public function test_user_can_login()
    {
        $response = $this->post('/login', [
            'email' => 'member@demo.local',
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/dashboard');
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        $response = $this->post('/login', [
            'email' => 'member@demo.local',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    public function test_user_can_logout()
    {
        $user = User::where('email', 'member@demo.local')->first();
        
        $this->actingAs($user)
            ->post('/logout')
            ->assertRedirect('/');
        
        $this->assertGuest();
    }

    public function test_superadmin_can_login()
    {
        $response = $this->post('/login', [
            'email' => 'admin@urlshortener.local',
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
    }
}
