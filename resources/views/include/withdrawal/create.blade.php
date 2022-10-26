{!! Form::model($withdrawal, [
    'route' => 'withdrawals.store',
    'method' => 'POST',
    'id' => 'form-withdrawal',
]) !!}

<div class="form-group">
    <label for="code">{{ __('Kode') }}</label>
    {!! Form::text('code', \App\Models\Withdrawal::getNextCode(), [
        'class' => 'form-control',
        'id' => 'code',
        'disabled' => true,
    ]) !!}
</div>

<div class="form-group">
    <div class="row">
        <div class="col-lg-8">
            <label for="client_id">{{ __('Klien') }}</label>
            {!! Form::select('client_id', [], null, [
                'class' => 'form-control custom-select',
                'id' => 'client_id',
            ]) !!}

        </div>

        <div class="col-lg-4">
            <label for="client_balance">{{ __('Sisa Saldo') }}</label>
            {!! Form::text('client_balance', null, [
                'class' => 'form-control',
                'id' => 'client_balance',
                'disabled' => true,
            ]) !!}
        </div>
    </div>

</div>

<div class="form-group">
    <label for="date">{{ __('Tanggal') }}</label>
    {!! Form::date('date', now(), ['class' => 'form-control', 'id' => 'date']) !!}
</div>

<div class="form-group">
    <label for="amount">{{ __('Jumlah') }}</label>
    {!! Form::text('amount', null, ['class' => 'form-control currency', 'id' => 'amount', 'disabled' => true]) !!}
</div>

<div class="form-group">
    <label for="description">{{ __('Keterangan') }}</label>
    {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description', 'rows' => 1]) !!}
</div>

{!! Form::close() !!}
