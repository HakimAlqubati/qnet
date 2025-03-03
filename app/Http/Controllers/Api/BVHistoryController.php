<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class BVHistoryController extends Controller
{
    public function getByYearWeek($year, $week, $userId)
    {

        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $bvHistory = $user->getBVHistoryByYearWeek($year, $week);

        return response()->json([
            'success' => true,
            'data' => $bvHistory
        ]);
    }

    public function getWeeksList($year)
    {
        try {
            $currentDate = now();
            $currentYear = (int)$year;
            $currentWeek = (int)$currentDate->format('W');

            $maxWeeks = $currentYear < $currentDate->year ? 52 : $currentWeek;

            $weeksList = [];

            for ($week = 1; $week <= $maxWeeks; $week++) {
                $weeksList[] = [
                    'week_number' => $week,
                    'year' => $currentYear
                ];
            }

            return response()->json($weeksList, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
