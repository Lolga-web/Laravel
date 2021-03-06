<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert($this->getData());
    }

    private function getData() 
    {
        $data = [
            [
                'title' => 'Спорт',
                'slug' => 'sport'
            ],
            [
                'title' => 'Политика',
                'slug' => 'politics'
            ]
        ];

        return $data;
    }
}
