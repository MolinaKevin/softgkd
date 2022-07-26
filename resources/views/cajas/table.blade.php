@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%']) !!}

<div class="modal modal-warning fade" id="modalCaja" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title titleCaja">Caja 1</h4>
            </div>
            <div class="modal-body">
                <table id="tableDeudas" class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label for="inpEfectivo" class="col-sm-2 control-label">Efectivo</label></td>
                            <td><input type="number" class="form-control" id="inpEfectivo" disabled /></td>
                        </tr>
                        <tr>
                            <td><label for="inpNoEfectivo" class="col-sm-2 control-label">No Efectivo</label></td>
                            <td><input type="number" class="form-control" id="inpNoEfectivo" disabled /></td>
                        </tr>
                    </tbody>
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
		$(document).on('click', '.abrirCaja', function (e) {
            e.preventDefault();
            $('#helperId').val($(this).parents().eq(3).data('id'));
            $.ajax({
                method: "GET",
                url: "{{ url('/') }}/api/cajas/" + $('#helperId').val(),
            })
                .done(function (msg) {
                    console.log(msg);
                    $('#inpEfectivo').val(msg.data.efectivo);
                    $('#inpNoEfectivo').val(msg.data.noEfectivo);
                    $('.titleCaja').val('Caja ' + $('#helperId').val());
                    $('#modalCaja').modal('show');
                });
        });
        $(document).on('click', '.abrirCaja2', function (e) {
            e.preventDefault();
            var user = '{!! auth()->user()->id !!}';
            $('#helperId').val(user);
            $('.titleCaja').val('Caja Caja');
            $('#inpEfectivo').val('');
            $('#inpNoEfectivo').val('');
        });
    </script>
@endsection
