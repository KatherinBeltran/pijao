<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('nom_cob', $cobradore->nom_cob, ['class' => 'form-control' . ($errors->has('nom_cob') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nom_cob', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('No. de cédula') }}
            {{ Form::text('num_ced_cob', $cobradore->num_ced_cob, ['class' => 'form-control' . ($errors->has('num_ced_cob') ? ' is-invalid' : ''), 'placeholder' => 'No. de cédula']) }}
            {!! $errors->first('num_ced_cob', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('No. de celular') }}
            {{ Form::text('num_cel_cob', $cobradore->num_cel_cob, ['class' => 'form-control' . ($errors->has('num_cel_cob') ? ' is-invalid' : ''), 'placeholder' => 'No. de celular']) }}
            {!! $errors->first('num_cel_cob', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Dirección') }}
            {{ Form::text('dir_cob', $cobradore->dir_cob, ['class' => 'form-control' . ($errors->has('dir_cob') ? ' is-invalid' : ''), 'placeholder' => 'Dirección']) }}
            {!! $errors->first('dir_cob', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Barrio') }}
            {{ Form::text('bar_cob', $cobradore->bar_cob, ['class' => 'form-control' . ($errors->has('bar_cob') ? ' is-invalid' : ''), 'placeholder' => 'Barrio']) }}
            {!! $errors->first('bar_cob', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20 text-center">
        <button type="submit" class="btn btn-outline-success btn-sm custom-btn">{{ __('Guardar') }}</button>
        <a href="{{ route('cobradores.index') }}" class="btn btn-outline-danger btn-sm custom-btn">Cancelar</a>
    </div>
</div>