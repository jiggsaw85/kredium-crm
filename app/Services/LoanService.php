<?php

namespace App\Services;

use App\Enums\LoanType;
use App\Models\Client;
use App\Models\Loan;

class LoanService
{
    /**
     * @param array $data
     * @return Loan
     * @throws \Exception
     */
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

    /**
     * @param Client $client
     * @param LoanType $loanType
     * @return void
     */
    public function deleteLoan(Client $client, LoanType $loanType): void
    {
        $loan = $client->loans()
            ->where('loanable_type', $loanType->value)
            ->first();

        if ($loan) {
            $loan->loanable->delete();
            $loan->delete();
        }
    }
}
