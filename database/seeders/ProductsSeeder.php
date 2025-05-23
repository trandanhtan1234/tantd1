<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->delete();
        DB::table('products')->insert([
            ['id'=>1, 'code'=>'ABC1234', 'name'=>'Default Shirt', 'slug'=>'default-shirt', 'price'=>100000, 'featured'=>1, 'status'=>1, 'description'=>'This is a default shirt', 'img'=>'base/img/A/o/ao-nay-dep-lam.jpg', 'category_id'=>1],
            ['id'=>2, 'code'=>'ABC1235', 'name'=>'Ao Nu Phoi Vien', 'slug'=>'ao-nu-phoi-vien', 'price'=>60000, 'featured'=>1, 'status'=>0, 'description'=>'This is something else', 'img'=>'base/img/A/o/ao-nu-phoi-vien.jpg', 'category_id'=>5],
            ['id'=>3, 'code'=>'ABC1231', 'name'=>'Áo Sơ Mi Có Cổ Đúc', 'slug'=>'ao-so-mi-co-co-duc', 'price'=>70000, 'featured'=>0, 'status'=>1, 'description'=>'This is something else', 'img'=>'base/img/A/o/ao-so-mi-caro-xam-xanh.png', 'category_id'=>6],
            ['id'=>4, 'code'=>'ABC1233', 'name'=>'Áo sơ mi caro xám Xanh', 'slug'=>'ao-so-mi-caro-xam-xanh', 'price'=>80000, 'featured'=>0, 'status'=>1, 'description'=>'This is something else', 'img'=>'base/img/D/e/default-shirt.jpg', 'category_id'=>2],
            ['id'=>5, 'code'=>'ABC1236', 'name'=>'Áo Sơ Mi Hoạ Tiết Đen', 'slug'=>'ao-so-mi-hoa-tiet-den', 'price'=>90000, 'featured'=>0, 'status'=>1, 'description'=>'This is something else', 'img'=>'base/img/N/i/nice-shirt-ever.jpg', 'category_id'=>2],
            ['id'=>6, 'code'=>'ABC1238', 'name'=>'Áo Sơ Mi Trắng Kem', 'slug'=>'ao-so-mi-trang-kem', 'price'=>100000, 'featured'=>1, 'status'=>1, 'description'=>'This is something else', 'img'=>'base/img/Q/u/quan-kaki-do-nam.jpg', 'category_id'=>2],
            ['id'=>7, 'code'=>'ABC1237', 'name'=>'Quần kaki Đỏ Nam', 'slug'=>'quan-kaki-do-nam', 'price'=>110000, 'featured'=>1, 'status'=>1, 'description'=>'This is something else', 'img'=>'base/img//Q/u/quan-nay-dep-lam.jpg', 'category_id'=>3],
            ['id'=>8, 'code'=>'ABC1239', 'name'=>'Quần kaki Xám', 'slug'=>'quan-kaki-xam', 'price'=>120000, 'featured'=>1, 'status'=>1, 'description'=>'This is something else', 'img'=>'base/img/W/h/white-shirt-manager.jpg', 'category_id'=>3],
        ]);
    }
}
