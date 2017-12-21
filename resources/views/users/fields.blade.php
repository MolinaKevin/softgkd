<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Familia Field -->
<div class="form-group col-sm-6">
    <div class="form-group col-sm-12">
        {!! Form::label('familia', 'Familia:') !!}
    </div>
    <div class="form-group col-sm-10">
        {!! Form::select('familia', App\Models\Familia::pluck('name', 'id'), null, ['placeholder' => 'Elija una familia', 'class' => 'form-control', 'id' => 'sltFamilia']) !!}
    </div>
    <div class="form-group col-sm-2">
        {!! Form::button('Nueva', ['class' => 'btn btn-primary','id' => 'btnSubmit']) !!}
    </div>
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancelar</a>
</div>
