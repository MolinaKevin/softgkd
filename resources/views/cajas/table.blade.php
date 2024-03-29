@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%']) !!}

<div class="modal modal-warning fade" id="modalAbrirCaja" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title titleAbrirCaja">Caja 1</h4>
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
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar Pop-up</button>
                <button type="button" class="btn btn-outline" id="btnAbrirCaja">Abrir Caja</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal modal-warning fade" id="modalCerrarCaja" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title titleCerrarCaja">Caja 1</h4>
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
                            <td><label for="inpEfectivo2" class="col-sm-2 control-label">Efectivo</label></td>
                            <td><input type="number" class="form-control" id="inpEfectivo2" disabled /></td>
                        </tr>
                        <tr>
                            <td><label for="inpNoEfectivo2" class="col-sm-2 control-label">No Efectivo</label></td>
                            <td><input type="number" class="form-control" id="inpNoEfectivo2" disabled /></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar Pop-up</button>
                <button type="button" class="btn btn-outline" id="btnCerrarCaja">Cerrar Caja</button>
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
                    $('.titleAbrirCaja').val('Abrir caja ' + $('#helperId').val());
                    $('#modalAbrirCaja').modal('show');
                });
        });
		$(document).on('click', '.cerrarCaja', function (e) {
            e.preventDefault();
            $('#helperId').val($(this).parents().eq(3).data('id'));
            $.ajax({
                method: "GET",
                url: "{{ url('/') }}/api/cajas/" + $('#helperId').val(),
            })
                .done(function (msg) {
                    console.log(msg);
                    $('#inpEfectivo2').val(msg.data.efectivo);
                    $('#inpNoEfectivo2').val(msg.data.noEfectivo);
                    $('.titleCerrarCaja').val('Cerrar caja ' + $('#helperId').val());
                    $('#modalCerrarCaja').modal('show');
                });
        });
        $(document).on('click', '#btnAbrirCaja', function (e) {
		    e.preventDefault();
			$.ajax({
				method: "PUT",
				url: "{{ url('/') }}/api/cajas/" + $('#helperId').val() + "/abrir",
				data: {user: {{ Auth::id() }}}
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
        });

        $(document).on('click', '#btnCerrarCaja', function (e) {
		    e.preventDefault();
			$.ajax({
				method: "PUT",
				url: "{{ url('/') }}/api/cajas/" + $('#helperId').val() + "/cerrar",
				data: {user: {{ Auth::id() }}}
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
        });
        $("#modalSuccess").on("hidden.bs.modal", function () {
            location.reload(); 
        });
    </script>
@endsection
