<!-- Precio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio', 'Precio:') !!}
    {!! Form::text('precio', null, ['class' => 'form-control']) !!}
</div>

<!-- Concepto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('concepto', 'Concepto:') !!}
    {!! Form::text('concepto', null, ['class' => 'form-control']) !!}
</div>

<!-- Familia Field -->
<div class="form-group col-sm-6">
        {!! Form::label('user', 'Usuario:') !!}
        {!! Form::select('user', $users->pluck('name','id'), null, ['placeholder' => 'Elija un usuario', 'class' => 'form-control', 'id' => 'sltUser']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('movimientos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
