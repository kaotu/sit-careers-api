<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobPositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job_positions_seed = [
            'Software Engineer',
            'UX/UI',
            'Infrastructure'
        ];
        $date = Carbon::today();
        for ($i = 0; $i < count($job_positions_seed); $i++){
            DB::table('job_positions')->insert([
                'job_position_id' => Str::uuid(),
                'job_position' => $job_positions_seed[$i],
                'created_at' => $date,
                'updated_at' => $date
            ]);
        }
    }
}
