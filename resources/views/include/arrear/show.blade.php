<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <h6>Kode</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ $loan->code }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Nama Klien</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ $loan->client->name }} <div class="badge badge-info">
                    {{ $loan->client->clientType->name }}</div>
            </h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Tanggal Pinjaman</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ Carbon\Carbon::parse($loan->date)->format('d/m/Y') }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Jumlah</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ idr($loan->amount) }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Bunga</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ idr($loan->bank_interest_idr) }} ({{ $loan->bank_interest }}%)</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Total Pinjaman</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ idr($loan->total_amount) }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Lama Peminjaman</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ $loan->term->description }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Status</h6>
        </div>

        <div class="col-lg-9">
            <h6>
                : &ensp;
                @if ($loan->is_paid == 1)
                    <div class="badge badge-success">Lunas</div>
                @else
                    <div class="badge badge-secondary">Belum Lunas</div>
                @endif
            </h6>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tanggal Jatuh Tempo</th>
                        <th>Angsuran ke</th>
                        <th>Saldo Tunggakan</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $now = \Carbon\Carbon::now()->toDateString();
                    @endphp
                    @foreach ($loan->paymentOverdue as $paymentOverdue)
                        @if ($paymentOverdue->overdue_date > $now)
                        @break
                    @endif
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($paymentOverdue->overdue_date)->format('d/m/Y') }}</td>
                        <td class="text-right">{{ $paymentOverdue->installment_to }}</td>
                        <td class="text-right">{{ idr($loan->total_amount / $loan->term->term_day) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
