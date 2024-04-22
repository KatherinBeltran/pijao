<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Código cliente') }}
            {{ Form::select('cli_cuo', $clientes, $cliente_id, ['class' => 'form-control', 'id' => 'cli_cuo_select', 'placeholder' => 'Seleccione un código de cliente']) }}
            {!! $errors->first('cli_cuo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
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
            {{ Form::text('tot_abo_cuo', $cuota->tot_abo_cuo, ['class' => 'form-control' . ($errors->has('tot_abo_cuo') ? ' is-invalid' : ''), 'placeholder' => 'Total abonado']) }}
            {!! $errors->first('tot_abo_cuo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Saldo') }}
            {{ Form::text('sal_cuo', $cuota->sal_cuo, ['class' => 'form-control' . ($errors->has('sal_cuo') ? ' is-invalid' : ''), 'placeholder' => 'Saldo', 'id' => 'sal_cuo']) }}
            {!! $errors->first('sal_cuo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Número') }}
            {{ Form::text('num_cuo', $cuota->num_cuo, ['class' => 'form-control' . ($errors->has('num_cuo') ? ' is-invalid' : ''), 'placeholder' => 'Número']) }}
            {!! $errors->first('num_cuo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20 text-center">
        <button type="submit" class="btn btn-outline-success btn-sm custom-btn">{{ __('Guardar') }}</button>
        <a href="{{ route('cuotas.index') }}" class="btn btn-outline-danger btn-sm custom-btn">Cancelar</a>
    </div>
</div>

<script>
    document.getElementById('val_cuo').addEventListener('input', function() {
        const valCuo = parseFloat(this.value);
        const totPre = parseFloat({{ $prestamo->tot_pre }});
        const totAboCuo = totPre - valCuo;
        document.getElementById('sal_cuo').value = totAboCuo;
    });
</script>