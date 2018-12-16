<?php

use Illuminate\Database\Seeder;

class JSONDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actions')->insert([
            [
                'id' => '1',
                'description' => 'A photograph representing the Automotive category'
            ],
            [
                'id' => '2',
                'description' => 'A photograph representing the Baby Products category'
            ],
            [
                'id' => '3',
                'description' => 'A photograph representing the Beauty category'
            ],
            [
                'id' => '4',
                'description' => 'A photograph representing the Books category'
            ],
            [
                'id' => '5',
                'description' => 'A photograph representing the Business, Industry and Science category'
            ],
            [
                'id' => '6',
                'description' => 'A photograph representing the CDs and Vinyl category'
            ],
            [
                'id' => '7',
                'description' => 'A photograph representing the Clothing category'
            ],
            [
                'id' => '8',
                'description' => 'A photograph representing the Computer and Accessories category'
            ],
            [
                'id' => '9',
                'description' => 'A photograph representing the DIY and Tools category'
            ],
            [
                'id' => '10',
                'description' => 'A photograph representing the DVD and Blu-ray category'
            ],
        ]);
    }
}
