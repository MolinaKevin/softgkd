@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Cierres
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('cierres.show_fields')
                    <a href="{!! route('cierres.index') !!}" class="btn btn-default">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection
