<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserLogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_logout(): void
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();

        $response = $this->post('/logout');
        $response->assertRedirect('/');

        $this->assertGuest();
    }
}
