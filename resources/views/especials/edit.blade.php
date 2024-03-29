@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Especial
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($especial, ['route' => ['especials.update', $especial->id], 'method' => 'patch']) !!}

                        @include('especials.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection


@section('scripts')
    <script type="text/javascript">

        $( document ).ready(function() {
            $("#cantidadTxt").val({{ $especial->cantidad }});
            $('[data-id="{{ $especial->date }}"]').click();
            if ("{{ $especial->limite }}" == 'Activado') {
                $("#limiteTxt").attr('disabled', false);
            } else {
                $("#limiteCbx").prop('checked',false)
            }
        });

        $(".dropdown-menu li a").on('click', function (e) {
            e.preventDefault();
            var selText = $(this).text();
            if ($(this).data('disablear') == true) {
                $("#cantidadTxt").val(selText);
                $('#hiddenDate').val($(this).data('id'));
                $("#hiddenCantidad").val(0);
                $("#cantidadTxt").attr('disabled', true);
            } else {
                $("#cantidadTxt").val('');
                $('#hiddenDate').val($(this).data('id'));
                $("#cantidadTxt").attr('disabled', false);
            }
            $(this).parents('.input-group-btn').find('.dropdown-toggle').html(selText + ' <span class="caret"></span>');
        });
        $('#cantidadTxt').on('change',function (e) {
            e.preventDefault();
            $("#hiddenCantidad").val($(this).val());

        });
        $("#limiteCbx").on('change', function (e) {
            e.preventDefault();
            if ($(this).is(':checked')) {
                $("#limiteTxt").attr('disabled', false);
            } else {
                $("#limiteTxt").attr('disabled', true);
            }
        });
    </script>
@endsection