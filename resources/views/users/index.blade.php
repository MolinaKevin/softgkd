@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Usuarios</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('users.create') !!}">Agregar Nuevo</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <input type="hidden" id="helperId"/>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Adherir plan</h4>
                </div>
                <div class="modal-body">
                    {!! Form::label('plan_id', 'Plan:') !!}
                    {!! Form::select('plan_id', App\Models\Plan::pluck('name', 'id'), null, ['placeholder' => 'Elija un plan', 'class' => 'form-control', 'id' => 'sltPlan']) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarPlan">Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('scripts')
    <script type="text/javascript">
        $('#btnPlan').on('click',function (e) {
            e.preventDefault();
            $('#helperId').val($(this).parents().eq(3).data('id'));
            $('#modalPlan').modal('show');
        });
        $('#btnGuardarPlan').on('click',function (e) {
            e.preventDefault();
            if($('#sltPlan').val() == '') {
                alert('es necesario un plan');
            } else {
                $.ajax({
                    method: "PUT",
                    url: "api/users/" + $('#helperId').val(),
                    data: { plans: [$('#sltPlan').val()] }
                })
                    .done(function( msg ) {
                        alert( msg.message );
                    });
            }
        });
    </script>
@endsection