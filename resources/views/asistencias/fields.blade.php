<!-- Horario Field -->
<div class="form-group col-sm-6">
    {!! Form::label('horario', 'Fecha:') !!}
    {!! Form::date('horario', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Dispositivo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dispositivo_id', 'Dispositivo Id:') !!}
    {!! Form::text('dispositivo_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('asistencias.index') !!}" class="btn btn-default">Cancelar</a>
</div>
