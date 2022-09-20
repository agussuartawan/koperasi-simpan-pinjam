<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <h6>Kode</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ $withdrawal->code }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Nama Klien</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ $withdrawal->client->name }} <div class="badge badge-info">
                    {{ $withdrawal->client->clientType->name }}</div>
            </h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Tanggal</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ Carbon\Carbon::parse($withdrawal->date)->format('d/m/Y') }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h6>Jumlah Tarikan</h6>
        </div>

        <div class="col-lg-9">
            <h6>: &ensp; {{ idr($withdrawal->amount) }}</h6>
        </div>
    </div>
</div>
