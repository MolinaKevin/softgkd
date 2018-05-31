<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Precio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio', 'Precio:') !!}
    {!! Form::number('precio', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Field -->
<div class="form-group col-sm-6">
{!! Form::label('cantidad', 'Cantidad:') !!}
{!! Form::number('cantidad', null, ['class' => 'form-control']) !!}

<!-- Date Field -->
    <label class="checkbox-inline">
        {!! Form::hidden('date', false) !!}
        {!! Form::checkbox('date','1', null) !!} Activado días, desactivado clases
    </label>
</div>

<!-- Pordia Field -->
<div class="form-group col-sm-6">
{!! Form::label('porDia', 'Clases por Día:') !!}
{!! Form::number('porDia', null, ['class' => 'form-control']) !!}

<!-- Limite Field -->
    <label class="checkbox-inline">
        {!! Form::hidden('limite', false) !!}
        {!! Form::checkbox('limite', '1', null) !!} Activar limite por Dia
    </label>
</div>


<!-- Usuarios Field -->
<div class="form-group col-sm-12">

    <h3 class="box-title">{!! Form::label('horarios', 'Horarios:') !!}</h3>
    @php
        $temp = 0;
    @endphp
    <div class="row">
        @foreach($horarios->pluck('name', 'id') as $key => $horario)
            @if (($temp%3) == 0 && $temp > 0)
    </div>
    <div class="row">
        @endif
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon">
                    {!! Form::checkbox("horarios[]", $key, null, ['id' => "horario-{$key}"]) !!}
                </span>
                {!! Form::label("horario-{$key}", $horario, ['class' => 'form-control']) !!}
            </div>
        </div>
        @php
            $temp++;
        @endphp
        @endforeach
    </div>

</div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('plans.index') !!}" class="btn btn-default">Cancelar</a>
</div>
