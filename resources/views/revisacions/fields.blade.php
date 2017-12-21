<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Aprobado Field -->
<div class="form-group col-sm-12">
    {!! Form::label('aprobado', 'Aprobado:') !!}
    <label class="radio-inline">
        {!! Form::radio('aprobado', "1", null) !!} Si
    </label>

    <label class="radio-inline">
        {!! Form::radio('aprobado', "0", null) !!} No
    </label>

</div>

<!-- Finalizacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('finalizacion', 'Finalizacion:') !!}
    {!! Form::date('finalizacion', null, ['class' => 'form-control']) !!}
</div>

<!-- Medico Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('medico_id', 'Medico Id:') !!}
    {!! Form::number('medico_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('revisacions.index') !!}" class="btn btn-default">Cancelar</a>
</div>
