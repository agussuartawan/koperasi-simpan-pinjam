<div class="container">
    <div class="row">
        <div class="col-lg-2">
            <h6>Kode</h6>
        </div>

        <div class="col-lg-10">
            <h6>: &ensp; {{ $client->code }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <h6>NIK</h6>
        </div>

        <div class="col-lg-10">
            <h6>: &ensp; {{ $client->nik }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <h6>Nama</h6>
        </div>

        <div class="col-lg-10">
            <h6>: &ensp; {{ $client->name }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <h6>Jenis Kelamin</h6>
        </div>

        <div class="col-lg-10">
            <h6>: &ensp;
                @if ($client->gender == 'L')
                    Laki - Laki
                @else
                    Perempuan
                @endif
            </h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <h6>Alamat</h6>
        </div>

        <div class="col-lg-10">
            <h6>: &ensp; {{ $client->address }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <h6>No Telp</h6>
        </div>

        <div class="col-lg-10">
            <h6>: &ensp; {{ $client->phone }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <h6>Tipe Klien</h6>
        </div>

        <div class="col-lg-10">
            <h6>: &ensp; {{ $client->clientType->name }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">
            <h6>Status</h6>
        </div>

        <div class="col-lg-10">
            <h6>
                : &ensp;
                @if ($client->is_active == 1)
                    <span class="badge badge-success">Aktif</span>
                @else
                    <span class="badge badge-secondary">Nonaktif</span>
                @endif
            </h6>
        </div>
    </div>
</div>
