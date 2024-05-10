<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Fecha y hora') }}
            <input type="datetime-local" id="fec_gas" name="fec_gas" class="form-control{{ $errors->has('fec_gas') ? ' is-invalid' : '' }}" value="{{ $now }}">
            {!! $errors->first('fec_gas', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Monto') }}
            {{ Form::text('mon_gas', $gasto->mon_gas, ['class' => 'form-control' . ($errors->has('mon_gas') ? ' is-invalid' : ''), 'placeholder' => 'Monto']) }}
            {!! $errors->first('mon_gas', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Categoría') }}
            {{ Form::select('cat_gas', $categorias->pluck('nom_cat', 'id'), $gasto->cat_gas, ['class' => 'form-control' . ($errors->has('cat_gas') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una categoría']) }}
            {!! $errors->first('cat_gas', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20 text-center">
        <button type="submit" class="btn btn-outline-success btn-sm custom-btn">{{ __('Guardar') }}</button>
        <a href="{{ route('gastos.index') }}" class="btn btn-outline-danger btn-sm custom-btn">Cancelar</a>
    </div>
</div>