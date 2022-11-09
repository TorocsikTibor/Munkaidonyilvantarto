<?php

namespace App\Services;

use Illuminate\Support\Carbon;

class TimerService
{
    public function calculateTimeDifference(string $start, string $end)
    {
        $startTimer = Carbon::parse($start);
        $endTimer = Carbon::parse($end);

        $totalDuration = $endTimer->diffInSeconds($startTimer);

        return gmdate('H:i:s', $totalDuration);
    }
}
