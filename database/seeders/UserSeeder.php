<?php

namespace Database\Seeders;

use App\Models\Apprentice;
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
        // create user which will be an apprentice
        $apprenticeUser = User::factory()->create([
            'name' => 'Bradley Willies',
            'email' => '1@1.com',
            'password' => '$2y$10$58oipjZ6xuhCjy6lo31yr.u6BYISJd3nJfo.bgqm8KRWTxG.K5kCy' // 11111111
        ]);

        // create apprentice associated with user above
        Apprentice::factory()->create([
            'user_id' => $apprenticeUser->id,
        ]);
    }
}
