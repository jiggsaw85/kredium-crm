<?php

namespace App\Services;

use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class ReportService
{
    /**
     * Fetch all user's loans and sort them desc
     * latest on the top
     *
     * @return mixed
     */
    public function getUserLoans()
    {
        return Loan::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->with('loanable')
            ->get();
    }

    /**
     * Generate CSV of user's loans
     *
     * @param $loans
     * @return void
     */
    public function generateCsv($loans): void
    {
        $output = fopen('php://output', 'w');

        fputcsv($output, ['Product Type', 'Product Value', 'Creation Date']);

        foreach ($loans as $loan) {
            $productType = class_basename($loan->loanable_type) === 'CashLoan' ? 'Cash Loan' : 'Home Loan';
            $productValue = $loan->loanable instanceof \App\Models\CashLoan
                ? ($loan->loanable->amount ?? 'N/A')
                : ($loan->loanable->property_value ?? 'N/A') . ' - ' . ($loan->loanable->down_payment ?? 'N/A');
            $creationDate = $loan->created_at->format('Y-m-d H:i:s');

            fputcsv($output, [$productType, $productValue, $creationDate]);
        }

        fclose($output);
    }
}
