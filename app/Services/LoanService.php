<?php

namespace App\Services;

use App\Enums\LoanType;
use App\Models\CashLoan;
use App\Models\Client;
use App\Models\HomeLoan;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class LoanService
{
    /**
     * Store a new Home Loan.
     *
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function createHomeLoan(array $data): void
    {
        $existingLoan = Loan::where('client_id', $data['client_id'])
            ->where('loanable_type', LoanType::HOME_LOAN->value)
            ->first();

        if ($existingLoan) {
            throw new \Exception('This client already has a home loan.');
        }

        $homeLoan = HomeLoan::create([
            'property_value' => $data['property_value'],
            'down_payment' => $data['down_payment'],
        ]);

        Loan::create([
            'user_id' => Auth::id(),
            'client_id' => $data['client_id'],
            'loanable_id' => $homeLoan->id,
            'loanable_type' => LoanType::HOME_LOAN->value,
        ]);
    }

    /**
     * Update an existing Home Loan.
     *
     * @param int $id
     * @param array $data
     * @throws \Exception
     */
    public function updateHomeLoan(int $id, array $data): void
    {
        $loan = Loan::where('loanable_id', $id)
            ->where('loanable_type', LoanType::HOME_LOAN->value)
            ->firstOrFail();

        if ($loan->user_id !== Auth::id()) {
            throw new \Exception('You are not authorized to update this loan.');
        }

        $loan->loanable->update([
            'property_value' => $data['property_value'],
            'down_payment' => $data['down_payment'],
        ]);
    }

    /**
     * Store a new Cash Loan.
     *
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function createCashLoan(array $data): void
    {
        $existingLoan = Loan::where('client_id', $data['client_id'])
            ->where('loanable_type', LoanType::CASH_LOAN->value)
            ->first();

        if ($existingLoan) {
            throw new \Exception('This client already has a cash loan.');
        }

        $cashLoan = CashLoan::create([
            'amount' => $data['amount'],
        ]);

        Loan::create([
            'user_id' => Auth::id(),
            'client_id' => $data['client_id'],
            'loanable_id' => $cashLoan->id,
            'loanable_type' => LoanType::CASH_LOAN->value,
        ]);
    }

    /**
     * Update an existing Cash Loan.
     *
     * @param int $id
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function updateCashLoan(int $id, array $data): void
    {
        $loan = Loan::where('loanable_id', $id)
            ->where('loanable_type', LoanType::CASH_LOAN->value)
            ->firstOrFail();

        if ($loan->user_id !== Auth::id()) {
            throw new \Exception('You are not authorized to update this loan.');
        }

        $loan->loanable->update([
            'amount' => $data['amount'],
        ]);
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
