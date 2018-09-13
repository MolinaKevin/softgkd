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

<!-- Deudable Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deudable_id', 'Deudable Id:') !!}
    {!! Form::number('deudable_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Deudable Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deudable_type', 'Deudable Type:') !!}
    {!! Form::text('deudable_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Adeudable Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('adeudable_id', 'Adeudable Id:') !!}
    {!! Form::number('adeudable_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Adeudable Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('adeudable_type', 'Adeudable Type:') !!}
    {!! Form::text('adeudable_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('deudas.index') !!}" class="btn btn-default">Cancelar</a>
</div>
