<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Horarios Field -->
<div class="form-group col-sm-12">

    <h3 class="box-title">{!! Form::label('users', 'Usuarios:') !!}</h3>
    @php
        $temp = 0;
    @endphp
    <div class="row">
        @foreach(\App\Models\User::orderBy('first_name')->get()->pluck('name', 'id') as $key => $user)
            @if (($temp%3) == 0 && $temp > 0)
    </div>
    <div class="row">
        @endif
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon">
                    {!! Form::checkbox("users[]", $key, null, ['id' => "user-{$key}"]) !!}
                </span>
                {!! Form::label("user-{$key}", $user, ['class' => 'form-control']) !!}
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
    <a href="{!! route('familias.index') !!}" class="btn btn-default">Cancelar</a>
</div>
