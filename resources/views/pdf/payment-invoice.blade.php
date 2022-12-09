@extends('layouts.pdf')
@section('title', 'Nota Pembayaran {{ $payment->code }}')
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

            .header {
                float: right;
            }
        </style>
    @endpush

    @php
        $status = "Belum Lunas";
        if($payment->loan->is_paid === 1){
            $status = "Lunas";
        }
    @endphp
    <div class="container">
        <table width="100%">
            <tr>
                <td align="right">
                    <h3>Nota Pembayaran</h3>
                    <pre>
                        No. {{ $payment->code }}
                        Tgl. {{ \Carbon\Carbon::parse($payment->date)->isoFormat("DD/MM/Y") }}
                        Status. {{ $status }}
                        Sisa Pinjaman. {{ idr($payment->client->debt->sum("amount")) }}
                        Petugas. {{ $payment->user->name }}
                    </pre>
                </td>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <td><strong>Dari:</strong> {{ env('APP_NAME') }}</td>
                <td><strong>To:</strong> {{ $payment->client->name }}</td>
            </tr>
        
        </table>

        <br/>

        <table width="100%">
            <thead style="background-color: lightgray;">
                <tr style="font-size: 12px">
                    <th>#</th>
                    <th>Keterangan</th>
                    <th>Angsuran ke</th>
                    <th>Subtotal</th>
                    <th>Denda</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                <tr style="font-size: 12px;">
                    <th scope="row">1</th>
                    <td>Pembayaran pinjaman no. <strong>{{ $payment->code }}</strong></td>
                    <td align="center">{{ $payment->payment_on }}</td>
                    <td align="right">{{ idr($payment->amount) }}</td>
                    <td align="right">{{ idr($payment->mulct_idr) }}</td>
                    <td align="right">{{ idr($payment->total_amount) }}</td>
                </tr>
                <tr></tr>
            </tbody>

            <tfoot>
                <tr style="font-size: 12px">
                    <td colspan="4"></td>
                    <td align="right">Subtotal</td>
                    <td align="right">{{ idr($payment->amount) }}</td>
                </tr>
                <tr style="font-size: 12px">
                    <td colspan="4"></td>
                    <td align="right">Denda</td>
                    <td align="right">{{ idr($payment->mulct_idr) }}</td>
                </tr>
                <tr style="font-size: 12px">
                    <td colspan="4"></td>
                    <td align="right">Total</td>
                    <td align="right" class="gray">{{ idr($payment->total_amount) }}</td>
                </tr>
            </tfoot>
        </table>

        <i style="font-size: 10px;">Nota dicetak oleh <strong>{{ auth()->user()->name }}</strong></i>
    </div>

@endsection
