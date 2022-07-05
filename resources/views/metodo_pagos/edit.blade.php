@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Metodo Pago
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($metodoPago, ['route' => ['metodoPagos.update', $metodoPago->id], 'method' => 'patch']) !!}

                        @include('metodo_pagos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection