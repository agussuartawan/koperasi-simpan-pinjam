@extends('layouts.panel')
@section('title', 'Laporan Pembayaran')
@push('css')
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('') }}/vendor/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}/vendor/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">Laporan Pembayaran</h1>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Pembayaran</li>
        </ol>
    </nav>

    <div class="card shadow mb-4" id="search-area">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cari laporan pembayaran</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('payment.report.table') }}" method="get" id="form-search">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="from">Dari :</label>
                            <input type="date" class="form-control" name="from" id="from">
                        </div>

                        <div class="col">
                            <label for="from">Sampai :</label>
                            <input type="date" class="form-control" name="to" id="to">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-search mr-2">Cari</button>
            </form>
        </div>
    </div>



@endsection
@push('js')
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="{{ asset('') }}/js/report/payment.js"></script>
    <script src="{{ asset('') }}/vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}/vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}/vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}/vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
@endpush
