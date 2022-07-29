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
                {!! Form::date('date', null, ['class' => 'form-control', 'id' => 'txtDate', 'min' => date('Y-m-d')]) !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-outline" id="btnGuardarPlan">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal modal-default fade" id="modalAdministrarUser" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Administrar Usuario</h4>
            </div>
            <div class="modal-body">
                <a class="btn btn-block btn-social btn-eye btnVerUsuario">
                    <i class="fas fa-edit"></i>
                    Ver Información básica
                </a>
                <a class="btn btn-block btn-social btn-instagram btnEdit">
                    <i class="fas fa-edit"></i>
                    Editar Información básica
                </a>
                <a class="btn btn-block btn-social btn-instagram btnHuella">
                    <i class="fas fa-fingerprint"></i>
                    Huella
                </a>
                <a class="btn btn-block btn-social btn-instagram btnTag">
                    <i class="fas fa-id-card-alt"></i>
                    Tag
                </a>
                <a class="btn btn-block btn-social btn-instagram btnPlanes">
                    <i class="fas fa-list-alt"></i>
                    Administrar Planes
                </a>
                <a class="btn btn-block btn-social btn-instagram btnDeudas">
                    <i class="fas fa-list-alt"></i>
                    Administrar Deudas
                </a>
                <a class="btn btn-block btn-social btn-instagram btnPlan">
                    <i class="fas fa-plus-square"></i>
                    Agregar Planes
                </a>
                <a class="btn btn-block btn-social btn-google btnPlanEspecial">
                    <i class="fas fa-plus-square"></i>
                    Agregar Planes Especiales
                </a>
                <a class="btn btn-block btn-social btn-google btnPagoParcial">
                    <i class="fas fa-coins"></i>
                    Pago Parcial
                </a>
                <a class="btn btn-block btn-social btn-google btnSupraestado">
                    <i class="fas fa-coins"></i>
                    Supraestado
                </a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal modal-danger fade" id="modalPago" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
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
                <!--button type="button" class="btn btn-outline" id="btnGuardarPago">Guardar</button -->
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
<div class="modal modal-warning fade" id="modalPagoParcial" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pago Parcial</h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-dollar-sign"></i></span>
                    <input type="number" id="txtPagoParcial" class="form-control" placeholder="Pago Parcial">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-dollar-sign"></i></span>
                    {!! Form::select('metodo[]', App\Models\Metodo::orderBy('title','asc')->get()->pluck('title', 'id'), null, ['placeholder' => 'Elija un metodo de pago', 'class' => 'form-control', 'id' => 'sltMetodoPagoParcial']) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-outline" id="btnPagarParcial">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal modal-warning fade" id="modalSupraestado" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Supraestado</h4>
            </div>
            <div class="modal-body">
                    {!! Form::label('supraestado', 'Supraestado:') !!}
                    {!! Form::select('supraestado', [
                            0 => 'Ninguno',
                            1 => 'Acceso permanente',
                            2 => 'Acceso Bloqueado'
                        ], null, ['placeholder' => 'Elija un supraestado', 'class' => 'form-control', 'id' => 'sltSupraestado']) !!}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-outline" id="btnCambiarSupraestado">Guardar</button>
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
<div class="modal modal-info fade" id="modalDeudas" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Gestionar deudas</h4>
            </div>
            <div class="modal-body">
                <table id="tableDeudas" class="table table-condensed">

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" id="btnBorrarDeudas">Eliminar seleccionados</button>
                <button type="button" class="btn btn-outline pull-left" id="btnAplicarDescuento">Aplicar descuento a seleccionados</button>
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
        $(document).on('hidden.bs.modal', function () {
            $('body').css('padding-right','0px');

        });
        var hePagado = false;
        $(document).on('click', '.btnAdmin', function (e) {
            e.preventDefault();
            $('#helperId').val($(this).parents().eq(3).data('id'));
            if ($(this).parents().eq(2).data('id') > 0) {
                $('#helperId').val($(this).parents().eq(2).data('id'));
            }
            $('#modalAdministrarUser').modal('show');
        });
        $(document).on('click', '.btnPlan', function (e) {
            e.preventDefault();
            $('#sltPlan').val('');
            $('#txtDate').val('');
            $('#modalAdministrarUser').modal('hide');
            $('#modalPlan').modal('show');
        });
        $(document).on('click', '.btnPagoParcial', function (e) {
            e.preventDefault();
            $('#txtPagoParcial').val('');
            $('#modalAdministrarUser').modal('hide');
            $('#modalPagoParcial').modal('show');
        });
        $(document).on('click', '.btnSupraestado', function (e) {
            e.preventDefault();
            $('#sltSupraestado').val('');
            $('#modalAdministrarUser').modal('hide');
            $('#modalSupraestado').modal('show');
        });
        $(document).on('click', '.btnVerUsuario', function (e) {
            e.preventDefault();
            window.location.href = "{{ url('/') }}/users/" + $('#helperId').val();
        });
        $(document).on('click', '.btnEdit', function (e) {
            e.preventDefault();
            window.location.href = "{{ url('/') }}/users/" + $('#helperId').val() + '/edit';
        });
        $(document).on('click', '.btnPlanEspecial', function (e) {
            e.preventDefault();
            window.location.href = "{{ url('/') }}/especials/create/" + $('#helperId').val();
        });
        $(document).on('click', '.btnHuella', function (e) {
            e.preventDefault();
            $('#txtHuella').val('');
            $('#modalAdministrarUser').modal('hide');
            $('#modalHuella').modal('show');
        });
        $(document).on('click', '.btnTag', function (e) {
            e.preventDefault();
            $('#txtTag').val('');
            $('#modalAdministrarUser').modal('hide');
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
            var interruptor = true;
            $('#helperId').val($(this).parents().eq(3).data('id'));
            if ($(this).parents().eq(2).data('id') > 0) {
                $('#helperId').val($(this).parents().eq(2).data('id'));
            }
            $.ajax({
                method: "GET",
                async:false,
                url: "{{ url('/') }}/api/users/" + $('#helperId').val() + '/deudas',
            })
                .done(function (msg) {
                    console.log(msg);
                    var criterio;
                    var temp = '';
                    $('#tablePago').empty();
                    $('#tablePago').append('<thead><tr>\n' +
                        '                    <th>Deuda</th>\n' +
                        '                    <th>Periodo</th>\n' +
                        '                    <th>Precio</th>\n' +
                        '                    <th>Metodo</th>\n' +
                        '                    <th>Pagar</th>\n' +
                        '                    </tr></thead><tbody>');
                    $.each(msg, function (index, value) {
                        console.log(value);
                        interruptor = false;
                        temp = temp + '<tr>';
                        temp = temp + '<td>' + value.concepto + '</td>';
                        temp = temp + '<td>' + value.mes + '</td>';
                        temp = temp + '<td>' + value.precio + '</td>';
                        temp = temp + '<td><select data-id="' + index + '" class="metodo form-control select2" style="width: 100%;">';
                        @foreach ($metodos as $metodo)
                            temp = temp + '<option value="{{ $metodo->id }}">{{ $metodo->title }}</option>';
                        @endforeach
                        temp = temp + '</select></td>';
                        temp = temp + '<td><button type="button" class="btn btn-block btn-success btn-xs pagarDeudaPlanes" data-id="' + value.id + '"  data-row="' + index + '"  >Pagar</button></td>';
                        temp = temp + '</tr>';

                        //$('#tablePago').append('<tr><td>'
                        //    + value.concepto + '</td><td>'
                        //    + value.precio + '</td>' +
                        //    '<td><input type="checkbox" class="cbxPagar" data-id="' + value.id + '" /></td></tr>');
                    });
                    $('#tablePago').append(temp);
                    $('.pagarDeudaPlanes').on('click', function (e) {
                        e.preventDefault();
                        var elemento = $(this);
                        var idRow = $(this).data('row');
                        console.log(idRow);
                        console.log($('.metodo[data-id=' + idRow + ']').val());
                        $.ajax({
                            method: "GET",
                            url: "{{ url('/') }}/api/users/"  + $('#helperId').val() +  "/pagarDeuda/" + elemento.data('id'),
                            data: {descontar:0,metodoPago: $('.metodo[data-id=' + idRow + ']').val(), caja: {!! !empty(Auth::user()->caja->id)? Auth::user()->caja->id : 0 !!}}
                        })
                            .done(function (msg) {
                                hePagado = true;
                                console.log(msg);
                                alert('deuda pagada correctamente');
                                elemento.hide();
                            });
                    });
                    $('#tablePago').append('</tbody>');

                });
            if (interruptor) {
                $.ajax({
                    method: "GET",
                    url: "{{ url('/') }}/api/users/" + $('#helperId').val() + '/plans',
                })
                    .done(function (msg) {
                        var data = msg[0];
                        var criterio;
                        var temp = '';
                        var date;
                        var cuenta = data.cuenta;
                        var descuento = false;
                        $('#tablePlanesEnPago').empty();
                        $('#tablePlanesEnPago').append('<thead><tr>\n' +
                            '                    <th>Planes</th>\n' +
                            '                    <th>Precio</th>\n' +
                            '                    <th>Periodo</th>\n' +
                            '                    <th>Modificar</th>\n' +
                            '                    <th>Metodo Pago</th>\n' +
                            '                    <th>Pagar anticipado</th>\n' +
                            '                    </tr></thead><tbody>');
                        var d = new Date();
                        var n = d.getMonth() + 1;
                        $.each(data.plans, function (index, value) {
                            console.log(value);
                            date = value.pivot.vencimiento.split(" ");
                            temp = temp + '<tr>';
                            temp = temp + '<td>' + value.name + '</td>';
                            temp = temp + '<td class="precio" data-id="' + index + '">' + value.precio + '</td>';
                            temp = temp + '<td class="periodo" data-id="' + index + '">' + n  + '</td>';
                            temp = temp + '<td><button type="button" class="btn btn-success btn-xs cambiarPeriodo" data-id="' + index + '" ><i class="glyphicon glyphicon-pencil"></i></button>';
                            if (cuenta > 0) {
                                temp = temp + '<button type="button" class="btn btn-success btn-xs restarCuenta" data-id="' + index + '" ><i class="glyphicon glyphicon-usd"></i></button></td>';
                            } else {
                                temp = temp + '</td>';
                            }

                            temp = temp + '<td><select data-id="' + index + '" class="metodo form-control select2" style="width: 100%;">';
                            @foreach ($metodos as $metodo)
                                temp = temp + '<option value="{{ $metodo->id }}">{{ $metodo->title }}</option>';
                            @endforeach
                            temp = temp + '</select></td>';
                            temp = temp + '<td><button type="button" class="btn btn-block btn-success btn-xs renovarPlan" data-id="' + value.id + '" data-row="' + index + '"  >Pagar</button></td>';
                            temp = temp + '</tr>';
                        });
                        $('#tablePlanesEnPago').append(temp);
                        temp = '';
                        $.each(data.especials, function (index, value) {
                            console.log(value);
                            date = value.pivot.vencimiento.split(" ");
                            temp = temp + '<tr>';
                            temp = temp + '<td>(Especial) ' + value.name + '</td>';
                            temp = temp + '<td class="precio" data-id="' + index + '">' + value.precio + '</td>';
                            temp = temp + '<td class="periodo" data-id="' + index + '">' + n + '</td>';
                            temp = temp + '<td><button type="button" class="btn btn-success btn-xs cambiarPeriodo" data-id="' + index + '" ><i class="glyphicon glyphicon-pencil"></i></button>';
                            if (cuenta > 0) {
                                temp = temp + '<button type="button" class="btn btn-success btn-xs restarCuenta" data-id="' + index + '" ><i class="glyphicon glyphicon-usd"></i></button></td>';
                            } else {
                                temp = temp + '</td>';
                            }
                            temp = temp + '<td><button type="button" class="btn btn-block btn-success btn-xs renovarPlan" data-id="' + value.id + '" data-row="' + index + '" >Pagar</button></td>';
                            temp = temp + '</tr>';
                        });
                        $('#tablePlanesEnPago').append(temp);
                        $('.renovarPlan').on('click', function (e) {
                            e.preventDefault();
                            var elemento = $(this);
                            var idRow = $(this).data('row');
                            $.ajax({
                                method: "GET",
                                url: "{{ url('/') }}/api/users/"  + $('#helperId').val() +  "/renovar/" + $(this).data('id'),
                                data: {periodo:$('.periodo[data-id=' + idRow + ']').html(), descontar: descuento, metodoPago: $('.metodo[data-id=' + idRow + ']').val(), caja: {!! !empty(Auth::user()->caja->id) ?  Auth::user()->caja->id : 0 !!}}
                            })
                                .done(function (msg) {
                                    console.log(msg);
                                    alert('plan renovado correctamente');
                                    elemento.hide();
                                });
                        });
                        $('.cambiarPeriodo').on('click', function (e) {
                            e.preventDefault();
                            var mes = prompt("Por favor escriba el numero del mes", n);

                            if (mes == null || mes == "") {
                                alert("No se ha modificado el periodo");
                            } else if (mes > 12 || mes < 0 || isNaN(mes)) {
                                alert("Valor invalido");
                            } else {
                                var idRow = $(this).data('id');
                                $('.periodo[data-id=' + idRow + ']').html(mes);
                            }
                            var elemento = $(this);
                        });
                        $('.restarCuenta').on('click', function (e) {
                            e.preventDefault();
                            var flag = confirm("Desea descontar el dinero a cuenta de este pago?");

                            if (flag == true) {
                                descuento = true;
                                var idRow = $(this).data('id');
                                $('.precio[data-id=' + idRow + ']').html($('.precio[data-id=' + idRow + ']').html() - cuenta);
                            }
                            var elemento = $(this);
                        });
                        $('#tablePlanesEnPago').append('</tbody>');

                    });
            } else {
                $('#tablePlanesEnPago').empty();
            }

            $('#modalPago').modal('show');
        });
        $(document).on('click', '.btnPlanes', function (e) {
            e.preventDefault();
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
                    $('.cbxEliminar').each(function () {
                        $(this).prop('checked', false);
                    });
                    $('#tablePlanes').append('</tbody>');

                });
            $('#modalAdministrarUser').modal('hide');
            $('#modalPlanes').modal('show');
        });
        $(document).on('click', '.btnDeudas', function (e) {
            e.preventDefault();
            $.ajax({
                method: "GET",
                url: "{{ url('/') }}/api/users/" + $('#helperId').val() + '/deudas',
            })
                .done(function (msg) {
                    var data = msg[0];
                    var criterio;
                    var temp = '';
                    var date;
                    $('#tableDeudas').empty();
                    $('#tableDeudas').append('<thead><tr>\n' +
                        '                    <th>Nombre</th>\n' +
                        '                    <th>Precio</th>\n' +
                        '                    <th><i class="glyphicon glyphicon-ok"></i></th>\n' +
                        '                    </tr></thead><tbody>');
                    $.each(msg, function (index, value) {
                        console.log(value);
                        temp = temp + '<tr>';
                        temp = temp + '<td>' + value.concepto + '</td>';
                        temp = temp + '<td>' + value.precio + '</td>';
                        temp = temp + '<td><input type="checkbox" class="cbxEliminar" data-id="' + value.id + '" /></td>';
                        temp = temp + '</tr>';
                    });
                    $('#tableDeudas').append(temp);
                });
            $('#modalAdministrarUser').modal('hide');
            $('.cbxEliminar').each(function () {
                $(this).prop('checked', false)
            });
            $('#modalDeudas').modal('show');
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
        $('#btnPagarParcial').on('click', function (e) {
            e.preventDefault();
            if ($('#txtPagoParcial').val() > 0) {
                $.ajax({
                    method: "POST",
                    url: "{{ url('/') }}/api/users/" + $('#helperId').val() + "/pagoParcial",
                    data: {pago: $('#txtPagoParcial').val(), metodo: $('#sltMetodoPagoParcial').val(), caja: {!! !empty(Auth::user()->caja->id)? Auth::user()->caja->id : 0 !!}}
                })
                    .done(function (msg) {
                        console.log(msg);
                        $('.modal').modal('hide');
                        $('#bodySuccess').html(msg.message);
                        $('#modalSuccess').modal('show');
                    });
            } else {
                alert('Es necesario ingresar un valor positivo');
            }
        });
        $('#btnCambiarSupraestado').on('click', function (e) {
            e.preventDefault();
            if ($('#sltSupraestado').val() > 0) {
                $.ajax({
                    method: "PUT",
                    url: "{{ url('/') }}/api/users/" + $('#helperId').val() + "/supraestado",
                    data: {supraestado: $('#sltSupraestado').val()}
                })
                    .done(function (msg) {
                        console.log(msg);
                        $('.modal').modal('hide');
                        $('#bodySuccess').html(msg.message);
                        $('#modalSuccess').modal('show');
                    });
            } else {
                alert('Es necesario seleccionar un supraestado');
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
        $('#btnBorrarDeudas').on('click', function (e) {
            e.preventDefault();
            var deudas = [];
            $('.cbxEliminar').each(function () {
                if ($(this).is(':checked')) {
                    deudas.push($(this).data('id'))
                }
            });
            $.ajax({
                method: "PUT",
                url: "{{ url('/') }}/api/deudas/eliminar",
                data: {deudas: deudas}
            })
                .done(function (msg) {
                    console.log(msg);
                    $('.modal').modal('hide');
                    $('#bodySuccess').html('Deudas eliminadas');
                    $('#modalSuccess').modal('show');
                });

        });
        $('#btnAplicarDescuento').on('click', function (e) {
            e.preventDefault();
            var deudas = [];
            $('.cbxEliminar').each(function () {
                if ($(this).is(':checked')) {
                    deudas.push($(this).data('id'))
                }
            });
            $.ajax({
                method: "PUT",
                url: "{{ url('/') }}/api/users/" + $('#helperId').val() + "/aplicarDescuento",
                data: {deudas: deudas}
            })
                .done(function (msg) {
                    console.log(msg);
                    $('.modal').modal('hide');
                    $('#bodySuccess').html('Descuentos aplicados');
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
            $.ajax({
                method: "GET",
                url: "{{ url('/') }}/api/plans/" + $('#sltPlan').val() + "/vencimiento",
            })
                .done(function (msg) {
                    console.log(msg.data);
                    $('#txtDate').val(msg.data);
                });
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

        $('#modalPago').on('hidden.bs.modal', function () {
            if (hePagado) {
                location.reload();
            }
        })
    </script>
@endsection
