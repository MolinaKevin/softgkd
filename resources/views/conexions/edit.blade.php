@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Conexion
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($conexion, ['route' => ['conexions.update', $conexion->id], 'method' => 'patch']) !!}

                        @include('conexions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection