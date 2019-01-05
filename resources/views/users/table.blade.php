@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%'],true) !!}

<div class="modal modal-warning fade" id="modalPlan" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adherir plan</h4>
            </div>
            <div class="modal-body">
                {!! Form::label('plan_id', 'Plan:') !!}
                {!! Form::select('plan_id[]', App\Models\Plan::orderBy('name','asc')->get()->pluck('name', 'id'), null, ['placeholder' => 'Elija un plan', 'class' => 'form-control', 'id' => 'sltPlan']) !!}
                <p class="" id="helpTxt"></p>
                {!! Form::label('agregar', 'Agregar días o clases:') !!}
                {!! Form::number('agregar', null, ['class' => 'form-control', 'id' => 'txtAdicion']) !!}
                {!! Form::label('date', 'Proximo vencimiento') !!}
                {!! Form::date('date', null, ['class' => 'form-control', 'id' => 'txtDate']) !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-outline" id="btnGuardarPlan">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal modal-danger fade" id="modalPago" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Efectuar pago</h4>
            </div>
            <div class="modal-body">
                <table id="tablePago" class="table table-condensed">

                </table>
                <hr />
                <table id="tablePlanesEnPago" class="table table-condensed">

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-outline" id="btnGuardarPago">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal modal-info fade" id="modalHuella" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adherir huella</h4>
            </div>
            <div class="modal-body">
                <textarea class="form-control" id="txtHuella" rows="5"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-outline" id="btnGuardarHuella">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal modal-info fade" id="modalTag" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adherir tag</h4>
            </div>
            <div class="modal-body">

                <textarea class="form-control" id="txtTag" rows="5"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-outline" id="btnGuardarTag">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal modal-warning fade" id="modalDeuda" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Crear deuda</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="form-group">
                        <label for="txtDeudaConcepto" class="col-sm-2 control-label">Concepto</label>

                        <div class="col-sm-10">
                            <textarea class="form-control" id="txtDeudaConcepto" rows="3" placeholder="Concepto ..."></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtDeudaImporte" class="col-sm-2 control-label">Importe</label>

                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="txtDeudaImporte" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-outline" id="btnGuardarDeuda">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal modal-danger fade" id="modalPlanes" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Gestionar planes</h4>
            </div>
            <div class="modal-body">
                <table id="tablePlanes" class="table table-condensed">

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" id="btnBorrarPlanes">Eliminar seleccionados</button>
                <button type="button" class="btn btn-outline" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal modal-success fade" id="modalSuccess" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Exito!</h4>
            </div>
            <div class="modal-body" id="bodySuccess">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
    <script type="text/javascript">
        $(document).on('click', '.btnPlan', function (e) {
            e.preventDefault();
            $('#helperId').val($(this).parents().eq(3).data('id'));
            if ($(this).parents().eq(2).data('id') > 0) {
                $('#helperId').val($(this).parents().eq(2).data('id'));
            }
            $('#modalPlan').modal('show');
        });
        $(document).on('click', '.btnHuella', function (e) {
            e.preventDefault();
            $('#helperId').val($(this).parents().eq(3).data('id'));
            if ($(this).parents().eq(2).data('id') > 0) {
                $('#helperId').val($(this).parents().eq(2).data('id'));
            }
            $('#txtHuella').val('');
            $('#modalHuella').modal('show');
        });
        $(document).on('click', '.btnTag', function (e) {
            e.preventDefault();
            $('#helperId').val($(this).parents().eq(3).data('id'));
            if ($(this).parents().eq(2).data('id') > 0) {
                $('#helperId').val($(this).parents().eq(2).data('id'));
            }
            $('#txtTag').val('');
            $('#modalTag').modal('show');
        });
        $(document).on('click', '.btnDeuda', function (e) {
            e.preventDefault();
            $('#helperId').val($(this).parents().eq(3).data('id'));
            if ($(this).parents().eq(2).data('id') > 0) {
                $('#helperId').val($(this).parents().eq(2).data('id'));
            }
            $('#txtDeudaConcepto').val('');
            $('#txtDeudaImporte').val('');
            $('#modalDeuda').modal('show');
        });
        $(document).on('click', '.btnPago', function (e) {
            e.preventDefault();
            $('#helperId').val($(this).parents().eq(3).data('id'));
            if ($(this).parents().eq(2).data('id') > 0) {
                $('#helperId').val($(this).parents().eq(2).data('id'));
            }
            $.ajax({
                method: "GET",
                url: "{{ url('/') }}/api/users/" + $('#helperId').val() + '/deudas',
            })
                .done(function (msg) {
                    console.log(msg);
                    var criterio;
                    $('#tablePago').empty();
                    $('#tablePago').append('<thead><tr>\n' +
                        '                    <th>Concepto</th>\n' +
                        '                    <th>Precio</th>\n' +
                        '                    <th>Pagar</th>\n' +
                        '                    </tr></thead><tbody>');
                    $.each(msg, function (index, value) {
                        $('#tablePago').append('<tr><td>' + value.concepto + '</td><td>' + value.precio + '</td><td><input type="checkbox" class="cbxPagar" data-id="' + value.id + '" /></td></tr>');
                    });
                    $('#tablePago').append('</tbody>');

                });
            $.ajax({
                method: "GET",
                url: "{{ url('/') }}/api/users/" + $('#helperId').val() + '/plans',
            })
                .done(function (msg) {
                    var data = msg[0];
                    var criterio;
                    var temp = '';
                    var date;
                    $('#tablePlanesEnPago').empty();
                    $('#tablePlanesEnPago').append('<thead><tr>\n' +
                        '                    <th>Nombre</th>\n' +
                        '                    <th>Precio</th>\n' +
                        '                    <th>Pagar ahora</th>\n' +
                        '                    </tr></thead><tbody>');
                    $.each(data.plans, function (index, value) {
                        console.log(value);
                        date = value.pivot.vencimiento.split(" ");
                        temp = temp + '<tr>';
                        temp = temp + '<td>' + value.name + '</td>';
                        temp = temp + '<td>' + value.precio + '</td>';
                        temp = temp + '<td><button type="button" class="btn btn-block btn-success btn-xs renovarPlan" data-id="' + value.id + '" >Pagar</button></td>';
                        temp = temp + '</tr>';
                    });
                    $('#tablePlanesEnPago').append(temp);
                    temp = '';
                    $.each(data.especials, function (index, value) {
                        console.log(value);
                        date = value.pivot.vencimiento.split(" ");
                        temp = temp + '<tr>';
                        temp = temp + '<td>(Especial) ' + value.name + '</td>';
                        temp = temp + '<td>' + value.precio + '</td>';
                        temp = temp + '<td><button type="button" class="btn btn-block btn-success btn-xs renovarPlan" data-id="' + value.id + '" >Pagar</button></td>';
                        temp = temp + '</tr>';
                    });
                    $('#tablePlanesEnPago').append(temp);
                    $('.renovarPlan').on('click', function (e) {
                        e.preventDefault();
                        var elemento = $(this);
                        $.ajax({
                            method: "GET",
                            url: "{{ url('/') }}/api/users/"  + $('#helperId').val() +  "/renovar/" + $(this).data('id'),
                        })
                            .done(function (msg) {
                                console.log(msg);
                                alert('plan renovado correctamente');
                                elemento.hide();
                            });
                    });
                    $('#tablePlanesEnPago').append('</tbody>');

                });
            $('#modalPago').modal('show');
        });
        $(document).on('click', '.btnPlanes', function (e) {
            e.preventDefault();
            $('#helperId').val($(this).parents().eq(3).data('id'));
            if ($(this).parents().eq(2).data('id') > 0) {
                $('#helperId').val($(this).parents().eq(2).data('id'));
            }
            $.ajax({
                method: "GET",
                url: "{{ url('/') }}/api/users/" + $('#helperId').val() + '/plans',
            })
                .done(function (msg) {
                    var data = msg[0];
                    var criterio;
                    var temp = '';
                    var date;
                    $('#tablePlanes').empty();
                    $('#tablePlanes').append('<thead><tr>\n' +
                        '                    <th>Nombre</th>\n' +
                        '                    <th>Precio</th>\n' +
                        '                    <th>Vencimiento</th>\n' +
                        '                    <th>Eliminar</th>\n' +
                        '                    </tr></thead><tbody>');
                    $.each(data.plans, function (index, value) {
                        console.log(value);
                        date = value.pivot.vencimiento.split(" ");
                        temp = temp + '<tr>';
                        temp = temp + '<td>' + value.name + '</td>';
                        temp = temp + '<td>' + value.precio + '</td>';
                        temp = temp + '<td><input type="date" class="form-control input-sm dateVencimiento" data-id="' + value.id + '" value="' + date[0] + '" /></td>';;
                        temp = temp + '<td><input type="checkbox" class="cbxEliminar" data-id="' + value.id + '" /></td>';
                        temp = temp + '</tr>';
                    });
                    $('#tablePlanes').append(temp);

                    $('.dateVencimiento').on('change', function (e) {
                        e.preventDefault();
                        $.ajax({
                            method: "PUT",
                            url: "{{ url('/') }}/api/users/"  + $('#helperId').val() +  "/cambiarVencimiento/" + $(this).data('id'),
                            data: {vencimiento:$(this).val()}
                        })
                            .done(function (msg) {
                                console.log(msg);
                            });
                    });
                    temp = '';
                    $.each(data.especials, function (index, value) {
                        console.log(value);
                        date = value.pivot.vencimiento.split(" ");
                        temp = temp + '<tr>';
                        temp = temp + '<td>(Especial) ' + value.name + '</td>';
                        temp = temp + '<td>' + value.precio + '</td>';
                        temp = temp + '<td><input type="date" class="form-control input-sm dateVencimiento" data-id="' + value.id + '" value="' + date[0] + '" /></td>';;
                        temp = temp + '<td><input type="checkbox" class="cbxEliminar" data-id="' + value.id + '" /></td>';
                        temp = temp + '</tr>';
                    });
                    $('#tablePlanes').append(temp);

                    $('.dateVencimiento').on('change', function (e) {
                        e.preventDefault();
                        $.ajax({
                            method: "PUT",
                            url: "{{ url('/') }}/api/users/"  + $('#helperId').val() +  "/cambiarVencimientoEspecial/" + $(this).data('id'),
                            data: {vencimiento:$(this).val()}
                        })
                            .done(function (msg) {
                                console.log(msg);
                            });
                    });

                    $('#tablePlanes').append('</tbody>');

                });
            $('#modalPlanes').modal('show');
        });
        $('#btnGuardarPlan').on('click', function (e) {
            e.preventDefault();
            if ($('#sltPlan').val() == '') {
                alert('es necesario un plan');
            } else {
                $.ajax({
                    method: "PUT",
                    url: "{{ url('/') }}/api/users/" + $('#helperId').val(),
                    data: {plans: [$('#sltPlan').val()], adicion: $('#txtAdicion').val(), date: $('#txtDate').val()}
                })
                    .done(function (msg) {
                        console.log(msg);
                        $('.modal').modal('hide');
                        $('#bodySuccess').html(msg.message);
                        $('#modalSuccess').modal('show');
                    });
            }
        });
        $('#btnBorrarPlanes').on('click', function (e) {
            e.preventDefault();
            var planes = [];
            $('.cbxEliminar').each(function () {
                if ($(this).is(':checked')) {
                    planes.push($(this).data('id'))
                }

            });
            $.ajax({
                method: "PUT",
                url: "{{ url('/') }}/api/users/" + $('#helperId').val() + "/detachPlanes",
                data: {planes: planes}
            })
                .done(function (msg) {
                    console.log(msg);
                    $('.modal').modal('hide');
                    $('#bodySuccess').html('Planes desasociado');
                    $('#modalSuccess').modal('show');
                });

        });
        $(document).on('click', '.btnDelete', function (e) {
            e.preventDefault();
            $('#helperId').val($(this).parents().eq(2).data('id'));
            $.ajax({
                method: "DELETE",
                url: "{{ url('/') }}/api/users/" + $('#helperId').val(),
            })
                .done(function (msg) {
                    console.log(msg);
                    $('.modal').modal('hide');
                    $('#bodySuccess').html(msg.message);
                    $('#modalSuccess').modal('show');
                });
        });
        $('#sltPlan').on('change', function (e) {
            var json = {!!App\Models\Plan::with('horarios')->get()->pluck('horarios','id','horario.dia')!!};
            $('#helpTxt').html('');
            $.each(json[$('#sltPlan').val()], function (index, value) {
                console.log(value);
                $('#helpTxt').append(value.dia + ' ' + value.hora + ' - ');
            });
            var texto = $('#helpTxt').html();
            texto = texto.substring(0, texto.length - 3);
            $('#helpTxt').html(texto);
        });
        $('#btnGuardarHuella').on('click', function (e) {
            e.preventDefault();
            if ($('#txtHuella').val() == '') {
                alert('es necesario una huella');
            } else {
                $.ajax({
                    method: "POST",
                    url: "{{ url('/') }}/api/users/" + $('#helperId').val() + "/huella",
                    data: {huella: $('#txtHuella').val()}
                })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        console.log("Request 1: " + errorThrown);
                        console.log("Request 2: " + textStatus);
                        console.log(jqXHR);
                    })
                    .done(function (msg) {
                        console.log(msg);
                        $('.modal').modal('hide');
                        $('#bodySuccess').html(msg.message);
                        $('#modalSuccess').modal('show');
                    });
            }
        });
        $('#btnGuardarTag').on('click', function (e) {
            e.preventDefault();
            if ($('#txtTag').val() == '') {
                alert('es necesario un tag');
            } else {
                $.ajax({
                    method: "POST",
                    url: "{{ url('/') }}/api/users/" + $('#helperId').val() + "/tag",
                    data: {tag: $('#txtTag').val()}
                })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        console.log("Request 1: " + errorThrown);
                        console.log("Request 2: " + textStatus);
                        console.log(jqXHR);
                    })
                    .done(function (msg) {
                        console.log(msg);
                        $('.modal').modal('hide');
                        $('#bodySuccess').html(msg.message);
                        $('#modalSuccess').modal('show');
                    });
            }
        });
        $('#btnGuardarDeuda').on('click', function (e) {
            e.preventDefault();
            if (($('#txtDeudaConcepto').val() == '') || ($('#txtDeudaImporte').val() == '')) {
                alert('es necesario un concepto y un importe');
            } else {
                $.ajax({
                    method: "POST",
                    url: "{{ url('/') }}/api/users/" + $('#helperId').val() + "/deuda",
                    data: {concepto: $('#txtDeudaConcepto').val(), precio: $('#txtDeudaImporte').val()}
                })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        console.log("Request 1: " + errorThrown);
                        console.log("Request 2: " + textStatus);
                        console.log(jqXHR);
                    })
                    .done(function (msg) {
                        console.log(msg);
                        $('.modal').modal('hide');
                        $('#bodySuccess').html(msg.message);
                        $('#modalSuccess').modal('show');
                    });
            }
        });
        $('#btnGuardarPago').on('click', function (e) {
            e.preventDefault();
            var deudas = [];
            $('.cbxPagar').each(function () {
                if ($(this).is(':checked')) {
                    deudas.push($(this).data('id'))
                }
            });
            $.ajax({
                method: "PUT",
                url: "{{ url('/') }}/api/users/" + $('#helperId').val() + "/deudas",
                data: {deudas: deudas}
            })
                .done(function (msg) {
                    console.log(msg);
                    $('.modal').modal('hide');
                    $('#bodySuccess').html('Deudas pagadas');
                    $('#modalSuccess').modal('show');
                });

        });
    </script>
@endsection