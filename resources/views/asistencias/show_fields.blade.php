<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $asistencia->id !!}</p>
</div>

<!-- Horario Field -->
<div class="form-group">
    {!! Form::label('horario', 'Horario:') !!}
    <p>{!! $asistencia->horario !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $asistencia->user_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $asistencia->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $asistencia->updated_at !!}</p>
</div>

