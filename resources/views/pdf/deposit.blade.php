@extends('layouts.pdf')
@section('title', 'Laporan Tabungan')
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
        </style>
    @endpush

    <div class="container">
        <h3 class="text-center" style="margin-bottom: 5px">Laporan Tabungan</h3>
        <table class="table" style="margin-top: 5px; margin-bottom: 15px">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>TANGGAL</th>
                    <th>KODE</th>
                    <th>NAMA KLIEN</th>
                    <th>JUMLAH</th>
                    <th>KETERANGAN</th>
                </tr>
            </thead>
            <tbody>
                @forelse($deposits as $key => $deposit)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($deposit->date)->format('d/m/Y') }}</td>
                        <td>{{ $deposit->code }}</td>
                        <td>{{ $deposit->client->name }}</td>
                        <td>{{ idr($deposit->amount) }}</td>
                        <td>{{ $deposit->description }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
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
