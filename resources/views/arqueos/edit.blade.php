@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Arqueo
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($arqueo, ['route' => ['arqueos.update', $arqueo->id], 'method' => 'patch']) !!}

                        @include('arqueos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection