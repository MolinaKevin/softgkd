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
                <h4 class="modal-title titleCaja">Crear deuda</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inpEfectivo" class="col-sm-2 control-label">Efectivo</label>

                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="inpEfectivo" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inpNoEfectivo" class="col-sm-2 control-label">No Efectivo</label>

                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="inpNoEfectivo" />
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

@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
    <script type="text/javascript">
        $(document).on('click', '.abrirCaja', function (e) {
            e.preventDefault();
            var user = '{!! auth()->user()->id !!}';
            $('#helperId').val(user);
            $('.titleCaja').val('Caja Caja');
            $('#inpEfectivo').val('');
            $('#inpNoEfectivo').val('');
            $('#modalCaja').modal('show');
        });
    </script>
@endsection
