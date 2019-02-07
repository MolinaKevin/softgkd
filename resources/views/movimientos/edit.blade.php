@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Movimiento
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($movimiento, ['route' => ['movimientos.update', $movimiento->id], 'method' => 'patch']) !!}

                        @include('movimientos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection