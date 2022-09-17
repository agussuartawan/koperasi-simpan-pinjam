@extends('layouts.panel')
@section('title', 'Tabungan')
@push('css')
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('') }}/vendor/select2/css/select2.min.css"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('') }}/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('') }}/vendor/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}/vendor/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}/vendor/sweetalert2/sweetalert2.min.css">
@endpush
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">Tabungan</h1>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Tabungan</li>
        </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Tabungan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="deposit-balance-table" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>Kode Pelanggan</th>
                            <th>Nama Pelanggan</th>
                            <th>Saldo Tabungan</th>
                            <th>Terakhir diperbaharui</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deposits as $deposit)
                            <tr>
                                <td>{{ $deposit->client->code }}</td>
                                <td>{{ $deposit->client->name }}</td>
                                <td class="text-right">{{ idr($deposit->amount) }}</td>
                                <td>{{ $deposit->updated_at->diffForhumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('') }}/js/deposit-balance/index.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
    {{-- <script src="{{ asset('') }}/vendor/select2/js/select2.full.min.js"></script> --}}
    <script src="{{ asset('') }}/vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}/vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}/vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}/vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}/vendor/sweetalert2/sweetalert2.min.js"></script>
@endpush
