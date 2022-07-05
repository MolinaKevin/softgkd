@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Usuarios
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'users.store']) !!}

                    @include('users.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalFamilia" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Nueva Familia</h4>
                </div>
                <div class="modal-body">
                    {!! Form::label('name', 'Nombre:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'txtFamilia']) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnFamilia">Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('scripts')
    <script type="text/javascript">
        $('#btnSubmit').on('click', function (e) {
            e.preventDefault();
            $('#modalFamilia').modal('show');
        });
        $('#btnFamilia').on('click', function (e) {
            if ($('#txtFamilia').val() == '') {
                alert('es necesario un nombre');
            } else {
                $.ajax({
                    method: "POST",
                    url: "{{ route('api.familias.store') }}",
                    data: {name: $('#txtFamilia').val()}
                })
                    .done(function (msg) {
                        $('#sltFamilia').append(new Option($('#txtFamilia').val(), msg.data.id, true, true));
                        $('#modalFamilia').modal('hide');

                    });
            }
        });
    </script>
@endsection
