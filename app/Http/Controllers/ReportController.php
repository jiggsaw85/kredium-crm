<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $loans = Loan::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->with('loanable')
            ->get();

        return view('report.index', compact('loans'));
    }
}
