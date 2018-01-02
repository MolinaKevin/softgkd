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

<!-- Medico Field -->
<div class="form-group col-sm-6">
    {!! Form::label('medico', 'Medico:') !!}
    {!! Form::select('medico', App\Models\User::where('role','medico')->pluck('name', 'id'), null, ['placeholder' => 'Elija un medico', 'class' => 'form-control', 'id' => 'sltMedico']) !!}
</div>

<!-- User Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user', 'Usuario:') !!}
    {!! Form::select('user', App\Models\User::pluck('name', 'id'), null, ['placeholder' => 'Elija un usuario', 'class' => 'form-control', 'id' => 'sltUser']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('revisacions.index') !!}" class="btn btn-default">Cancelar</a>
</div>
