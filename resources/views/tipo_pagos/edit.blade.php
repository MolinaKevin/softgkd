@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tipo Pago
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tipoPago, ['route' => ['tipoPagos.update', $tipoPago->id], 'method' => 'patch']) !!}

                        @include('tipo_pagos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection