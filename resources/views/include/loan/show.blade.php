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
            <h6>Tanggal</h6>
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
</div>
