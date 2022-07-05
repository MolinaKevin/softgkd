@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Especial User
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($especialUser, ['route' => ['especialUsers.update', $especialUser->id], 'method' => 'patch']) !!}

                        @include('especial_users.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection