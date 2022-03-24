<?php

namespace App\Util;

use App\Models\Shift;
use Carbon\Carbon;

class Calculate
{
    public static function calcWorkingHours ($start_time, $end_time)
    {
        $start_time = new Carbon($start_time);
        $end_time = new Carbon($end_time);

        $start_unix = $start_time->format('U');
        $end_unix = $end_time->format('U');

        $unix_working_hours = $end_unix - $start_unix;

        $working_hours = new Carbon($unix_working_hours);

        return $working_hours->format('H:i');
    }

    public static function calcOverTime($shift_end, $end_time, $date)
    {
        if ($end_time) {
            $date = new Carbon($date);
        $date = $date->format('Y-m-d');

        $shift_end = new Carbon($date . $shift_end);
        $end_time = new Carbon($end_time);


        $shift_end_unix = $shift_end->format('U');
        $end_time_unix = $end_time->format('U');

        $over_time_unix = $end_time_unix - $shift_end_unix;
        $over_time = new Carbon($over_time_unix);

        return $over_time->format('H:i');
        } else {
            return;
        }

    }
}
