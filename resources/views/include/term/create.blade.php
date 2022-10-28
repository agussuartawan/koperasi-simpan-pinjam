{!! Form::model($terms, [
    'route' => 'terms.store',
    'method' => 'POST',
    'id' => 'form-term',
]) !!}

<div class="form-group">
    <label for="term_day">{{ __('Lama Pinjaman') }}</label>
    {!! Form::number('term_day', null, ['class' => 'form-control', 'id' => 'term_day']) !!}
</div>

<div class="form-group">
    <label for="description">{{ __('Keterangan') }}</label>
    {!! Form::text('description', null, ['class' => 'form-control', 'id' => 'description']) !!}
</div>

{!! Form::close() !!}
