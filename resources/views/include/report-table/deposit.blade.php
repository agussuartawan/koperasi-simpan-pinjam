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
                @forelse ($deposits as $key => $deposit)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($deposit->date)->format('d/m/Y') }}</td>
                        <td>{{ $deposit->code }}</td>
                        <td>{{ $deposit->client->name }}</td>
                        <td>{{ $deposit->description }}</td>
                        <td class="text-right">{{ idr($deposit->amount) }}</td>
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
                    <td class="text-right">{{ idr($deposits->sum('amount')) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
