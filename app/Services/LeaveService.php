<?php

namespace App\Services;

use Illuminate\Support\Carbon;

class LeaveService
{
        public function calculateLeaves(int $children, string $birthday): int
        {
            $birthday= Carbon::parse($birthday)->age;
            $leaveNumber = 20;

            if($birthday >= 45) {
                $leaveNumber += 10;
            } elseif ($birthday >= 43) {
                $leaveNumber += 9;
            } elseif ($birthday >= 41) {
                $leaveNumber += 8;
            } elseif ($birthday >= 39) {
                $leaveNumber += 7;
            } elseif ($birthday >= 37) {
                $leaveNumber += 6;
            } elseif ($birthday >= 35) {
                $leaveNumber += 5;
            } elseif ($birthday >= 33) {
                $leaveNumber += 4;
            } elseif ($birthday >= 31) {
                $leaveNumber += 3;
            } elseif ($birthday >= 28) {
                $leaveNumber += 2;
            } elseif ($birthday >= 25) {
                $leaveNumber += 1;
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
