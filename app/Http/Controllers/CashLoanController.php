<?php

namespace App\Http\Controllers;

use App\Enums\LoanType;
use App\Http\Requests\CashLoanStoreRequest;
use App\Http\Requests\CashLoanUpdateRequest;
use App\Models\CashLoan;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CashLoanController extends Controller
{
    /**
     * @param CashLoanStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CashLoanStoreRequest $request): RedirectResponse
    {
        $existingLoan = Loan::where('client_id', $request->client_id)
            ->where('loanable_type', LoanType::CASH_LOAN->value)
            ->first();

        if ($existingLoan) {
            return back()->with('error', 'This client already has a cash loan.');
        }

        $cashLoan = CashLoan::create([
            'amount' => $request->amount,
        ]);

        Loan::create([
            'user_id' => Auth::id(),
            'client_id' => $request->client_id,
            'loanable_id' => $cashLoan->id,
            'loanable_type' => LoanType::CASH_LOAN->value,
        ]);

        return back()->with('success', 'Cash loan added successfully!');
    }

    /**
     * @param CashLoanUpdateRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(CashLoanUpdateRequest $request, $id): RedirectResponse
    {
        $loan = Loan::where('loanable_id', $id)
            ->where('loanable_type', LoanType::CASH_LOAN->value)
            ->firstOrFail();

        if ($loan->user_id !== Auth::id()) {
            return back()->with('error', 'You are not authorized to update this loan.');
        }

        $loan->loanable->update([
            'amount' => $request->amount,
        ]);

        return back()->with('success', 'Cash loan updated successfully!');
    }
}
