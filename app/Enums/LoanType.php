<?php

namespace App\Enums;

enum LoanType: string
{
    case CASH_LOAN = 'App\Models\CashLoan';
    case HOME_LOAN = 'App\Models\HomeLoan';
}
