<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Cerrado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cerrado', 'Cerrado:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('cerrado', false) !!}
        {!! Form::checkbox('cerrado', '1', null) !!} 1
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('cajas.index') !!}" class="btn btn-default">Cancelar</a>
</div>
