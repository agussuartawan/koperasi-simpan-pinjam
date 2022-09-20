{!! Form::model($deposit, [
    'route' => 'deposits.store',
    'method' => 'POST',
    'id' => 'form-deposit',
]) !!}

<div class="form-group">
    <label for="code">{{ __('Kode') }}</label>
    {!! Form::text('code', null, ['class' => 'form-control', 'id' => 'code']) !!}
</div>

<div class="form-group">
    <label for="client_id">{{ __('Klien') }}</label>
    {!! Form::select('client_id', [], null, [
        'class' => 'form-control custom-select',
        'id' => 'client_id',
    ]) !!}
</div>

<div class="form-group">
    <label for="date">{{ __('Tanggal') }}</label>
    {!! Form::date('date', now(), ['class' => 'form-control', 'id' => 'date']) !!}
</div>

<div class="form-group">
    <label for="deposit_type">{{ __('Tipe Setoran') }}</label>
    {!! Form::select('deposit_type_id', [], null, [
        'class' => 'form-control custom-select',
        'id' => 'deposit_type',
    ]) !!}
</div>

<div class="form-group">
    <label for="amount">{{ __('Jumlah') }}</label>
    {!! Form::text('amount', null, ['class' => 'form-control currency', 'id' => 'amount']) !!}
</div>

<div class="form-group">
    <label for="description">{{ __('Keterangan') }}</label>
    {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description', 'rows' => 1]) !!}
</div>

{!! Form::close() !!}
