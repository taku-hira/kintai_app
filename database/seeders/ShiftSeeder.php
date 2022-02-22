<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shifts')->insert([
            [
                'shift_name' => '8:00-17:00',
                'shift_start' => '8:00',
                'shift_end' => '17:00',
            ],
            [
                'shift_name' => '休み',
                'shift_start' => null,
                'shift_end' => null,
            ],
        ]);
    }
}
