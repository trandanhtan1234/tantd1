<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category')->delete();
        DB::table('category')->insert([
            ['id'=>1, 'name'=>'Nam', 'slug'=>'nam', 'parent'=>0],
            ['id'=>2, 'name'=>'Nữ', 'slug'=>'nu', 'parent'=>0],
            ['id'=>3, 'name'=>'Áo Nam', 'slug'=>'ao-nam', 'parent'=>1],
            ['id'=>4, 'name'=>'Quần Nam', 'slug'=>'quan-nam', 'parent'=>1],
            ['id'=>5, 'name'=>'Áo Nữ', 'slug'=>'ao-nu', 'parent'=>2],
            ['id'=>6, 'name'=>'Quần Nữ', 'slug'=>'quan-nu', 'parent'=>2]
        ]);
    }
}
