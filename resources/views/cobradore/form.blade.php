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
            {{ Form::label('Correo electrónico') }}
            {{ Form::text('cor_ele_cob', $cobradore->cor_ele_cob, ['class' => 'form-control' . ($errors->has('cor_ele_cob') ? ' is-invalid' : ''), 'value' => "@inversionespijao.com", 'id' => 'cor_ele_cob', 'placeholder' => 'Correo electrónico']) }}
            {!! $errors->first('cor_ele_cob', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Dirección') }}
            {{ Form::text('dir_cob', $cobradore->dir_cob, ['class' => 'form-control' . ($errors->has('dir_cob') ? ' is-invalid' : ''), 'placeholder' => 'Dirección']) }}
            {!! $errors->first('dir_cob', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Barrio') }}
            {{ Form::select('bar_cob', $barrios->pluck('nom_bar', 'id'), $cobradore->bar_cob, ['class' => 'form-control' . ($errors->has('bar_cob') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un barrio']) }}
            {!! $errors->first('bar_cob', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Zona') }}
            {{ Form::select('zon_cob', $zonas->pluck('nom_zon', 'id'), $cobradore->zon_cob, ['class' => 'form-control' . ($errors->has('zon_cob') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una zona']) }}
            {!! $errors->first('zon_cob', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20 text-center">
        <button type="submit" class="btn btn-outline-success btn-sm custom-btn">{{ __('Guardar') }}</button>
        <a href="{{ route('cobradores.index') }}" class="btn btn-outline-danger btn-sm custom-btn">Cancelar</a>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const emailInput = document.getElementById('cor_ele_cob');
        const domain = '@inversionespijao.com';

        emailInput.addEventListener('focus', function () {
            // Cuando el campo recibe el enfoque, asegúrate de que el usuario pueda editar el campo completo
            emailInput.value = emailInput.value.replace(domain, '');
        });

        emailInput.addEventListener('blur', function () {
            // Al salir del campo, vuelve a agregar el dominio si es necesario
            if (emailInput.value.trim() !== '' && !emailInput.value.includes(domain)) {
            emailInput.value += domain;
            }
        });
    });
</script>