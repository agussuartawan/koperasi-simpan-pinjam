<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <h6>Kode</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ $deposit->code }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Tipe Setoran</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ $deposit->depositType->name }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Nama Klien</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ $deposit->client->name }} <div class="badge badge-info">
                    {{ $deposit->client->clientType->name }}</div>
            </h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Tanggal</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ Carbon\Carbon::parse($deposit->date)->format('d/m/Y') }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Jumlah Setoran</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ idr($deposit->amount) }}</h6>
        </div>
    </div>
</div>
