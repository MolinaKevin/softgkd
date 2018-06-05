<!-- First Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', 'Nombre:') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_name', 'Apellido:') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>

<!-- DNI Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dni', 'DNI:') !!}
    {!! Form::text('dni', null, ['class' => 'form-control']) !!}
</div>

<!-- Direccion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Direccion:') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
</div>

<!-- Telefono Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telefono', 'Telefono:') !!}
    {!! Form::number('telefono', null, ['class' => 'form-control']) !!}
</div>

<!-- Celular Field -->
<div class="form-group col-sm-6">
    {!! Form::label('celular', 'Celular:') !!}
    {!! Form::number('celular', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Nacimiento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_nacimiento', 'Fecha de nacimiento:') !!}
    {!! Form::date('fecha_nacimiento',(isset($user)) ? $user->fecha_nacimiento->format('Y-m-d') : false , ['class' => 'form-control']) !!}
</div>

<!-- Sexo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sexo', 'Sexo:') !!}
    {!! Form::select('sexo', ['masculino' => 'Masculino', 'femenino' => 'Femenino'], 'M', ['class' => 'form-control']) !!}
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
        {!! Form::select('familia', App\Models\Familia::orderBy('name','asc')->pluck('name', 'id'), null, ['placeholder' => 'Elija una familia', 'class' => 'form-control', 'id' => 'sltFamilia']) !!}
    </div>
    <div class="form-group col-sm-2">
        {!! Form::button('Nueva', ['class' => 'btn btn-primary','id' => 'btnSubmit']) !!}
    </div>
</div>

<!-- Descuento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descuento', 'Descuento:') !!}
    {!! Form::number('descuento', null, ['class' => 'form-control']) !!}
</div>


<!-- Roles Field -->
<div class="form-group col-sm-12">
    <h3 class="box-title">{!! Form::label('roles', 'Roles:') !!}</h3>
    @php
        $temp = 0;
    @endphp
    <div class="row">
        @foreach($roles->pluck('name', 'id') as $key => $rol)
            @if (($temp%3) == 0 && $temp > 0)
    </div>
    <div class="row">
        @endif
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon">
                    {!! Form::checkbox("roles[]", $key, null, ['id' => "rol-{$key}"]) !!}
                </span>
                {!! Form::label("rol-{$key}", $rol, ['class' => 'form-control']) !!}
            </div>
        </div>
        @php
            $temp++;
        @endphp
        @endforeach
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancelar</a>
</div>
