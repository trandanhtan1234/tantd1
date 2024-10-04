<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('values')->delete();
        DB::table('values')->insert([
            ['id'=>1, 'value'=>'S', 'attr_id'=>1],
            ['id'=>2, 'value'=>'M', 'attr_id'=>1],
            ['id'=>3, 'value'=>'L', 'attr_id'=>1],
            ['id'=>4, 'value'=>'Red', 'attr_id'=>2],
            ['id'=>5, 'value'=>'Blue', 'attr_id'=>2],
            ['id'=>6, 'value'=>'Black', 'attr_id'=>2]
        ]);
    }
}
