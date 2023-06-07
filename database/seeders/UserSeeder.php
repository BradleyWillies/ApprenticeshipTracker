<?php

namespace Database\Seeders;

use App\Models\Apprentice;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Manager::factory()->count(5)->create();
        Apprentice::factory()->create([
            'candidate_number' => '123456'
        ]);
        Apprentice::factory()->count(10)->create();
    }
}
