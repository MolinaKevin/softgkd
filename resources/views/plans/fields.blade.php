<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
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
    {!! Form::hidden('date', false, ['id' => 'hiddenDate']) !!}
    {!! Form::hidden('cantidad', false, ['id' => 'hiddenCantidad']) !!}

    <div class="input-group">
        <div class="input-group-btn">
            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                D&iacute;as
                <span class="fa fa-caret-down"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="#" data-id="0">D&iacute;as</a></li>
                <li><a href="#" data-id="1">Clases</a></li>
                <li class="divider"></li>
                <li><a href="#" data-id="2" data-disablear="true">Semana</a></li>
                <li><a href="#" data-id="3" data-disablear="true">Mes</a></li>
                <li><a href="#" data-id="4" data-disablear="true">A&ntilde;o</a></li>
            </ul>
        </div>
        <!-- /btn-group -->
        {!! Form::text('cantidad2', null, ['class' => 'form-control','id' => 'cantidadTxt']) !!}

    </div>
</div>
<!-- Pordia Field -->

<div class="col-sm-6">
    {!! Form::label('porDia', 'Clases por Día:') !!}
    <div class="input-group">
        <span class="input-group-addon">
            <!-- Limite Field -->
            {!! Form::checkbox('limite', '1', null, ['id' => "limiteCbx"]) !!}
        </span>
        {!! Form::number("porDia", null, ['class' => 'form-control', 'id' => "limiteTxt", 'disabled' => 'true']) !!}
    </div>
</div>

<!-- Horarios Field -->
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


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('plans.index') !!}" class="btn btn-default">Cancelar</a>
</div>
