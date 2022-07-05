<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $revisacion->id !!}</p>
</div>

<!-- Descripcion Field -->
<div class="form-group">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    <p>{!! $revisacion->descripcion !!}</p>
</div>

<!-- Aprobado Field -->
<div class="form-group">
    {!! Form::label('aprobado', 'Aprobado:') !!}
    <p>{!! $revisacion->aprobado !!}</p>
</div>

<!-- Finalizacion Field -->
<div class="form-group">
    {!! Form::label('finalizacion', 'Finalizacion:') !!}
    <p>{!! $revisacion->finalizacion !!}</p>
</div>

<!-- Medico Id Field -->
<div class="form-group">
    {!! Form::label('medico_id', 'Medico Id:') !!}
    <p>{!! $revisacion->medico_id !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $revisacion->user_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $revisacion->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $revisacion->updated_at !!}</p>
</div>

