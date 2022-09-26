<?php

namespace App\Http\Controllers;

use App\Models\Arrear;
use App\Models\Deposit;
use App\Models\Loan;
use App\Models\Payment;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function depositReport()
    {
        return view('report.deposit');
    }

    public function depositReportPdf(Request $request)
    {
        $date = [
            'from' => $request->from,
            'to' => $request->to
        ];
        $deposits = Deposit::whereBetween('date', $date)->get();
        $pdf = Pdf::loadview('pdf.deposit', compact('deposits'));
        return $pdf->stream('laporan-tabungan-pdf');
    }

    public function depositReportTable(Request $request)
    {
        $date = [
            'from' => $request->from,
            'to' => $request->to
        ];
        $deposits = Deposit::whereBetween('date', $date)->get();
        return view('include.report-table.deposit', compact('deposits'));
    }


    public function withdrawalReport()
    {
        return view('report.withdrawal');
    }

    public function withdrawalReportPdf(Request $request)
    {
        $date = [
            'from' => $request->from,
            'to' => $request->to
        ];
        $withdrawals = withdrawal::whereBetween('date', $date)->get();
        $pdf = Pdf::loadview('pdf.withdrawal', compact('withdrawals'));
        return $pdf->stream('laporan-tarikan-pdf');
    }

    public function withdrawalReportTable(Request $request)
    {
        $date = [
            'from' => $request->from,
            'to' => $request->to
        ];
        $withdrawals = Withdrawal::whereBetween('date', $date)->get();
        return view('include.report-table.withdrawal', compact('withdrawals'));
    }


    public function loanReport()
    {
        return view('report.loan');
    }

    public function loanReportPdf(Request $request)
    {
        $date = [
            'from' => $request->from,
            'to' => $request->to
        ];
        $loans = Loan::whereBetween('date', $date)->get();
        $pdf = Pdf::loadview('pdf.loan', compact('loans'));
        return $pdf->stream('laporan-pinjaman-pdf');
    }

    public function loanReportTable(Request $request)
    {
        $date = [
            'from' => $request->from,
            'to' => $request->to
        ];
        $loans = Loan::whereBetween('date', $date)->get();
        return view('include.report-table.loan', compact('loans'));
    }

    public function paymentReport()
    {
        return view('report.payment');
    }

    public function paymentReportPdf(Request $request)
    {
        $date = [
            'from' => $request->from,
            'to' => $request->to
        ];
        $payments = Payment::whereBetween('date', $date)->get();
        $pdf = Pdf::loadview('pdf.payment', compact('payments'));
        return $pdf->stream('laporan-pembayaran-pdf');
    }

    public function paymentReportTable(Request $request)
    {
        $date = [
            'from' => $request->from,
            'to' => $request->to
        ];
        $payments = Payment::whereBetween('date', $date)->get();
        return view('include.report-table.payment', compact('payments'));
    }
}
