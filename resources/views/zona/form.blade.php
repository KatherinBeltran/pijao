<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('nom_zon', $zona->nom_zon, ['class' => 'form-control' . ($errors->has('nom_zon') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nom_zon', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20 text-center">
        <button type="submit" class="btn btn-outline-success btn-sm custom-btn">{{ __('Guardar') }}</button>
        <a href="{{ route('zonas.index') }}" class="btn btn-outline-danger btn-sm custom-btn">Cancelar</a>
    </div>
</div>