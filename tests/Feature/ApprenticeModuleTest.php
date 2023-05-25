<?php

namespace Tests\Feature;

use App\Models\ApprenticeModule;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ApprenticeModuleTest extends TestCase
{
    // reset database after testing
    use RefreshDatabase;

    public function test_it_updates_apprentice_module_with_valid_data()
    {
        // Seed database
        Artisan::call('db:seed');

        // Import module grades
        Artisan::call('import:module-grades');

        // Create an ApprenticeModule
        $apprenticeModule = ApprenticeModule::first();

        // Create a user which is linked to that module
        $user = $apprenticeModule->apprentice->user;

        // Create form data with valid inputs
        $formData = [
            'start_date' => '2021-01-01',
            'end_date' => '2021-06-01',
            'grade' => 100,
        ];

        // Set the user as the current session user and send an update request
        $response = $this->actingAs($user)->patch(route('apprentice_module.update', ['apprenticeModule' => $apprenticeModule]), $formData);

        // Assert the response status code
        $response->assertStatus(302);

        // Assert that the ApprenticeModule model was updated in the database
        $this->assertDatabaseHas('apprentice_module', [
            'id' => $apprenticeModule->id,
            'start_date' => $formData['start_date'],
            'end_date' => $formData['end_date'],
            'grade' => $formData['grade'],
        ]);
    }

    public function test_it_fails_to_update_apprentice_module_with_invalid_data()
    {
        // Refresh the database
        Artisan::call('migrate:refresh');

        // Seed database
        Artisan::call('db:seed');

        // Import module grades
        Artisan::call('import:module-grades');

        // Create an ApprenticeModule
        $apprenticeModule = ApprenticeModule::first();

        // Create a user which is linked to that module
        $user = $apprenticeModule->apprentice->user;

        // Generate form data with invalid inputs
        $formData = [
            'start_date' => '2021-05-01',
            'end_date' => '2020-05-01',  // Invalid end date (before start date)
            'grade' => 101,              // Invalid grade (beyond allowed range)
        ];

        // Send a PUT request to the update route
        $response = $this->actingAs($user)->patch(route('apprentice_module.update', ['apprenticeModule' => $apprenticeModule]), $formData);

        // Assert the response status code
        $response->assertStatus(302);

        // Assert that the ApprenticeModule model was not updated in the database
        $this->assertDatabaseMissing('apprentice_module', [
            'id' => $apprenticeModule->id,
            'start_date' => $formData['start_date'],
            'end_date' => $formData['end_date'],
            'grade' => $formData['grade'],
        ]);
    }
}
