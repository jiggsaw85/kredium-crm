<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashLoanStoreRequest;
use App\Http\Requests\CashLoanUpdateRequest;
use App\Services\LoanService;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CashLoanController extends Controller
{
    private LoanService $loanService;

    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    /**
     * @param CashLoanStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CashLoanStoreRequest $request): RedirectResponse
    {
        try {
            $this->loanService->createCashLoan($request->validated());
            return back()->with('success', 'Cash loan added successfully!');
        } catch (\Exception $e) {
            Log::error('Error adding cash loan: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param CashLoanUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(CashLoanUpdateRequest $request, int $id): RedirectResponse
    {
        try {
            $this->loanService->updateCashLoan($id, $request->validated());
            return back()->with('success', 'Cash loan updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating cash loan: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
}
