<?php

namespace App\Http\Controllers;

use App\Models\DepositBalance;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DepositBalanceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $deposits = DepositBalance::with('client')->orderBy('updated_at', 'desc')->get();
        return view('deposit-balance.index', compact('deposits'));
    }

    public function getDepositBalanceList(Request $request)
    {
        $data  = DepositBalance::query();

        return DataTables::of($data)
            ->addColumn('client_code', function ($data) {
                return $data->client->code;
            })
            ->addColumn('client_name', function ($data) {
                return $data->client->name;
            })
            ->addColumn('amount', function ($data) {
                return idr($data->amount);
            })
            ->addColumn('updated_at', function ($data) {
                return $data->updated_at->diffForhumans();
            })
            ->orderColumn('updated_at', '-updated_at $1')
            ->filter(function ($instance) use ($request) {
                if($request->clientType){
                    $instance->whereHas('client', function ($query) use ($request) {
                        $clientType = $request->clientType;
                        $query->where('client_type_id', $clientType);
                    })
                    ->with(['client' => function ($query) use ($request) {
                        $clientType = $request->clientType;
                        $query->where('client_type_id', $clientType);
                    }]);
                }
                if (!empty($request->search)) {
                    $instance->whereHas('client', function ($query) use ($request) {
                        $search = $request->search;
                        $query->where('name', 'like', "%$search%")
                            ->orWhere('code', 'like', "%$search%");
                    })
                    ->with(['client' => function ($query) use ($request) {
                        $search = $request->search;
                        $query->where('name', 'like', "%$search%")
                            ->orWhere('code', 'like', "%$search%");
                    }]);
                }

                return $instance;
            })
            ->rawColumns(['client_code', 'client_name', 'amount', 'updated_at'])
            ->make(true);
    }
}