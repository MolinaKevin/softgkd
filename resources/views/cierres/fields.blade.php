<!-- At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('at', 'At:') !!}
    {!! Form::date('at', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('cierres.index') !!}" class="btn btn-default">Cancelar</a>
</div>
