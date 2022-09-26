<div class="card" id="report-table">
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead class="text-center">
                <tr>
                    <th>No.</th>
                    <th>Tgl</th>
                    <th>Kode</th>
                    <th>Nama Klien</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($withdrawals as $key => $withdrawal)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($withdrawal->date)->format('d/m/Y') }}</td>
                        <td>{{ $withdrawal->code }}</td>
                        <td>{{ $withdrawal->client->name }}</td>
                        <td>{{ $withdrawal->description }}</td>
                        <td class="text-right">{{ idr($withdrawal->amount) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data pada tabel</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-center">Jumlah</td>
                    <td class="text-right">{{ idr($withdrawals->sum('amount')) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
