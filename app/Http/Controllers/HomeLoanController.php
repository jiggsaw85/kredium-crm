<?php

namespace App\Http\Controllers;

use App\Enums\LoanType;
use App\Http\Requests\HomeLoanStoreRequest;
use App\Http\Requests\HomeLoanUpdateRequest;
use App\Models\HomeLoan;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HomeLoanController extends Controller
{
    /**
     * @param HomeLoanStoreRequest $request
     * @return RedirectResponse
     */
    public function store(HomeLoanStoreRequest $request): RedirectResponse
    {
        $existingLoan = Loan::where('client_id', $request->client_id)
            ->where('loanable_type', LoanType::HOME_LOAN->value)
            ->first();

        if ($existingLoan) {
            return back()->with('error', 'This client already has a home loan.');
        }

        $homeLoan = HomeLoan::create([
            'property_value' => $request->property_value,
            'down_payment' => $request->down_payment,
        ]);

        Loan::create([
            'user_id' => Auth::id(),
            'client_id' => $request->client_id,
            'loanable_id' => $homeLoan->id,
            'loanable_type' => LoanType::HOME_LOAN->value,
        ]);

        return back()->with('success', 'Home loan added successfully!');
    }

    /**
     * @param HomeLoanUpdateRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(HomeLoanUpdateRequest $request, $id): RedirectResponse
    {
        $loan = Loan::where('loanable_id', $id)
            ->where('loanable_type', LoanType::HOME_LOAN->value)
            ->firstOrFail();

        if ($loan->user_id !== Auth::id()) {
            return back()->with('error', 'You are not authorized to update this loan.');
        }

        $loan->loanable->update([
            'property_value' => $request->property_value,
            'down_payment' => $request->down_payment,
        ]);

        return back()->with('success', 'Home loan updated successfully!');
    }
}

