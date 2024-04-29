<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Código préstamo') }}
            {{ Form::select('pre_cuo', $prestamos,  $prestamo_id, ['class' => 'form-control', 'id' => 'pre_cuo_select', 'placeholder' => 'Seleccione un código de prestamo']) }}
            {!! $errors->first('pre_cuo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Fecha') }}
            <input type="text" id="fec_cuo" name="fec_cuo" class="form-control{{ $errors->has('fec_cuo') ? ' is-invalid' : '' }}" value="{{ $cuota->fec_cuo }}" readonly>
            {!! $errors->first('fec_cuo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Valor') }}
            {{ Form::text('val_cuo', $cuota->val_cuo, ['class' => 'form-control' . ($errors->has('val_cuo') ? ' is-invalid' : ''), 'placeholder' => 'Valor', 'id' => 'val_cuo']) }}
            {!! $errors->first('val_cuo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Total abonado') }}
            {{ Form::text('tot_abo_cuo', $cuota->tot_abo_cuo, ['class' => 'form-control' . ($errors->has('tot_abo_cuo') ? ' is-invalid' : ''), 'placeholder' => 'Total abonado', 'id' => 'tot_abo_cuo', 'readonly' => 'disabled']) }}
            {!! $errors->first('tot_abo_cuo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Saldo') }}
            {{ Form::text('sal_cuo', $cuota->sal_cuo, ['class' => 'form-control' . ($errors->has('sal_cuo') ? ' is-invalid' : ''), 'placeholder' => 'Saldo', 'id' => 'sal_cuo', 'readonly' => 'disabled']) }}
            {!! $errors->first('sal_cuo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Número') }}
            {{ Form::text('num_cuo', $cuota->num_cuo, ['class' => 'form-control' . ($errors->has('num_cuo') ? ' is-invalid' : ''), 'placeholder' => 'Número', 'readonly' => 'disabled']) }}
            {!! $errors->first('num_cuo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Observación') }}
            {{ Form::text('obs_cuo', $cuota->obs_cuo, ['class' => 'form-control' . ($errors->has('obs_cuo') ? ' is-invalid' : ''), 'placeholder' => 'Observación']) }}
            {!! $errors->first('obs_cuo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20 text-center">
        <button type="submit" class="btn btn-outline-success btn-sm custom-btn">{{ __('Guardar') }}</button>
        <a href="{{ route('cuotas.index') }}" class="btn btn-outline-danger btn-sm custom-btn">Cancelar</a>
    </div>
</div>

<script>
    // Función para calcular el saldo
    function calcularSaldo() {
        const valCuo = parseFloat(document.getElementById('tot_abo_cuo').value);
        const totPre = parseFloat({{ $prestamo->tot_pre }});
        const salCuo = totPre - valCuo;
        document.getElementById('sal_cuo').value = salCuo;
    }

    // Función para calcular el total abonado
    function calcularTotalAbonado() {
        // Obtener el valor de val_cuo y val_pag_pre
        var valCuo = parseFloat(document.getElementById('val_cuo').value);
        var valPagPre = parseFloat({{ $prestamo->val_pag_pre }});

        // Calcular el total abonado
        var totalAbonado = valCuo + valPagPre;

        // Actualizar el valor en el campo tot_abo_cuo
        document.getElementById('tot_abo_cuo').value = totalAbonado;

        // Llamar a la función para calcular el saldo
        calcularSaldo();
    }

    // Función para ejecutar el cálculo cuando se cambie el valor de val_cuo
    document.getElementById('val_cuo').addEventListener('input', calcularTotalAbonado);

    // Llamar a la función inicialmente para asegurar que el campo tot_abo_cuo esté actualizado
    calcularTotalAbonado();

    // Llamar a la función para calcular el saldo cuando se cambie el valor en tot_abo_cuo
    document.getElementById('tot_abo_cuo').addEventListener('input', calcularSaldo);
</script>