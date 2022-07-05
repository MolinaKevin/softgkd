@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Planes especiales</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('especials.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

