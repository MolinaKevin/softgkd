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
                    {!! Form::model($revisacion, ['route' => ['revisacions.update', $revisacion->id], 'method' => 'patch']) !!}

                    @include('revisacions.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection