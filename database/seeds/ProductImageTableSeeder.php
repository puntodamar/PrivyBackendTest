<?php

use Illuminate\Database\Seeder;

class ProductImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_image')->insert([
            [
                'product_id' => 1,
                'image_id'   => 1
            ],
            [
                'product_id' => 1,
                'image_id'   => 2
            ]
        ]);
    }
}
