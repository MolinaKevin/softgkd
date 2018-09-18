@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%']) !!}

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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-outline" id="btnGuardarPlan">Guardar</button>
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
                <h4 class="modal-title">Planes ya adheridos</h4>
            </div>
            <div class="modal-body">
                <table id="tablePlanes" class="table table-condensed">

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
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
        $('#btnGuardarPlan').on('click', function (e) {
            e.preventDefault();
            if ($('#sltPlan').val() == '') {
                alert('es necesario un plan');
            } else {
                $.ajax({
                    method: "POST",
                    url: "api/dispositivos/" + $('#helperId').val() + "/plan",
                    data: {plan: $('#sltPlan').val()}
                })
                    .done(function (msg) {
                        console.log(msg);
                        $('.modal').modal('hide');
                        $('#bodySuccess').html(msg.message);
                        $('#modalSuccess').modal('show');
                    });
            }
        });
        $(document).on('click', '.btnPlanes', function (e) {
            e.preventDefault();
            $('#helperId').val($(this).parents().eq(3).data('id'));
            if ($(this).parents().eq(2).data('id') > 0) {
                $('#helperId').val($(this).parents().eq(2).data('id'));
            }
            $.ajax({
                method: "GET",
                url: "api/dispositivos/" + $('#helperId').val() + '/plans',
            })
                .done(function (msg) {
                    console.log(msg);
                    var criterio;
                    $('#tablePlanes').empty();
                    $('#tablePlanes').append('<thead><tr>\n' +
                        '                    <th>Nombre</th>\n' +
                        '                    </tr></thead><tbody>');
                    $.each(msg, function (index, value) {
                        $('#tablePlanes').append('<tr><td>' + value.name + '</td></tr>');
                    });
                    $('#tablePlanes').append('</tbody>');

                });
            $('#modalPlanes').modal('show');
        });
    </script>
@endsection