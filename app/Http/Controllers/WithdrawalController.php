<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WithdrawalRequest;
use App\Models\WithdrawalRequestDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class WithdrawalController extends Controller
{
    public function store(Request $request)
    {
        Log::info('dddd', [$request->all()]);
        // حساب المبلغ الكلي عند عدم وجود تفاصيل
        $totalAmount = $request->all()['amount'] ?? 0;
        if ($totalAmount <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'يجب أن يكون المبلغ أكبر من 0.'
            ], 400);
        }

        // إنشاء طلب السحب بدون تفاصيل، فقط بالمبلغ الكلي
        $withdrawalRequest = WithdrawalRequest::create([
            'user_id' => Auth::id(),
            'notes' => $request->input('notes'),
            'type' => 'decrease',
            'amount' => $totalAmount, // تخزين المبلغ الكلي
        ]);

        return response()->json([
            'success' => true,
            'message' => 'تم تقديم طلب السحب بنجاح.',
            'withdrawal_id' => $withdrawalRequest->id,
            'amount' => $withdrawalRequest->amount,
        ]);
    }
}
