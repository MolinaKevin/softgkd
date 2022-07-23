<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Nombre:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Familia Field -->
<div class="form-group col-sm-6">
    <div class="form-group col-sm-12">
        {!! Form::label('tipoPago', 'Tipo de pago:') !!}
        {!! Form::select('tipoPago', App\Models\TipoPago::orderBy('name','asc')->pluck('name', 'id'), null, ['placeholder' => 'Tipo de pago', 'class' => 'form-control', 'id' => 'sltTipoPago']) !!}
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('metodoPagos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
