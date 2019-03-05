<?php

use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('image')->insert([
                [
                    'name'      => 'front',
                    'file'      => env('APP_URL').'/images/example-1.png',
                    'enable'    => 1
                ],
                [
                    'name'      => 'side',
                    'file'      => env('APP_URL').'/images/example-2.png',
                    'enable'    => 1
                ]
            ]);
    }
}
