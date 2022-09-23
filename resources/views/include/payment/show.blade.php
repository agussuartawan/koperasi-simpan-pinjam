<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <h6>Kode</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ $payment->code }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Nama Klien</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ $payment->client->name }} <div class="badge badge-info">
                    {{ $payment->client->clientType->name }}</div>
            </h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Tanggal</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Angsuran ke</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ $payment->payment_on }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Jumlah</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ idr($payment->amount) }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Denda</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ idr($payment->mulct_idr) }} ({{ $payment->mulct }}%)</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Total Pembayaran</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ idr($payment->total_amount) }}</h6>
        </div>
    </div>
</div>
