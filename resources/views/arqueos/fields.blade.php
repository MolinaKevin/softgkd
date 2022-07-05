<!-- Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total', 'Movimientos desde el ultimo cierre:') !!}
    {!! Form::text('total', $total, ['class'=>'form-control','readonly']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('', 'Total en caja:') !!}
    {!! Form::text('', $definitivo, ['class'=>'form-control','readonly']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('arqueos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
