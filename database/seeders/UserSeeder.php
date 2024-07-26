<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            ['id'=> 1, 'email'=> 'admin@gmail.com', 'password'=> bcrypt('123456'), 'full'=>'vietpro', 'address'=>'Thường Tín', 'phone'=>'0356653301', 'level'=>1],
            ['id'=> 2, 'email'=> 'zimpro@gmail.com','password'=> bcrypt('123456'), 'full'=>'Nguyễn Thế Vũ', 'address'=>'Bắc Giang', 'phone'=>'0356654487','level'=> 2],
            ['id'=> 3, 'email'=> 'phucnguyenthe0809@gmail.com','password'=> bcrypt('123456'), 'full'=>'Nguyễn Thế Phúc', 'address'=>'Huế', 'phone'=>'0352264487','level'=> 1],
            ['id'=> 4, 'email'=> 'zimpro9x@gmail.com','password'=> bcrypt('123456'), 'full'=>'Nguyễn Văn Công', 'address'=>'Nghệ An', 'phone'=>'0357846659','level'=> 2]
        ]);
    }
}
