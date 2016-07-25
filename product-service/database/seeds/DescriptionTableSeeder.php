<?php

use Illuminate\Database\Seeder;

class DescriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s', strtotime('now'));
        for($ii = 0; $ii < 5; $ii++)
        {
            DB::table('descriptions')->insert([
                'product_id'  => 1,
                'body'        => uniqid(),
                'created_at'  => $now,
                'updated_at'  => $now,
            ]);
        }
    }
}
