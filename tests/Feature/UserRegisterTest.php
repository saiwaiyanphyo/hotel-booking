<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_api_register_with_password_not_equal(): void
    {
        $name = $this->faker->name;
        $email = $this->faker->email;
        $response = $this->postJson('/api/register', [
            'name' => $name,
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password1',
        ]);

        $response->assertStatus(400)
            ->assertJsonValidationErrors([
                'password'
            ]);

        $this->assertDatabaseCount('users', 0);
    }

    public function test_user_api_register_with_invalid_email(): void
    {
        $name = $this->faker->name;
        $email = 'invalid-email';
        $response = $this->postJson('/api/register', [
            'name' => $name,
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(400)
            ->assertJsonValidationErrors([
                'email'
            ]);

        $this->assertDatabaseCount('users', 0);
    }



//    public function test_user_api_register_with_valid_data(): void
//    {
//        $name = 'Kyaw Zayya';
//        $email = 'kyawzayya.dev@gmail.com';
//        $response = $this->postJson('/api/register', [
//            'name' => $name,
//            'email' => $email,
//            'password' => 'password',
//            'password_confirmation' => 'password',
//
//        ]);
//
//        $response->assertStatus(200)
//            ->assertJson([
//                'message' => 'User registered successfully and waiting for approval.'
//            ]);
//
//        $this->assertDatabaseCount('users', 1);
//
//
//    }
}
