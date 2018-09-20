<!-- Precio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio', 'Precio:') !!}
    {!! Form::number('precio', null, ['class' => 'form-control']) !!}
</div>

<!-- Concepto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('concepto', 'Concepto:') !!}
    {!! Form::text('concepto', null, ['class' => 'form-control']) !!}
</div>

<!-- Pagable Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pagable_id', 'Pagable Id:') !!}
    {!! Form::number('pagable_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Pagable Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pagable_type', 'Pagable Type:') !!}
    {!! Form::text('pagable_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pagos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
