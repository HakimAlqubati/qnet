<?php

namespace App\Http\Controllers;

use App\Models\UserAccountHistory;
use Illuminate\Http\Request;
use App\Models\WithdrawalRequest;
use App\Models\WithdrawalRequestDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class WithdrawalController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            // Create account history record for withdrawal
            UserAccountHistory::create([
                'user_id' => auth()->id(),
                'amount' => $request->all()['amount'],
                'type' => UserAccountHistory::TYPE_DECREASE,
                'notes' => 'Withdrawal request ' . now()->toDateString(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Withdrawal request submitted successfully',
                'amount' => $request->all()['amount'],
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to process withdrawal request',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
