@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Deuda
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($deuda, ['route' => ['deudas.update', $deuda->id], 'method' => 'patch']) !!}

                        @include('deudas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection