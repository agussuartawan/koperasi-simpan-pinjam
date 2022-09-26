<div class="card" id="report-table">
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead class="text-center">
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
                @forelse ($payments as $key => $payment)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}</td>
                        <td>{{ $payment->code }}</td>
                        <td>{{ $payment->client->name }}</td>
                        <td>({{ $payment->loan->code }}) {{ $payment->payment_on }}</td>
                        <td class="text-right">{{ idr($payment->mulct_idr) }}</td>
                        <td class="text-right">{{ idr($payment->total_amount) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data pada tabel</td>
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
    </div>
</div>
