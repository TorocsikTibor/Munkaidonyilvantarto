<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Task;
use Carbon\CarbonInterval;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TimerService
{
    public function calculateTimeDifference(string $start, string $end)
    {
        $startTimer = Carbon::parse($start);
        $endTimer = Carbon::parse($end);

        return $endTimer->diff($startTimer)->format('%d nap %H óra %i perc %s mp');
    }

    public function getAllTime($tasks)
    {
        $array = [];
            foreach ($tasks as $task) {
                if($task->timer_end != 0) {
                    $startTimer = Carbon::parse($task->timer_start);
                    $endTimer = Carbon::parse($task->timer_end);
                    $getTime = $endTimer->diffInSeconds($startTimer);
                    $array[] = $getTime;
                }
            }
        return CarbonInterval::seconds(array_sum($array))->cascade()->format('%d nap %H óra %i perc %s mp');
    }

    public function getUserTime($user, $tasks)
    {
        $array = [];
            foreach ($tasks as $task) {
                if($task->timer_end != 0 && $task->user_id === $user) {
                    $startTimer = Carbon::parse($task->timer_start);
                    $endTimer = Carbon::parse($task->timer_end);
                    $getTime = $endTimer->diffInSeconds($startTimer);
                    $array[] = $getTime;
                }
            }
        return CarbonInterval::seconds(array_sum($array))->cascade()->format('%d nap %H óra %i perc %s mp');
    }
}
