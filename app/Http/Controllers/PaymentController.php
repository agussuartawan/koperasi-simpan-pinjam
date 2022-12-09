<?php

namespace App\Http\Controllers;

use App\Events\PaymentCreated;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Debt;
use App\Models\Loan;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('payment.index');
    }

    public function getPaymentList(Request $request)
    {
        $data  = Payment::query();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $action = view('include.payment.btn-action', compact('data'))->render();
                return $action;
            })
            ->addColumn('client_name', function ($data) {
                return $data->client->name;
            })
            ->addColumn('total_amount', function ($data) {
                return idr($data->total_amount);
            })
            ->addColumn('date', function ($data) {
                return Carbon::parse($data->date)->format('d/m/Y');
            })
            ->filter(function ($instance) use ($request) {
                if (!empty($request->search)) {
                    $instance->where(function ($w) use ($request) {
                        $search = $request->search;
                        $w->orwhere('code', 'LIKE', "%$search%")
                            ->orwhere('total_amount', 'LIKE', "%$search%");
                    });
                }

                return $instance;
            })
            ->rawColumns(['action', 'client_name', 'total_amount'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment = new Payment();
        return view('include.payment.create', compact('payment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            $debt_id = Debt::where('client_id', $validated['client_id'])->first()->id;
            $loan = Loan::where('id', $validated['loan_id'])->first();
            $payment_on = Payment::where('loan_id', $validated['loan_id'])->count() + 1;
            $amount = (float)$loan->total_amount / (float)$loan->term->term_day;

            $mulct = (float)$validated['mulct'];
            $mulct_idr = $amount * ($mulct / 100);
            $total_amount = $amount + $mulct_idr;

            $validated['mulct_idr'] = $mulct_idr;
            $validated['payment_on'] = $payment_on;
            $validated['amount'] = $amount;
            $validated['total_amount'] = $total_amount;
            $validated['debt_id'] = $debt_id;

            $payment = Payment::create($validated);

            if ($payment->payment_on == $loan->term->term_day) {
                $loan->is_paid = 1;
                $loan->save();
            }
            event(new PaymentCreated($payment));
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return view('include.payment.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function paymentCheck(Request $request)
    {
        $loan_id = $request->loan_id;

        $loan = Loan::where('id', $loan_id)->first();

        $payment_count = Payment::where('loan_id', $loan_id)->count() + 1;
        $payment_amount = (float)$loan->total_amount / (float)$loan->term->term_day;

        return  [
            'installment' => $payment_count,
            'payment_amount' => $payment_amount,
        ];
    }

    public function paymentInvoice(Payment $payment)
    {
        $pdf = Pdf::loadview('pdf.payment-invoice', compact('payment'));
        return $pdf->stream('nota-pembayaran-pdf');
    }
}