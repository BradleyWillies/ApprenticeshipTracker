<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    // reset database after testing
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_apprentice_can_register(): void
    {
        $response = $this->post('/register', [
            'role' => 'apprentice',
            'candidate_number' => fake()->randomNumber(6, true),
            'name' => 'Test User',
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();

        $response->assertRedirect(route('apprentice_dashboard'));
    }

    public function test_new_manager_can_register(): void
    {
        $response = $this->post('/register', [
            'role' => 'manager',
            'name' => 'Test User',
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('manager_dashboard'));
    }
}
