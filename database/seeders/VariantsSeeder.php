<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('variant')->delete();
        DB::table('variant')->insert([
            ['id'=>1,'price'=>100000,'product_id'=>1],
            ['id'=>2,'price'=>200000,'product_id'=>1],

            ['id'=>3,'price'=>300000,'product_id'=>2],
            ['id'=>4,'price'=>400000,'product_id'=>2],

            ['id'=>5,'price'=>500000,'product_id'=>3],
            ['id'=>6,'price'=>600000,'product_id'=>3],

            ['id'=>7,'price'=>700000,'product_id'=>4],
            ['id'=>8,'price'=>800000,'product_id'=>4],

            ['id'=>9,'price'=>900000,'product_id'=>5],
            ['id'=>10,'price'=>1000000,'product_id'=>5],

            ['id'=>11,'price'=>500000,'product_id'=>6],
            ['id'=>12,'price'=>550000,'product_id'=>6],

            ['id'=>13,'price'=>400000,'product_id'=>7],
            ['id'=>14,'price'=>400000,'product_id'=>7],
            
            ['id'=>15,'price'=>600000,'product_id'=>8]
        ]);
    }
}
