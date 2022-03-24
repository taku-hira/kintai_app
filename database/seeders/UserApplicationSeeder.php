<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('leave_applications')->insert([
            [
                'user_id' => 1,
                'request_date' => '2022-03-29',
                'user_comment' => '休みます',
                'admin_comment' => '',
                'approval_flag' => 0,
                'created_at' => '2022-03-05 00:00:00',
            ],
            [
                'user_id' => 1,
                'request_date' => '2022-03-30',
                'user_comment' => '休みます',
                'admin_comment' => '了解',
                'approval_flag' => 1,
                'created_at' => '2022-03-06 00:00:00',
            ],
            [
                'user_id' => 1,
                'request_date' => '2022-03-31',
                'user_comment' => '休みます',
                'admin_comment' => '修正してください',
                'approval_flag' => 2,
                'created_at' => '2022-03-07 00:00:00',
            ],
        ]);
    }
}
