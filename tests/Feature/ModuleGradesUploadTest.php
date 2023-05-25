<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ModuleGradesUploadTest extends TestCase
{
    // reset database after testing
    use RefreshDatabase;

    public function test_it_imports_modules_and_grades_from_csv_file()
    {
        // Refresh the database
        Artisan::call('migrate:refresh');

        // Seed database
        Artisan::call('db:seed');

        // Import module grades
        Artisan::call('import:module-grades');

        // Assert that the ApprenticeModule model was updated in the database
        $this->assertDatabaseHas('apprentice_module', [
            'apprentice_id' => '1',
            'module_id' => '1',
            'grade' => '95',
        ]);

        // Assert that the ApprenticeModule model was updated in the database
        $this->assertDatabaseHas('apprentice_module', [
            'apprentice_id' => '1',
            'module_id' => '5',
            'grade' => '68',
        ]);
    }
}
