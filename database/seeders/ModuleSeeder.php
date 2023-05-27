<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get block id's
        $block0a = Block::where('name', '0A')->first();
        $block0b = Block::where('name', '0B')->first();
        $block1a = Block::where('name', '1A')->first();
        $block1b = Block::where('name', '1B')->first();
        $block2 = Block::where('name', '2')->first();
        $block3a = Block::where('name', '3A')->first();
        $block3b = Block::where('name', '3B')->first();
        $block4 = Block::where('name', '4')->first();

        // create all modules
        $modules = [
            ['code' => 'DC1CSN', 'title' => 'Computer Systems and Networks', 'block_id' => $block0a->id],
            ['code' => 'DC1SDV', 'title' => 'Systems Development', 'block_id' => $block0a->id],
            ['code' => 'DC1IAP', 'title' => 'Internet Applications', 'block_id' => $block0b->id],
            ['code' => 'BN1IBO', 'title' => 'Introductions to Business Organisations', 'block_id' => $block0b->id],
            ['code' => 'DC1PRP', 'title' => 'Professional Practice', 'block_id' => $block0b->id],
            ['code' => 'BS2IBE', 'title' => 'Introduction to Business Economics', 'block_id' => $block1a->id],
            ['code' => 'BN2BUA', 'title' => 'Business Analytics', 'block_id' => $block1a->id],
            ['code' => 'DC2MCP', 'title' => 'Mathematics for Computing Professionals', 'block_id' => $block1a->id],
            ['code' => 'DC2DSA', 'title' => 'Data Structures and Algorithms with Java', 'block_id' => $block1a->id],
            ['code' => 'DC2SAN', 'title' => 'System and Software Analysis', 'block_id' => $block1b->id],
            ['code' => 'BF2ITA', 'title' => 'Introduction to Accounting', 'block_id' => $block1b->id],
            ['code' => 'DC2SEN', 'title' => 'Software Engineering', 'block_id' => $block1b->id],
            ['code' => 'DC2PLC', 'title' => 'Programming Language Concepts', 'block_id' => $block1b->id],
            ['code' => 'DC2PSA', 'title' => 'Professional and Social Aspects of Computing', 'block_id' => $block2->id],
            ['code' => 'DC2HCI', 'title' => 'Human- Computer Interaction', 'block_id' => $block2->id],
            ['code' => 'DC2TPR', 'title' => 'Team Project', 'block_id' => $block2->id],
            ['code' => 'DC3ECS', 'title' => 'Enterprise Computing Strategies', 'block_id' => $block3a->id],
            ['code' => 'DC3ADG', 'title' => 'Advanced Database Systems and Geographic Information Systems', 'block_id' => $block3a->id],
            ['code' => 'LBM3MP', 'title' => 'Managing People and Team Leading', 'block_id' => $block3a->id],
            ['code' => 'DC3MLN', 'title' => 'Machine Learning', 'block_id' => $block3a->id],
            ['code' => 'BN3EMC', 'title' => 'Effective Management Consultancy', 'block_id' => $block3a->id],
            ['code' => 'BN3INO', 'title' => 'International Operations', 'block_id' => $block3a->id],
            ['code' => 'DC3CIN', 'title' => 'Computational Intelligence', 'block_id' => $block3a->id],
            ['code' => 'DC3MDV', 'title' => 'Mobile Development', 'block_id' => $block3a->id],
            ['code' => 'DC3AWD', 'title' => 'Advanced Web Development', 'block_id' => $block3a->id],
            ['code' => 'DC3SPM', 'title' => 'Software Project Management', 'block_id' => $block3b->id],
            ['code' => 'BM3STM', 'title' => 'Strategic Management', 'block_id' => $block3b->id],
            ['code' => 'DC3IDG', 'title' => 'Interaction Design', 'block_id' => $block3b->id],
            ['code' => 'DC3ISC', 'title' => 'Information Security', 'block_id' => $block4->id],
            ['code' => 'DC3DMN', 'title' => 'Data Mining', 'block_id' => $block4->id],
            ['code' => 'DC3IPR', 'title' => 'Individual Project', 'block_id' => $block4->id],
        ];

        foreach($modules as $module){
            Module::factory()->create($module);
        }
    }
}
