<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            'name'          => 'Victor SHP 9300 DE / SH 9300 DE / SHP 9300 DE',
            'description'   => 'Continually promote end-to-end process improvements for interactive alignments. Proactively harness collaborative benefits rather than virtual technologies.',
            'enable'        => true
        ]);
    }
}
