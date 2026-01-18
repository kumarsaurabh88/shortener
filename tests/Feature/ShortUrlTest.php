<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Role;
use App\Models\ShortUrl;
use App\Models\User;
use Tests\TestCase;

class ShortUrlTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
    }

    public function test_admin_cannot_create_short_urls()
    {
        $admin = User::where('email', 'admin@demo.local')->first();
        
        $this->actingAs($admin)
            ->post('/urls', ['original_url' => 'https://example.com'])
            ->assertRedirect('/');
    }

    public function test_superadmin_cannot_create_short_urls()
    {
        $superAdmin = User::where('email', 'admin@urlshortener.local')->first();
        
        $this->actingAs($superAdmin)
            ->post('/urls', ['original_url' => 'https://example.com'])
            ->assertRedirect('/');
    }

    public function test_member_can_create_short_urls()
    {
        $member = User::where('email', 'member@demo.local')->first();
        
        $response = $this->actingAs($member)
            ->post('/urls', ['original_url' => 'https://example.com/very/long/url']);
        
        $this->assertDatabaseHas('short_urls', ['original_url' => 'https://example.com/very/long/url']);
    }

    public function test_admin_can_see_urls_not_from_their_company()
    {
        $admin = User::where('email', 'admin@demo.local')->first();
        $member = User::where('email', 'member@demo.local')->first();

        // Create URL from member
        ShortUrl::create([
            'short_code' => 'abc123',
            'original_url' => 'https://example.com',
            'company_id' => $admin->company_id,
            'created_by' => $member->id,
        ]);

        $this->actingAs($admin)
            ->get('/urls')
            ->assertStatus(200);
    }

    public function test_member_can_see_urls_not_created_by_them()
    {
        $member = User::where('email', 'member@demo.local')->first();
        $admin = User::where('email', 'admin@demo.local')->first();

        // Create URL from admin
        ShortUrl::create([
            'short_code' => 'def456',
            'original_url' => 'https://example.com',
            'company_id' => $admin->company_id,
            'created_by' => $admin->id,
        ]);

        $response = $this->actingAs($member)
            ->get('/urls');
        
        $this->assertContains('def456', $response->getContent());
    }

    public function test_short_urls_are_not_publicly_resolvable_without_code()
    {
        $response = $this->get('/s/nonexistent');
        $this->assertStatus(404);
    }

    public function test_short_url_redirects_to_original()
    {
        $member = User::where('email', 'member@demo.local')->first();

        $url = ShortUrl::create([
            'short_code' => 'testcode',
            'original_url' => 'https://example.com/destination',
            'company_id' => $member->company_id,
            'created_by' => $member->id,
        ]);

        $response = $this->get('/s/testcode');
        
        $this->assertTrue($response->isRedirect());
        $this->assertEquals('https://example.com/destination', $response->getTargetUrl());
    }

    public function test_member_cannot_delete_urls_created_by_others()
    {
        $member = User::where('email', 'member@demo.local')->first();
        $admin = User::where('email', 'admin@demo.local')->first();

        $url = ShortUrl::create([
            'short_code' => 'xyz789',
            'original_url' => 'https://example.com',
            'company_id' => $admin->company_id,
            'created_by' => $admin->id,
        ]);

        $this->actingAs($member)
            ->delete('/urls/' . $url->id)
            ->assertRedirect('/');
        
        $this->assertDatabaseHas('short_urls', ['id' => $url->id]);
    }
}
