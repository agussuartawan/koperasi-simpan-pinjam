<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Deposit;
use App\Models\DepositType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('deposit.index');
    }

    public function getDepositList(Request $request)
    {
        $data  = Deposit::query();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $action = view('include.deposit.btn-action', compact('data'))->render();
                return $action;
            })
            ->addColumn('client_name', function ($data) {
                return $data->client->name;
            })
            ->addColumn('amount', function ($data) {
                return idr($data->amount);
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
            ->rawColumns(['action', 'client_name'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $deposit = new Deposit();
        $deposit_types = DepositType::pluck('name', 'id');
        return view('include.deposit.create', compact('deposit', 'deposit_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDepositRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function show(Deposit $deposit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function edit(Deposit $deposit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDepositRequest  $request
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deposit $deposit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deposit $deposit)
    {
        //
    }
}
