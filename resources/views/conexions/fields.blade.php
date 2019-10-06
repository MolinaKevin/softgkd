<!-- Concepto Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('concepto', 'Concepto:') !!}
    {!! Form::textarea('concepto', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('conexions.index') !!}" class="btn btn-default">Cancelar</a>
</div>
