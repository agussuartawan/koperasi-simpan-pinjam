@extends('layouts.panel')
@section('title', 'Tunggakan')
@push('css')
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('') }}/vendor/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}/vendor/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">Tunggakan</h1>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Tunggakan</li>
        </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Tunggakan</h6>
            {{-- <a href="{{ route('arrear.report') }}" class="btn btn-sm btn-danger btn-download" target="_blank">Download
                PDF</a> --}}

            <a href="{{ route('arrear.report') }}" class="btn btn-sm btn-danger btn-icon-split" target="_blank">
                <span class="icon text-white-50">
                    <i class="fas fa-download"></i>
                </span>
                <span class="text">Download PDF</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="deposit-balance-table" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>Kode Pinjaman</th>
                            <th>Nama Pelanggan</th>
                            <th>Saldo Pinjaman</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $current_id = 0;
                        @endphp

                        @forelse ($arrears as $arrear)
                            @if ($current_id != $arrear->loan_id)
                                <tr>
                                    <td>{{ $arrear->loan->code }}</td>
                                    <td>{{ $arrear->loan->client->name }}</td>
                                    <td class="text-right">{{ idr($arrear->loan->total_amount) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('arrears.show', $arrear->loan_id) }}"
                                            class="mr-2 btn btn-info btn-circle btn-sm btn-show"
                                            title="Detail tunggakan {{ $arrear->loan->code }}">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endif

                            @php $current_id = $arrear->loan_id; @endphp
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data pada tabel</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('include.modal')

@endsection

@push('js')
    <!-- Page level plugins -->
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('') }}/js/arrear/index.js"></script>
    <script src="/js/demo/datatables-demo.js"></script>
    <script src="{{ asset('') }}/vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}/vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}/vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}/vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
@endpush
