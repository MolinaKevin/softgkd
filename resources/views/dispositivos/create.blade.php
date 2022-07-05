@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Dispositivo
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'dispositivos.store']) !!}

                        @include('dispositivos.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
