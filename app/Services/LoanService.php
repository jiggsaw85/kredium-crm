<?php

namespace App\Services;

use App\Models\Loan;

class LoanService
{
    public function createLoan(array $data): Loan
    {
        $existingLoan = Loan::where('client_id', $data['client_id'])
            ->where('loanable_type', $data['loanable_type'])
            ->first();

        if ($existingLoan) {
            throw new \Exception('This client already has a loan of this type.');
        }

        return Loan::create($data);
    }
}
