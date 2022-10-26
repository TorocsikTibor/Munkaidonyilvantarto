<?php

namespace App\Services;

use Illuminate\Support\Carbon;

class LeaveService
{
        public function calculateLeaves(int $children, string $birthday): int
        {
            $age = Carbon::parse($birthday)->age;
            $leaveNumber = 20;

            $extraLeaveAges = [25,28,31,33,35,37,39,41,43,45];

            foreach($extraLeaveAges as $extraLeaveAge) {
                if ($extraLeaveAge <= $age) {
                    $leaveNumber++;
                }
            }

            $leaveNumber += match ($children) {
                0 => 0,
                1 => 2,
                2 => 4,
                default => 7,
            };

            return $leaveNumber;
        }
}
