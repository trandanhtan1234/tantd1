<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariantValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('variant_value')->delete();
        DB::table('variant_value')->insert([
            ['variant_id'=>1,'value_id'=>1],
            ['variant_id'=>1,'value_id'=>4],
            ['variant_id'=>2,'value_id'=>2],
            ['variant_id'=>2,'value_id'=>4],

            ['variant_id'=>3,'value_id'=>2],
            ['variant_id'=>3,'value_id'=>5],
            ['variant_id'=>4,'value_id'=>3],
            ['variant_id'=>4,'value_id'=>5],

            ['variant_id'=>5,'value_id'=>3],
            ['variant_id'=>5,'value_id'=>5],
            ['variant_id'=>6,'value_id'=>3],
            ['variant_id'=>6,'value_id'=>6],

            ['variant_id'=>7,'value_id'=>2],
            ['variant_id'=>7,'value_id'=>4],
            ['variant_id'=>8,'value_id'=>2],
            ['variant_id'=>8,'value_id'=>6],

            ['variant_id'=>9,'value_id'=>2],
            ['variant_id'=>9,'value_id'=>4],
            ['variant_id'=>10,'value_id'=>2],
            ['variant_id'=>10,'value_id'=>5],

            ['variant_id'=>11,'value_id'=>2],
            ['variant_id'=>11,'value_id'=>5],
            ['variant_id'=>12,'value_id'=>2],
            ['variant_id'=>12,'value_id'=>6],

            ['variant_id'=>13,'value_id'=>2],
            ['variant_id'=>13,'value_id'=>6],
            ['variant_id'=>14,'value_id'=>3],
            ['variant_id'=>14,'value_id'=>6],

            ['variant_id'=>15,'value_id'=>1],
            ['variant_id'=>15,'value_id'=>4]
        ]);
    }
}
