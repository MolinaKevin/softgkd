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
    {!! Form::hidden('deudable_id', 'Deudable Id:') !!}
    {!! Form::hidden('deudable_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Deudable Type Field -->
<div class="form-group col-sm-6">
    {!! Form::hidden('deudable_type', 'Deudable Type:') !!}
    {!! Form::hidden('deudable_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Adeudable Id Field -->
<div class="form-group col-sm-6">
    {!! Form::hidden('adeudable_id', 'Adeudable Id:') !!}
    {!! Form::hidden('adeudable_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Adeudable Type Field -->
<div class="form-group col-sm-6">
    {!! Form::hidden('adeudable_type', 'Adeudable Type:') !!}
    {!! Form::hidden('adeudable_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('deudas.index') !!}" class="btn btn-default">Cancelar</a>
</div>
