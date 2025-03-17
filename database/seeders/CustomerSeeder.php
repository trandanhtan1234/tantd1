<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customer')->delete();
        DB::table('customer')->insert([
            ['id'=>1, 'email'=>'trandanhtan1234@gmail.com', 'password'=>bcrypt('123456'), 'full'=>'Tan Tran', 'address'=>'Hanoi', 'phone'=>'0977892214', 'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26']
        ]);
    }
}
