<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('nom_bar', $barrio->nom_bar, ['class' => 'form-control' . ($errors->has('nom_bar') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nom_bar', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Zona') }}
            {{ Form::select('zon_bar', $zonas->pluck('nom_zon', 'id'), $barrio->zon_bar, ['class' => 'form-control' . ($errors->has('zon_bar') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una zona']) }}
            {!! $errors->first('zon_bar', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20 text-center">
        <button type="submit" class="btn btn-outline-success btn-sm custom-btn">{{ __('Guardar') }}</button>
        <a href="{{ route('barrios.index') }}" class="btn btn-outline-danger btn-sm custom-btn">Cancelar</a>
    </div>
</div>