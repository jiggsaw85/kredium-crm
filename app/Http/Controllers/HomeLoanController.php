<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeLoanStoreRequest;
use App\Http\Requests\HomeLoanUpdateRequest;
use App\Services\LoanService;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HomeLoanController extends Controller
{
    private LoanService $loanService;

    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    /**
     * @param HomeLoanStoreRequest $request
     * @return RedirectResponse
     */
    public function store(HomeLoanStoreRequest $request): RedirectResponse
    {
        try {
            $this->loanService->createHomeLoan($request->validated());
            return back()->with('success', 'Home loan added successfully!');
        } catch (\Exception $e) {
            Log::error('Error adding home loan: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param HomeLoanUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(HomeLoanUpdateRequest $request, int $id): RedirectResponse
    {
        try {
            $this->loanService->updateHomeLoan($id, $request->validated());
            return back()->with('success', 'Home loan updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating home loan: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
}

