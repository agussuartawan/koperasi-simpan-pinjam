<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TermController extends Controller
{
    public function index()
    {
        return view('term.index');
    }

    public function getList(Request $request)
    {
        $data  = Term::query();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $action = view('include.term.btn-action', compact('data'))->render();
                return $action;
            })
            ->filter(function ($instance) use ($request) {
                if (!empty($request->search)) {
                    $instance->where(function ($w) use ($request) {
                        $search = $request->search;
                        $w->orwhere('description', 'LIKE', "%$search%")
                            ->orwhere('term_day', 'LIKE', "%$search%");
                    });
                }

                return $instance;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
