<?php

namespace App\Models;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class Receiver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function expenses()
    {
        $this->hasOne(Expense::class);
    }
}
