<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Usuarios Field -->
<div class="form-group col-sm-6">
    {!! Form::label('users', 'Usuarios:') !!}
    <span id="helpBlock" class="help-block">Utilice ctrl. para seleccionar mas de una persona.</span>
    {!! Form::select('users[]', App\Models\User::where('role','cliente')->pluck('name', 'id'), null, ['id' => 'users', 'multiple' => 'multiple', 'class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('familias.index') !!}" class="btn btn-default">Cancelar</a>
</div>
