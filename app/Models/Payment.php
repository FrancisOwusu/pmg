<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $table ='payments';
    protected $guarded = ['id'];
    protected $fillable = [
        'id','student_id', 'amount', 'contribution_type', 'payment_method',
        'transaction_id', 'status', 'month', 'year', 'received_by'
    ];

    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function receivedByUser() {
        return $this->belongsTo(User::class, 'received_by');
    }
    public function fee(): BelongsTo
    {
        return $this->belongsTo(Fee::class,'fee_id','id');
    }



}
