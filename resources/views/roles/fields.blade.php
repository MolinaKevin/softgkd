<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Display Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Descripcion:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Permisos Field -->
<div class="form-group col-sm-12">
    <h3 class="box-title">{!! Form::label('permissions', 'Permisos:') !!}</h3>
    @php
        $temp = 0;
    @endphp
    <div class="row">
        @foreach($permisos->pluck('description', 'id') as $key => $permission)
        <div class="input-group">
            <span class="input-group-addon">
                {!! Form::checkbox("permissions[]", $key, null, ['id' => "permission-{$key}"]) !!}
            </span>
            {!! Form::label("permission-{$key}", $permission, ['class' => 'form-control']) !!}
        </div>
        @endforeach
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('roles.index') !!}" class="btn btn-default">Cancelar</a>
</div>
