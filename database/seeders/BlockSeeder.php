<?php

namespace Database\Seeders;

use App\Models\Block;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create all blocks
        $blocks = [
            ['name' => '0A'],
            ['name' => '0B'],
            ['name' => '1A'],
            ['name' => '1B'],
            ['name' => '2'],
            ['name' => '3A'],
            ['name' => '3B'],
            ['name' => '4'],
        ];
        foreach($blocks as $block) {
            Block::factory()->create($block);
        }
    }
}
