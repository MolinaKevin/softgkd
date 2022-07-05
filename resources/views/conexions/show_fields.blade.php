<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $conexion->id !!}</p>
</div>

<!-- Concepto Field -->
<div class="form-group">
    {!! Form::label('concepto', 'Concepto:') !!}
    <p>{!! $conexion->concepto !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $conexion->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $conexion->updated_at !!}</p>
</div>

