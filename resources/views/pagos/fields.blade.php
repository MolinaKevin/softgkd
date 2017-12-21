<!-- Precio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio', 'Precio:') !!}
    {!! Form::text('precio', null, ['class' => 'form-control']) !!}
</div>

<!-- Familia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('familia_id', 'Familia:') !!}
    {!! Form::select('familia_id', App\Models\Familia::pluck('name', 'id'), null, ['placeholder' => 'Elija una familia', 'class' => 'form-control', 'id' => 'sltFamilia']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pagos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
