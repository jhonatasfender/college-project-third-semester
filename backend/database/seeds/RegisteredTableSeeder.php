<?php

use Illuminate\Database\Seeder;

class RegisteredTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produts = factory(\App\Models\Registered::class)
            ->times(10)->create();
    }
}
