<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeLoan extends Model
{
    use HasFactory;

    protected $fillable = ['property_value', 'down_payment'];

    public function loan()
    {
        return $this->morphOne(Loan::class, 'loanable');
    }
}

