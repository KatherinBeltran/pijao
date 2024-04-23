<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
        
                <div class="form-group">
                    {{ Form::label('Código cliente') }}
                    {{ Form::select('cli_pre', $clientes, $cliente_id, ['class' => 'form-control' . ($errors->has('cli_pre') ? ' is-invalid' : ''), 'id' => 'cli_pre_select', 'placeholder' => 'Seleccione un código de cliente']) }}
                    {!! $errors->first('cli_pre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Fecha y hora') }}
                    <input type="datetime-local" id="fec_pre" name="fec_pre" class="form-control{{ $errors->has('fec_pre') ? ' is-invalid' : '' }}" value="{{ $now }}" readonly disabled>
                    {!! $errors->first('fec_pre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Fecha pago anticipado') }}
                    <input type="datetime-local" name="fec_pag_ant_pre" class="form-control{{ $errors->has('fec_pag_ant_pre') ? ' is-invalid' : '' }}" value="{{ $prestamo->fec_pag_ant_pre }}" placeholder="Fecha pago anticipado">
                    {!! $errors->first('fec_pag_ant_pre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Cobros y/o pagos') }}
                    {{ Form::select('pag_pre', ['Diario' => 'Diario', 'Mensual' => 'Mensual'], $prestamo->pag_pre, ['id' => 'pag_pre', 'class' => 'form-control' . ($errors->has('pag_pre') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una opción']) }}
                    {!! $errors->first('pag_pre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Cuotas') }}
                    {{ Form::text('cuo_pre', $prestamo->cuo_pre, ['id' => 'cuo_pre', 'class' => 'form-control' . ($errors->has('cuo_pre') ? ' is-invalid' : ''), 'placeholder' => 'Cuotas', 'oninput' => 'calcularCuota()']) }}
                    {!! $errors->first('cuo_pre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Capital') }}
                    {{ Form::text('cap_pre', $prestamo->cap_pre, ['id' => 'cap_pre', 'class' => 'form-control' . ($errors->has('cap_pre') ? ' is-invalid' : ''), 'placeholder' => 'Capital', 'oninput' => 'calcularTotal(); calcularCuota()']) }}
                    {!! $errors->first('cap_pre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Interes %') }}
                    {{ Form::text('interes', 20, ['id' => 'interes', 'class' => 'form-control', 'readonly']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('Total a pagar') }}
                    {{ Form::text('tot_pre', $prestamo->tot_pre, ['id' => 'tot_pre', 'class' => 'form-control' . ($errors->has('tot_pre') ? ' is-invalid' : ''), 'placeholder' => 'Total a pagar', 'readonly']) }}
                    {!! $errors->first('tot_pre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div> 
            <div class="col-md-6">   
                <div class="form-group">
                    {{ Form::label('Valor cuota') }}
                    {{ Form::text('val_cuo_pre', $prestamo->val_cuo_pre, ['id' => 'val_cuo_pre', 'class' => 'form-control' . ($errors->has('val_cuo_pre') ? ' is-invalid' : ''), 'placeholder' => 'Valor cuota', 'readonly']) }}
                    {!! $errors->first('val_cuo_pre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Cuotas pagadas') }}
                    {{ Form::text('cuo_pag_pre', $prestamo->cuo_pag_pre, ['class' => 'form-control' . ($errors->has('cuo_pag_pre') ? ' is-invalid' : ''), 'placeholder' => 'Cuotas pagadas', 'readonly' => 'disabled']) }}
                    {!! $errors->first('cuo_pag_pre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Valor pagado') }}
                    {{ Form::text('val_pag_pre', $prestamo->val_pag_pre, ['class' => 'form-control' . ($errors->has('val_pag_pre') ? ' is-invalid' : ''), 'placeholder' => 'Valor pagado', 'readonly' => 'disabled']) }}
                    {!! $errors->first('val_pag_pre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Siguiente cuota') }}
                    {{ Form::text('sig_cuo_pre', $prestamo->sig_cuo_pre, ['class' => 'form-control' . ($errors->has('sig_cuo_pre') ? ' is-invalid' : ''), 'placeholder' => 'Siguiente cuota', 'readonly' => 'disabled']) }}
                    {!! $errors->first('sig_cuo_pre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Cuotas pendientes') }}
                    {{ Form::text('cuo_pen_pre', $prestamo->cuo_pen_pre, ['class' => 'form-control' . ($errors->has('cuo_pen_pre') ? ' is-invalid' : ''), 'placeholder' => 'Cuotas pendientes', 'readonly' => 'disabled']) }}
                    {!! $errors->first('cuo_pen_pre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Valor cuotas pendientes') }}
                    {{ Form::text('val_cuo_pen_pre', $prestamo->val_cuo_pen_pre, ['class' => 'form-control' . ($errors->has('val_cuo_pen_pre') ? ' is-invalid' : ''), 'placeholder' => 'Valor cuotas pendientes', 'readonly' => 'disabled']) }}
                    {!! $errors->first('val_cuo_pen_pre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Estado') }}
                    {{ Form::text('est_pag_pre', $prestamo->est_pag_pre, ['class' => 'form-control' . ($errors->has('est_pag_pre') ? ' is-invalid' : ''), 'placeholder' => 'Estado']) }}
                    {!! $errors->first('est_pag_pre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Dias en mora') }}
                    {{ Form::text('dia_mor_pre', $prestamo->dia_mor_pre, ['class' => 'form-control' . ($errors->has('dia_mor_pre') ? ' is-invalid' : ''), 'placeholder' => 'Dias en mora']) }}
                    {!! $errors->first('dia_mor_pre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
    </div>
    <div class="box-footer mt20 text-center">
        <button type="submit" class="btn btn-outline-success btn-sm custom-btn">{{ __('Guardar') }}</button>
        <a href="{{ route('prestamos.index') }}" class="btn btn-outline-danger btn-sm custom-btn">Cancelar</a>
    </div>
</div>
<script>
    // Función para calcular el total a pagar
    function calcularTotal() {
        var capital = parseFloat(document.getElementById('cap_pre').value);
        var interes = parseFloat(document.getElementById('interes').value);
        
        // Calcular el total a pagar
        var total = capital + (capital * (interes / 100));
        
        // Mostrar el resultado en el campo correspondiente
        document.getElementById('tot_pre').value = total.toFixed(0);
    }

    // Llamar a la función al cargar la página
    calcularTotal();
</script>

<script>
    // Función para calcular el valor de la cuota
    function calcularCuota() {
        var total = parseFloat(document.getElementById('tot_pre').value);
        var cuotas = parseFloat(document.getElementById('cuo_pre').value);

        // Calcular el valor de la cuota
        var valorCuota = total / cuotas;

        // Mostrar el resultado en el campo correspondiente
        document.getElementById('val_cuo_pre').value = valorCuota.toFixed(0);
    }

    // Llamar a la función al cargar la página
    calcularCuota();
</script>