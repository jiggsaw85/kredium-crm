<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashLoan extends Model
{
    use HasFactory;

    protected $fillable = ['amount'];

    public function loan()
    {
        return $this->morphOne(Loan::class, 'loanable');
    }
}

