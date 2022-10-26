<?php

namespace App\Http\Controllers;

use App\Events\LoanCreated;
use App\Http\Requests\StoreLoanRequest;
use App\Models\Loan;
use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('loan.index');
    }

    public function getLoanList(Request $request)
    {
        $data  = Loan::query();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $action = view('include.loan.btn-action', compact('data'))->render();
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
        $loan = new Loan();
        $terms = Term::pluck('description', 'id');
        return view('include.loan.create', compact('loan', 'terms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoanRequest $request)
    {
        DB::transaction(function () use ($request) {
            return Loan::create($request->validated());
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        return view('include.loan.show', compact('loan'));
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

    public function getLoanByClient(Request $request)
    {
        $client_id = $request->client_id;

        $loans = Loan::where('client_id', $client_id)->where('is_paid', 0);
        if ($loans->exists()) {
            $loans = $loans->select('id', 'code', 'total_amount')->get();
            return $loans->map(function ($loan) {
                return [
                    'id'    => $loan->id,
                    'text'  => $loan->code . ' | ' . idr($loan->total_amount)
                ];
            })
                ->pluck('text', 'id')
                ->all();
        }
        return;
    }
}
