<div class="card" id="report-table">
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead class="text-center">
                <tr>
                    <th>No.</th>
                    <th>Tgl</th>
                    <th>Kode</th>
                    <th>Nama Klien</th>
                    <th>Angsuran</th>
                    <th>Bunga</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($loans as $key => $loan)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($loan->date)->format('d/m/Y') }}</td>
                        <td>{{ $loan->code }}</td>
                        <td>{{ $loan->client->name }}</td>
                        <td>{{ $loan->term->description }}</td>
                        <td class="text-right">{{ idr($loan->bank_interest_idr) }}</td>
                        <td class="text-right">{{ idr($loan->total_amount) }}</td>
                        <td>
                            {{ $loan->is_paid === 1 ? 'Lunas' : 'Belum Lunas' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data pada tabel</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-center">Jumlah</td>
                    <td class="text-right">{{ idr($loans->sum('bank_interest_idr')) }}</td>
                    <td class="text-right">{{ idr($loans->sum('total_amount')) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
