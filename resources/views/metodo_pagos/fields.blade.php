<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Nombre:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Cash Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cash', 'Cash:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('cash', 'false') !!}
        {!! Form::checkbox('cash', '1', false) !!} 1
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('metodoPagos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
