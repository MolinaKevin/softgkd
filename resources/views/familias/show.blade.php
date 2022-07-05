@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Familia
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('familias.show_fields')
                    <a href="{!! route('familias.index') !!}" class="btn btn-default">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection
