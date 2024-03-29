@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Revisacion
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'revisacions.store']) !!}

                    @include('revisacions.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('.aprobado').on('change', function (e) {
            if($(this).val() == true){
                $('#finalizacion').prop( "disabled", false );
            } else if($(this).val() == false) {
                $('#finalizacion').prop( "disabled", true );

            }
        });
    </script>
@endsection
