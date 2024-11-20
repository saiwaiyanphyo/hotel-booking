<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_api_login_with_invalid_credentials(): void
    {
        $response = $this->postJson('/api/login', [
            'email' => $this->faker->email,
            'password' => $this->faker->password(10),
        ]);

        $response->assertStatus(400)
            ->assertJson([
                "errors" => [
                    "credentials" => "These credentials do not match our records."
                ]
            ]);

        $this->assertDatabaseCount('users', 0);

    }

    public function test_user_api_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'status' => config('helper.user_status.active'),
        ]);
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
            ]);

        $this->assertDatabaseCount('users', 1);

    }

    public function test_user_api_refresh_token(): void
    {
        $user = User::factory()->create([
            'status' => config('helper.user_status.active'),
        ]);
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
            ]);

        $response = $this->postJson('/api/refresh', [], [
            'Authorization' => 'Bearer ' . $response->json('access_token'),
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
            ]);

        $this->assertDatabaseCount('users', 1);

    }

    public function test_user_api_logout(): void
    {
        $user = User::factory()->create([
            'status' => config('helper.user_status.active'),
        ]);
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
            ]);

        $response = $this->postJson('/api/logout', [], [
            'Authorization' => 'Bearer ' . $response->json('access_token'),
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Successfully logged out',
            ]);

        $this->assertDatabaseCount('users', 1);


    }
}
