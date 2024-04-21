<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('nom_cli', $cliente->nom_cli, ['class' => 'form-control' . ($errors->has('nom_cli') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nom_cli', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('No. de cédula') }}
            {{ Form::text('num_ced_cli', $cliente->num_ced_cli, ['class' => 'form-control' . ($errors->has('num_ced_cli') ? ' is-invalid' : ''), 'placeholder' => 'No. de cédula']) }}
            {!! $errors->first('num_ced_cli', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('No. de celular') }}
            {{ Form::text('num_cel_cli', $cliente->num_cel_cli, ['class' => 'form-control' . ($errors->has('num_cel_cli') ? ' is-invalid' : ''), 'placeholder' => 'No. de celular']) }}
            {!! $errors->first('num_cel_cli', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Dirección') }}
            {{ Form::text('dir_cli', $cliente->dir_cli, ['class' => 'form-control' . ($errors->has('dir_cli') ? ' is-invalid' : ''), 'placeholder' => 'Dirección']) }}
            {!! $errors->first('dir_cli', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Barrio') }}
            {{ Form::text('bar_cli', $cliente->bar_cli, ['class' => 'form-control' . ($errors->has('bar_cli') ? ' is-invalid' : ''), 'placeholder' => 'Barrio']) }}
            {!! $errors->first('bar_cli', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20 text-center">
        <button type="submit" class="btn btn-outline-success btn-sm custom-btn">{{ __('Guardar') }}</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-outline-danger btn-sm custom-btn">Cancelar</a>
    </div>
</div>