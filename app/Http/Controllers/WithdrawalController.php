<?php

namespace App\Http\Controllers;

use App\Events\WithdrawalCreated;
use App\Models\Withdrawal;
use App\Http\Requests\UpdateWithdrawalRequest;
use App\Models\DepositBalance;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('withdrawal.index');
    }

    public function getWithdrawalList(Request $request)
    {
        $data  = Withdrawal::query();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $action = view('include.withdrawal.btn-action', compact('data'))->render();
                return $action;
            })
            ->addColumn('client_name', function ($data) {
                return $data->client->name;
            })
            // ->addColumn('deposit_type_name', function ($data) {
            //     return $data->deposit->depositType->name;
            // })
            ->addColumn('amount', function ($data) {
                return idr($data->amount);
            })
            ->addColumn('date', function ($data) {
                return Carbon::parse($data->date)->format('d/m/Y');
            })
            ->filter(function ($instance) use ($request) {
                if (!empty($request->search)) {
                    $instance->where(function ($w) use ($request) {
                        $search = $request->search;
                        $w->orwhere('code', 'LIKE', "%$search%")
                            ->orwhere('amount', 'LIKE', "%$search%");
                    });
                }

                return $instance;
            })
            ->rawColumns(['action', 'client_name', 'deposit_type_name'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $withdrawal = new Withdrawal();
        return view('include.withdrawal.create', compact('withdrawal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWithdrawalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $messages = [
                'client_id.required' => 'Klien tidak boleh kosong!',
                'date.required' => 'Tanggal tidak boleh kosong!',
                'amount.required' => 'Jumlah tidak boleh kosong!'
            ];

            $validated = $request->validate([
                'client_id' => ['required'],
                'date' => ['required', 'string', 'max:255'],
                'amount' => ['required'],
            ], $messages);

            $validated['amount'] = preg_replace('/[Rp. ]/', '', $request->amount);
            $validated['deposit_balance_id'] = DepositBalance::where('client_id', $request->client_id)->first()->id;
            $validated['description'] = $request->description;

            $withdrawal = Withdrawal::create($validated);

            event(new WithdrawalCreated($withdrawal));
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function show(Withdrawal $withdrawal)
    {
        return view('include.withdrawal.show', compact('withdrawal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function edit(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWithdrawalRequest  $request
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWithdrawalRequest $request, Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Withdrawal $withdrawal)
    {
        //
    }
}
