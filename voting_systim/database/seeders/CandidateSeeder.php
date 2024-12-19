<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('candidates')->insert([
            [
                'name' => 'Người Bầu Cử 1',
                'program' => 'Thông tin chi tiết về người bầu cử 1...',
                'vote_count' => 10,
                'start_time' => Carbon::now()->subDays(1), // Thời gian bắt đầu 1 ngày trước
                'end_time' => Carbon::now()->addDays(1), // Thời gian kết thúc 1 ngày sau
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Người Bầu Cử 2',
                'program' => 'Thông tin chi tiết về người bầu cử 2...',
                'vote_count' => 15,
                'start_time' => Carbon::now()->subDays(1), 
                'end_time' => Carbon::now()->addDays(2),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Người Bầu Cử 3',
                'program' => 'Thông tin chi tiết về người bầu cử 3...',
                'vote_count' => 20,
                'start_time' => Carbon::now()->subDays(2),
                'end_time' => Carbon::now()->addDays(3),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
