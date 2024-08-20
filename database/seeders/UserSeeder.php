<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            ['id'=> 1, 'email'=> 'admin@gmail.com', 'password'=> bcrypt('Ffca!2ed97'), 'full'=>'vietpro', 'address'=>'Thường Tín', 'phone'=>'0356653301', 'level'=>1,'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26'],
            ['id'=> 2, 'email'=> 'zimpro@gmail.com','password'=> bcrypt('Ffca!2ed97'), 'full'=>'Nguyễn Thế Vũ', 'address'=>'Bắc Giang', 'phone'=>'0356654487','level'=>2,'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26'],
            ['id'=> 3, 'email'=> 'phucnguyenthe0809@gmail.com','password'=> bcrypt('Ffca!2ed97'), 'full'=>'Nguyễn Thế Phúc', 'address'=>'Huế', 'phone'=>'0352264487','level'=>1,'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26'],
            ['id'=> 4, 'email'=> 'zimpro9x@gmail.com','password'=> bcrypt('Ffca!2ed97'), 'full'=>'Nguyễn Văn Công', 'address'=>'Nghệ An', 'phone'=>'0357846659','level'=>2,'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26'],
            ['id'=> 5, 'email'=> 'trandanhtan1234@gmail.com','password'=> bcrypt('Ffca!2ed97'), 'full'=>'Trần Danh Tân', 'address'=>'Gia Lâm', 'phone'=>'0977892214','level'=>2,'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26'],
            ['id'=> 6, 'email'=> 'tantd@gmail.com','password'=> bcrypt('Ffca!2ed97'), 'full'=>'Trần Duy Tân', 'address'=>'Trâu Quỳ', 'phone'=>'0977892215','level'=>2,'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26'],
            ['id'=> 7, 'email'=> 'kenwayjedward@gmail.com','password'=> bcrypt('Ffca!2ed97'), 'full'=>'Edward Kenway', 'address'=>'Thanh Xuân', 'phone'=>'0977892216','level'=>1,'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26'],
            ['id'=> 8, 'email'=> 'kenwayconnor@gmail.com','password'=> bcrypt('Ffca!2ed97'), 'full'=>'Connor Kenway', 'address'=>'Thanh Miện', 'phone'=>'0977892211','level'=>2,'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26'],
            ['id'=> 9, 'email'=> 'kenwayhaytham@gmail.com','password'=> bcrypt('Ffca!2ed97'), 'full'=>'Haytham Kenway', 'address'=>'Lương Thế Vinh', 'phone'=>'0977892213','level'=>2,'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26'],
            ['id'=> 10, 'email'=> 'fryejacob@gmail.com','password'=> bcrypt('Ffca!2ed97'), 'full'=>'Jacob Frye', 'address'=>'London', 'phone'=>'0977892218','level'=>2,'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26'],
            ['id'=> 11, 'email'=> 'fryeevie@gmail.com','password'=> bcrypt('Ffca!2ed97'), 'full'=>'Evie Frye', 'address'=>'London', 'phone'=>'0977892219','level'=>2,'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26'],
            ['id'=> 12, 'email'=> 'dorianarno@gmail.com','password'=> bcrypt('Ffca!2ed97'), 'full'=>'Arno Dorian', 'address'=>'Versailles', 'phone'=>'0977892220','level'=>2,'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26'],
            ['id'=> 13, 'email'=> 'auditoreezio@gmail.com','password'=> bcrypt('Ffca!2ed97'), 'full'=>'Ezio Auditore', 'address'=>'Firenze', 'phone'=>'0977892221','level'=>1,'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26'],
            ['id'=> 14, 'email'=> 'auditoreclaudia@gmail.com','password'=> bcrypt('Ffca!2ed97'), 'full'=>'Claudia Auditore', 'address'=>'Firenze', 'phone'=>'0977892222','level'=>2,'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26'],
            ['id'=> 15, 'email'=> 'leecharles@gmail.com','password'=> bcrypt('Ffca!2ed97'), 'full'=>'Charles Lee', 'address'=>'Boston', 'phone'=>'0977892223','level'=>2,'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26'],
            ['id'=> 16, 'email'=> 'johnsonwill@gmail.com','password'=> bcrypt('Ffca!2ed97'), 'full'=>'William Johnson', 'address'=>'Boston', 'phone'=>'0977892224','level'=>2,'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26'],
            ['id'=> 17, 'email'=> 'pitcairnjohn@gmail.com','password'=> bcrypt('Ffca!2ed97'), 'full'=>'John Pitcairn', 'address'=>'Boston', 'phone'=>'0977892225','level'=>2,'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26'],
            ['id'=> 18, 'email'=> 'hickeythomas@gmail.com','password'=> bcrypt('Ffca!2ed97'), 'full'=>'Thomas Hickey', 'address'=>'Boston', 'phone'=>'0977892226','level'=>2,'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26'],
            ['id'=> 19, 'email'=> 'churchben@gmail.com','password'=> bcrypt('Ffca!2ed97'), 'full'=>'Benjamin Church', 'address'=>'Boston', 'phone'=>'0977892227','level'=>2,'created_at'=>'2024-08-13 22:14:26', 'updated_at'=>'2024-08-13 22:14:26'],
        ]);
    }
}
