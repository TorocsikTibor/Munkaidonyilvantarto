<?php

namespace App\Services;

use Illuminate\Support\Carbon;

class TimerService
{
    public function calculateTimeDifference(string $start, string $end)
    {
        $startTimer = Carbon::parse($start);
        $endTimer = Carbon::parse($end);

        return $endTimer->diff($startTimer)->format('%d nap %H óra %i perc %s mp');;
    }
}
