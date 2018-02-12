<!-- Dia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dia', 'Dia:') !!}
    {!! Form::select('dia', ['SUNDAY' => 'SUNDAY', 'MONDAY' => 'MONDAY', 'TUESDAY' => 'TUESDAY', 'WEDNESDAY' => 'WEDNESDAY', 'THURSDAY' => 'THURSDAY', 'FRIDAY' => 'FRIDAY', 'SATURDAY' => 'SATURDAY'], null, ['class' => 'form-control']) !!}
</div>

<!-- Hora Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hora', 'Hora:') !!}
    {!! Form::time('hora', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('horarios.index') !!}" class="btn btn-default">Cancelar</a>
</div>
