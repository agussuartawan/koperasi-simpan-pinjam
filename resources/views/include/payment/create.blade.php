{!! Form::model($payment, [
    'route' => 'payments.store',
    'method' => 'POST',
    'id' => 'form-payment',
]) !!}

<div class="form-group">
    <label for="code">{{ __('Kode') }}</label>
    {!! Form::text('code', null, ['class' => 'form-control', 'id' => 'code']) !!}
</div>

<div class="form-group">
    <div class="row">
        <div class="col-lg-6">
            <label for="client_id">{{ __('Klien') }}</label>
            {!! Form::select('client_id', [], null, [
                'class' => 'form-control custom-select',
                'id' => 'client_id',
            ]) !!}
        </div>

        <div class="col-lg-6">
            <label for="loan_id">{{ __('Pilih Hutang') }}</label>
            {!! Form::select('loan_id', [], null, [
                'class' => 'form-control custom-select',
                'id' => 'loan_id',
                'placeholder' => 'Pilih hutang klien',
            ]) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <label for="date">{{ __('Tanggal') }}</label>
    {!! Form::date('date', now(), ['class' => 'form-control', 'id' => 'date']) !!}
</div>

<div class="form-group">
    <label for="installment">{{ __('Angsuran ke') }}</label>
    {!! Form::text('installment', null, [
        'class' => 'form-control',
        'id' => 'installment',
        'disabled' => true,
    ]) !!}
</div>

<div class="form-group">
    <div class="row">
        <div class="col-lg-6">
            <label for="amount">{{ __('Jumlah') }}</label>
            {!! Form::text('amount', null, [
                'class' => 'form-control currency',
                'id' => 'amount',
                'disabled' => true,
            ]) !!}
        </div>

        <div class="col-lg-6">
            <label for="mulct">{{ __('Denda(%)') }}</label>
            {!! Form::number('mulct', 0, [
                'class' => 'form-control',
                'id' => 'mulct',
            ]) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <label for="total_amount">{{ __('Jumlah yang harus dibayarkan') }}</label>
    {!! Form::text('total_amount', null, [
        'class' => 'form-control currency',
        'id' => 'total_amount',
        'disabled' => true,
    ]) !!}
</div>

{!! Form::close() !!}
