<?php

namespace App\Http\Controllers;

use App\Events\DepositCreated;
use App\Models\Client;
use App\Models\Deposit;
use App\Models\DepositBalance;
use App\Models\DepositType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            ->addColumn('deposit_type_name', function ($data) {
                return $data->depositType->name;
            })
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
        $deposit = new Deposit();
        return view('include.deposit.create', compact('deposit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDepositRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $messages = [
                'code.required' => 'Kode tidak boleh kosong!',
                'code.max' => 'Kode tidak boleh melebihi 255 huruf!',
                'code.unique' => 'Kode sudah digunakan!',
                'client_id.required' => 'Klien tidak boleh kosong!',
                'date.required' => 'Tanggal tidak boleh kosong!',
                'deposit_type_id.required' => 'Tipe setoran tidak boleh kosong!',
                'amount.required' => 'Jumlah tidak boleh kosong!'
            ];

            $validated = $request->validate([
                'code' => ['required', 'max:255', 'unique:deposits,code'],
                'client_id' => ['required'],
                'date' => ['required', 'string', 'max:255'],
                'deposit_type_id' => ['required'],
                'amount' => ['required'],
            ], $messages);

            $validated['amount'] = preg_replace('/[Rp. ]/', '', $request->amount);

            $deposit = Deposit::create($validated);

            event(new DepositCreated($deposit));
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function show(Deposit $deposit)
    {
        return view('include.deposit.show', compact('deposit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function edit(Deposit $deposit)
    {
        if ($deposit->client->client_type_id == Client::NASABAH) {
            $deposit_type = DepositType::where('id', Deposit::SIMPANAN_SUKARELA)->pluck('name', 'id');
        }
        if ($deposit->client->client_type_id == Client::ANGGOTA) {
            $deposit_type = DepositType::pluck('name', 'id');
        }
        $client = Client::pluck('name', 'id');
        return view('include.deposit.edit', compact('deposit', 'deposit_type', 'client'));
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

    public function getDepositType(Request $request)
    {
        $client = Client::find($request->client_id);
        if ($client->client_type_id == Client::NASABAH) {
            return DepositType::where('id', Deposit::SIMPANAN_SUKARELA)->pluck('name', 'id');
        }
        if ($client->client_type_id == Client::ANGGOTA) {
            return DepositType::pluck('name', 'id');
        }
    }
}
