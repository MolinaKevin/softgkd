@extends('layouts.app')

@section('css')
    <style type="text/css">
        body { padding-right: 0 !important }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <h1>
            GKD Administracion
            <small>Version 1.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Opciones</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group col-sm-12">
                    <a href="{!! route('users.index') !!}" class="btn btn-default">Todos Correcto</a>
                    <a href="{!! route('users.index') !!}" class="btn btn-default">Quitar todos Correcto</a>
                </div>
            </div>
            <div class="col-md-4">

            </div>
        </div>
        <div>

        </div>
    </section>
@endsection

@section('scripts')

@endsection
