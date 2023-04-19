<?php

namespace App\Models;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'receiver_id',
        'description',
        'type',
        'amount',
        'due_date',
        'payment_date',
        'payment_month',
        'payment_year',
        'is_paid'
    ];

    public function receiver()
    {
        return $this->belongsTo(Receiver::class);
    }
}
