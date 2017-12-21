@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Familia
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($familia, ['route' => ['familias.update', $familia->id], 'method' => 'patch']) !!}

                        @include('familias.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection