<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    /**
     * @return View
     */
    private ReportService $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $loans = $this->reportService->getUserLoans();

        return view('report.index', compact('loans'));
    }

    /**
     * @return StreamedResponse
     */
    public function exportCsv(): StreamedResponse
    {
        $loans = $this->reportService->getUserLoans();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="loan_report.csv"',
        ];

        return new StreamedResponse(function () use ($loans) {
            $this->reportService->generateCsv($loans);
        }, Response::HTTP_OK, $headers);
    }
}
