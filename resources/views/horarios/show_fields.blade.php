<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $horario->id !!}</p>
</div>

<!-- Dia Field -->
<div class="form-group">
    {!! Form::label('dia', 'Dia:') !!}
    <p>{!! $horario->dia !!}</p>
</div>

<!-- Hora Field -->
<div class="form-group">
    {!! Form::label('hora', 'Hora:') !!}
    <p>{!! $horario->hora !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $horario->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $horario->updated_at !!}</p>
</div>

