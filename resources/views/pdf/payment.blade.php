@extends('layouts.pdf')
@section('title', 'Laporan Pembayaran')
@section('content')
@push('css')
<style>
    h1 {
        font-weight: bold;
        font-size: 20pt;
        text-align: center;
    }

    .table {
        border-collapse: collapse;
        width: 100%;
        font-size: 10pt;
    }

    .table th {
        padding: 8px 8px;
        border: 1px solid #000000;
        text-align: center;
    }

    .table td {
        padding: 3px 3px;
        border: 1px solid #000000;
    }

    .text {
        font-size: 10pt;
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }
</style>
@endpush

<div class="container">
    <h3 class="text-center" style="margin-bottom: 5px">Laporan Pembayaran</h3>
    <table class="table" style="margin-top: 5px; margin-bottom: 15px">
        <thead>
            <tr>
                <th>No.</th>
                <th>Tgl</th>
                <th>Kode</th>
                <th>Nama Klien</th>
                <th>Angsuran ke</th>
                <th>Denda</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $key => $payment)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}</td>
                <td>{{ $payment->code }}</td>
                <td>{{ $payment->client->name }}</td>
                <td>{{ $payment->payment_on }}</td>
                <td class="text-right">{{ idr($payment->mulct_idr) }}</td>
                <td class="text-right">{{ idr($payment->total_amount) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-center">Jumlah</td>
                <td class="text-right">{{ idr($payments->sum('mulct_idr')) }}</td>
                <td class="text-right">{{ idr($payments->sum('total_amount')) }}</td>
            </tr>
        </tfoot>
    </table>

    {{-- <table style="width: 100%; margin-top: 20px">
        <tr>
            <td class="text" style="text-align: right">Badung,
                {{ \Carbon\Carbon::now()->isoFormat('DD MMMM Y') }}</td>
        </tr>
        <tr>
            <td style="height: 40px"></td>
        </tr>
        <tr>
            <td class="text" style="text-align: right">(...................)</td>
        </tr>
    </table> --}}
</div>

@endsection