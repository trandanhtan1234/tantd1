<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category')->delete();
        DB::table('category')->insert([
            ['id'=>1, 'name'=>'Male', 'slug'=>'male', 'parent'=>0],
            ['id'=>2, 'name'=>'Female', 'slug'=>'female', 'parent'=>0],
            ['id'=>3, 'name'=>'Male Shirt', 'slug'=>'male-shirt', 'parent'=>1],
            ['id'=>4, 'name'=>'Male Pants', 'slug'=>'male-pants', 'parent'=>1],
            ['id'=>5, 'name'=>'Female Shirt', 'slug'=>'female-shirt', 'parent'=>2],
            ['id'=>6, 'name'=>'Female Pants', 'slug'=>'female-pants', 'parent'=>2]
        ]);
    }
}
