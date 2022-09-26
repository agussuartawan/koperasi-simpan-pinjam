<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function depositReport()
    {
        return view('report.deposit');
    }

    // public function depositReport()
    // {
    //     $deposits = Deposit::get();
    //     $pdf = Pdf::loadview('pdf.deposit', compact('deposits'));
    // 	return $pdf->stream('laporan-tabungan-pdf');
    // }
}
