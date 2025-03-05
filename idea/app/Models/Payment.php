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

    public function fee(): BelongsTo
    {
        return $this->belongsTo(Fee::class,'fee_id','id');
    }



}
