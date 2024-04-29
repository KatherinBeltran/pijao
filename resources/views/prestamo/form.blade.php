<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
        
            <div class="form-group">
                {{ Form::label('Nombre') }}
                {{ Form::text('nom_cli_pre', $prestamo->nom_cli_pre, ['class' => 'form-control' . ($errors->has('nom_cli_pre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                {!! $errors->first('nom_cli_pre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('No. de cédula') }}
                {{ Form::text('num_ced_cli_pre', $prestamo->num_ced_cli_pre, ['class' => 'form-control' . ($errors->has('num_ced_cli_pre') ? ' is-invalid' : ''), 'placeholder' => 'No. de cédula']) }}
                {!! $errors->first('num_ced_cli_pre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('No. de celular') }}
                {{ Form::text('num_cel_cli_pre', $prestamo->num_cel_cli_pre, ['class' => 'form-control' . ($errors->has('num_cel_cli_pre') ? ' is-invalid' : ''), 'placeholder' => 'No. de celular']) }}
                {!! $errors->first('num_cel_cli_pre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('Dirección') }}
                {{ Form::text('dir_cli_pre', $prestamo->dir_cli_pre, ['class' => 'form-control' . ($errors->has('dir_cli_pre') ? ' is-invalid' : ''), 'placeholder' => 'Dirección']) }}
                {!! $errors->first('dir_cli_pre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('Barrio') }}
                {{ Form::select('bar_cli_pre', $barrios->pluck('nom_bar', 'id'), $prestamo->bar_cli_pre, ['class' => 'form-control' . ($errors->has('bar_cli_pre') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un barrio']) }}
                {!! $errors->first('bar_cli_pre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('Fecha y hora') }}
                <input type="datetime-local" id="fec_pre" name="fec_pre" class="form-control{{ $errors->has('fec_pre') ? ' is-invalid' : '' }}" value="{{ $now }}">
                {!! $errors->first('fec_pre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('Fecha pago anticipado') }}
                <input type="datetime-local" name="fec_pag_ant_pre" class="form-control{{ $errors->has('fec_pag_ant_pre') ? ' is-invalid' : '' }}" value="{{ $prestamo->fec_pag_ant_pre }}" placeholder="Fecha pago anticipado">
                {!! $errors->first('fec_pag_ant_pre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('Cobros y/o pagos') }}
                {{ Form::select('pag_pre', ['Diario' => 'Diario', 'Semanal' => 'Semanal', 'Quincenal' => 'Quincenal', 'Mensual' => 'Mensual'], $prestamo->pag_pre, ['id' => 'pag_pre', 'class' => 'form-control' . ($errors->has('pag_pre') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una opción', 'onchange' => 'calcularCuotaPredeterminada(); calcularCuota()']) }}
                {!! $errors->first('pag_pre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('Cuotas') }}
                {{ Form::text('cuo_pre', $prestamo->cuo_pre, ['id' => 'cuo_pre', 'class' => 'form-control' . ($errors->has('cuo_pre') ? ' is-invalid' : ''), 'placeholder' => 'Cuotas', 'oninput' => 'calcularCuota()']) }}
                {!! $errors->first('cuo_pre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('Capital') }}
                {{ Form::text('cap_pre', $prestamo->cap_pre, ['id' => 'cap_pre', 'class' => 'form-control' . ($errors->has('cap_pre') ? ' is-invalid' : ''), 'placeholder' => 'Capital', 'oninput' => 'formatearNumero(this); calcularTotal(); calcularCuota()']) }}
                {!! $errors->first('cap_pre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div> 
        <div class="col-md-6">   
            <div class="form-group">
                {{ Form::label('Interes %') }}
                {{ Form::text('interes', 20, ['id' => 'interes', 'class' => 'form-control', 'readonly']) }}
            </div>
            <div class="form-group">
                {{ Form::label('Total a pagar') }}
                {{ Form::text('tot_pre', $prestamo->tot_pre, ['id' => 'tot_pre', 'class' => 'form-control' . ($errors->has('tot_pre') ? ' is-invalid' : ''), 'placeholder' => 'Total a pagar', 'readonly']) }}
                {!! $errors->first('tot_pre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
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
    // Función para calcular la cuota predeterminada
    function calcularCuotaPredeterminada() {
        var pagPre = document.getElementById('pag_pre').value;
        var cuoPreInput = document.getElementById('cuo_pre');

        // Verificar si el campo cuo_pre ha sido editado manualmente por el usuario
        var editedManually = cuoPreInput.dataset.edited === 'true';

        if (!editedManually) {
            switch (pagPre) {
                case 'Diario':
                    cuoPreInput.value = 30;
                    break;
                case 'Semanal':
                    cuoPreInput.value = 4;
                    break;
                case 'Quincenal':
                    cuoPreInput.value = 2;
                    break;
                case 'Mensual':
                    cuoPreInput.value = 1;
                    break;
                default:
                    // No hacer nada si la opción seleccionada no coincide con ninguna de las opciones anteriores
                    break;
            }
        }
    }

    // Llamar a la función calcularCuotaPredeterminada() cuando se cambie la opción en el campo pag_pre
    document.getElementById('pag_pre').addEventListener('change', calcularCuotaPredeterminada);

    // Marcar el campo cuo_pre como editado cuando el usuario lo edite manualmente
    document.getElementById('cuo_pre').addEventListener('input', function() {
        this.dataset.edited = 'true';
    });
</script>

<script>
    // Función para calcular el total a pagar
    function calcularTotal() {
        var capital = parseFloat(document.getElementById('cap_pre').value);
        var interes = parseFloat(document.getElementById('interes').value);

        // Verificar si los valores son válidos
        if (!isNaN(capital) && !isNaN(interes)) {
            var total = capital + (capital * (interes / 100));
            document.getElementById('tot_pre').value = total.toFixed(0);
        } else {
            document.getElementById('tot_pre').value = '';
        }
    }

    // Llamar a la función al cargar la página
    calcularTotal();
</script>

<script>
    // Función para calcular el valor de la cuota
    function calcularCuota() {
        var total = parseFloat(document.getElementById('tot_pre').value);
        var cuotas = parseFloat(document.getElementById('cuo_pre').value);

        // Verificar si los valores son válidos
        if (!isNaN(total) && !isNaN(cuotas) && cuotas !== 0) {
            var valorCuota = total / cuotas;
            document.getElementById('val_cuo_pre').value = valorCuota.toFixed(0);
        } else {
            document.getElementById('val_cuo_pre').value = '';
        }
    }

    // Llamar a la función al cargar la página
    calcularCuota();

    // Agregar un evento input al campo cap_pre
    document.getElementById('cap_pre').addEventListener('input', function() {
        calcularTotal();
        calcularCuota();
    });
</script>