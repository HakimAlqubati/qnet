<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WithdrawalRequestDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'withdrawal_request_id',
        'amount',
        'transaction_number',
    ];

    // علاقة مع طلب السحب
    public function withdrawalRequest(): BelongsTo
    {
        return $this->belongsTo(WithdrawalRequest::class);
    }
}
