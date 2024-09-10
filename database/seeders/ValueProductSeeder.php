<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ValueProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('values_products')->delete();
        DB::table('values_products')->insert([
            ['product_id'=>1,'value_id'=>1],
            ['product_id'=>1,'value_id'=>2],
            ['product_id'=>1,'value_id'=>4],

            ['product_id'=>2,'value_id'=>2],
            ['product_id'=>2,'value_id'=>3],
            ['product_id'=>2,'value_id'=>5],

            ['product_id'=>3,'value_id'=>3],
            ['product_id'=>3,'value_id'=>5],
            ['product_id'=>3,'value_id'=>6],

            ['product_id'=>4,'value_id'=>2],
            ['product_id'=>4,'value_id'=>4],
            ['product_id'=>4,'value_id'=>6],

            ['product_id'=>5,'value_id'=>2],
            ['product_id'=>5,'value_id'=>4],
            ['product_id'=>5,'value_id'=>5],

            ['product_id'=>6,'value_id'=>2],
            ['product_id'=>6,'value_id'=>5],
            ['product_id'=>6,'value_id'=>6],
            
            ['product_id'=>7,'value_id'=>2],
            ['product_id'=>7,'value_id'=>3],
            ['product_id'=>7,'value_id'=>6],
            
            ['product_id'=>8,'value_id'=>1],
            ['product_id'=>8,'value_id'=>4]
        ]);
    }
}
