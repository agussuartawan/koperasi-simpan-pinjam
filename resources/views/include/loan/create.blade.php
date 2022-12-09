{!! Form::model($loan, [
    'route' => 'loans.store',
    'method' => 'POST',
    'id' => 'form-loan',
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
    <div class="row">
        <div class="col-lg-6">
            <label for="date">{{ __('Tanggal') }}</label>
            {!! Form::date('date', now(), ['class' => 'form-control', 'id' => 'date', 'readonly' => true]) !!}
        </div>

        <div class="col-lg-6">
            <label for="term_id">{{ __('Lama Pinjaman') }}</label>
            {!! Form::select('term_id', $terms, null, [
                'class' => 'form-control custom-select',
                'id' => 'term_id',
            ]) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-lg-4">
            <label for="amount">{{ __('Jumlah') }}</label>
            {!! Form::text('amount', null, ['class' => 'form-control currency', 'id' => 'amount']) !!}
        </div>
        <div class="col-lg-4">
            <label for="bank_interest">{{ __('Bunga(%)') }}</label>
            {!! Form::number('bank_interest', 20, ['class' => 'form-control', 'id' => 'bank_interest']) !!}
        </div>

        <div class="col-lg-4">
            <label for="bank_interest_rp">{{ __('Bunga(Rp.)') }}</label>
            {!! Form::text('bank_interest_rp', null, [
                'class' => 'form-control currency',
                'id' => 'bank_interest_rp',
                'disabled' => true,
            ]) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <label for="total_amount">{{ __('Jumlah Total') }}</label>
    {!! Form::text('total_amount', null, [
        'class' => 'form-control currency',
        'id' => 'total_amount',
        'disabled' => true,
    ]) !!}
</div>

{!! Form::close() !!}
