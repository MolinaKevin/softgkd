@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Usuarios</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px"
               href="{!! route('users.create') !!}">Agregar Nuevo</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                {!! Form::hidden('helper',null,['id' => 'helperId']) !!}
                @include('users.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
    <div class="modal fade" id="modalPlan" tabindex="-1" role="dialog">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarPlan">Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="modalPago" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Efectuar pago</h4>
                </div>
                <div class="modal-body">
                    <table id="tablePago" class="table table-condensed table-hover">

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarPago">Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="modalHuella" tabindex="-1" role="dialog">
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarHuella">Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('scripts')
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
        $(document).on('click', '.btnPago', function (e) {
            e.preventDefault();
            $('#helperId').val($(this).parents().eq(3).data('id'));
            if ($(this).parents().eq(2).data('id') > 0) {
                $('#helperId').val($(this).parents().eq(2).data('id'));
            }
            $.ajax({
                method: "GET",
                url: "api/users/" + $('#helperId').val() + '/deudas',
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
                        //criterio = value.date.toLowerCase();
                        //if (criterio != 'clases') {
                        //    criterio = 'vencimiento';
                        //}
                        $('#tablePago').append('<tr><td>' + value.concepto + '</td><td>' + value.precio + '</td><td><input type="checkbox" class="cbxPagar" data-id="' + value.id + '" /></td></tr>');
                    });
                    $('#tablePago').append('</tbody>');

                });
            $('#modalPago').modal('show');
        });
        $('#btnGuardarPlan').on('click', function (e) {
            e.preventDefault();
            if ($('#sltPlan').val() == '') {
                alert('es necesario un plan');
            } else {
                $.ajax({
                    method: "PUT",
                    url: "api/users/" + $('#helperId').val(),
                    data: {plans: [$('#sltPlan').val()], adicion: $('#txtAdicion').val()}
                })
                    .done(function (msg) {
                        console.log(msg);
                        alert(msg.message);
                    });
            }
        });
        $(document).on('click','.btnDelete', function (e) {
            e.preventDefault();
            $('#helperId').val($(this).parents().eq(2).data('id'));
            $.ajax({
                method: "DELETE",
                url: "api/users/" + $('#helperId').val(),
            })
            .done(function (msg) {
                console.log(msg);
                alert(msg.message);
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
                    url: "api/users/" + $('#helperId').val() + "/huella",
                    data: {huella: $('#txtHuella').val()}
                })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        console.log("Request 1: " + errorThrown);
                        console.log("Request 2: " + textStatus);
                        console.log(jqXHR);
                    })
                    .done(function (msg) {
                        console.log(msg);
                        alert(msg.message);
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
                url: "api/users/" + $('#helperId').val() + "/deudas",
                data: {deudas: deudas}
            })
                .done(function (msg) {
                    console.log(msg);
                    alert('Deudas pagadas');
                });

        });
    </script>
@endsection
