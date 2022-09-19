<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.index');
    }

    public function getClientList(Request $request)
    {
        $data  = Client::query();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $action = view('include.client.btn-action', compact('data'))->render();
                return $action;
            })
            ->addColumn('client_type', function ($data) {
                return $data->clientType->name;
            })
            ->addColumn('status', function ($data) {
                if ($data->is_active == 1) {
                    return '<span class="badge badge-success">Aktif</span>';
                }
                if ($data->is_active == 0) {
                    return '<span class="badge badge-secondary">Nonaktif</span>';
                }
            })
            ->filter(function ($instance) use ($request) {
                if (!empty($request->search)) {
                    $instance->where(function ($w) use ($request) {
                        $search = $request->search;
                        $w->orwhere('name', 'LIKE', "%$search%")
                            ->orwhere('code', 'LIKE', "%$search%")
                            ->orwhere('nik', 'LIKE', "%$search%")
                            ->orwhere('phone', 'LIKE', "%$search%");
                    });
                }

                return $instance;
            })
            ->rawColumns(['action', 'client_type', 'status'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = new Client();
        $client_type = ClientType::pluck('name', 'id');
        return view('include.client.create', compact('client', 'client_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'code.required' => 'Kode tidak boleh kosong!',
            'code.max' => 'Kode tidak boleh melebihi 255 huruf!',
            'code.unique' => 'Kode sudah digunakan!',
            'nik.required' => 'NIK tidak boleh kosong!',
            'nik.max' => 'NIK tidak boleh melebihi 255 digit!',
            'name.required' => 'Nama tidak boleh kosong!',
            'name.max' => 'Nama tidak boleh melebihi 255 huruf!',
            'phone.required' => 'No telp tidak boleh kosong!',
            'gender.required' => 'Jenis kelamin tidak boleh kosong!',
            'address.required' => 'Alamat masuk tidak boleh kosong!',
            'client_type_id.required' => 'Tipe tidak boleh kosong!'
        ];

        $validated = $request->validate([
            'code' => ['required', 'max:255'],
            'nik' => ['required', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
            'client_type_id' => ['required'],
        ], $messages);


        return Client::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('include.client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CLient $client)
    {
        $client_type = ClientType::pluck('name', 'id');
        return view('include.client.edit', compact('client', 'client_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CLient $client)
    {
        $messages = [
            'code.required' => 'Kode tidak boleh kosong!',
            'code.max' => 'Kode tidak boleh melebihi 255 huruf!',
            'code.unique' => 'Kode sudah digunakan!',
            'nik.required' => 'NIK tidak boleh kosong!',
            'nik.max' => 'NIK tidak boleh melebihi 255 digit!',
            'name.required' => 'Nama tidak boleh kosong!',
            'name.max' => 'Nama tidak boleh melebihi 255 huruf!',
            'phone.required' => 'No telp tidak boleh kosong!',
            'gender.required' => 'Jenis kelamin tidak boleh kosong!',
            'address.required' => 'Alamat masuk tidak boleh kosong!',
            'client_type_id.required' => 'Tipe tidak boleh kosong!'
        ];

        $validated = $request->validate([
            'code' => ['required', 'max:255'],
            'nik' => ['required', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
            'client_type_id' => ['required'],
            'is_active' => ['required']
        ], $messages);

        return $client->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Client $client)
    // {
    //     if ($client->clientType()->exists()) {
    //         return false;
    //     }
    //     return $client->delete();
    // }

    public function searchClient(Request $request)
    {
        $search = $request->search;
        return Client::where('name', 'LIKE', "%$search%")->select('id', 'name')->get();
    }
}
