{!! Form::model($client, [
    'route' => 'clients.store',
    'method' => 'POST',
    'id' => 'form-client',
]) !!}

<div class="form-group">
    <label for="code">{{ __('Kode') }}</label>
    {!! Form::text('code', null, ['class' => 'form-control', 'id' => 'code']) !!}
</div>

<div class="form-group">
    <div class="form-row">
        <div class="col">
            <label for="nik">{{ __('NIK') }}</label>
            {!! Form::text('nik', null, ['class' => 'form-control', 'id' => 'nik']) !!}
        </div>

        <div class="col">
            <label for="name">{{ __('Nama Klien') }}</label>
            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <label for="gender">{{ __('Jenis Kelamin') }}</label>
    {!! Form::select('gender', ['L' => 'Laki - laki', 'P' => 'Perempuan'], null, [
        'class' => 'form-control custom-select',
        'id' => 'gender',
    ]) !!}
</div>

<div class="form-group">
    <label for="phone">{{ __('No Telp') }}</label>
    {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone']) !!}
</div>

<div class="form-group">
    <label for="address">{{ __('Alamat') }}</label>
    {!! Form::textarea('address', null, ['class' => 'form-control', 'id' => 'address', 'rows' => 1]) !!}
</div>

<div class="form-group">
    <label for="client_type_id">{{ __('Tipe Pelanggan') }}</label>
    {!! Form::select('client_type_id', $client_type, null, [
        'class' => 'form-control custom-select',
        'id' => 'client_type_id',
    ]) !!}
</div>

{!! Form::close() !!}
