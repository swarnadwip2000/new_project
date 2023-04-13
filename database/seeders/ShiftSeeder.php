<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shifts = [
            '9 AM' => '6 PM',
            '10 AM' => '7 AM',
            '11 AM' => '8 AM',
            '12 AM' => '9 AM',
            '1 PM' => '10 PM',
            '2 PM' => '11 PM',
            '3 PM' => '12 AM',
        ];

        foreach ($shifts as $start => $end) {
            $shift_time = new Shift();
            $shift_time->start_time = $start;
            $shift_time->end_time = $end;
            $shift_time->save();
        }
    }
}
