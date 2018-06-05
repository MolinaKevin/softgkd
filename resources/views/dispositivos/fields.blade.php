<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Ip Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ip', 'Ip:') !!}
    {!! Form::text('ip', null, ['class' => 'form-control']) !!}
</div>

<!-- Puerto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('puerto', 'Puerto:') !!}
    {!! Form::text('puerto', null, ['class' => 'form-control']) !!}
</div>

<!-- Planes Field -->
<div class="form-group col-sm-12">

    <h3 class="box-title">{!! Form::label('plans', 'Planes:') !!}</h3>
    @php
        $temp = 0;
    @endphp
    <div class="row">
        @foreach($planes->pluck('name', 'id') as $key => $plan)
            @if (($temp%3) == 0 && $temp > 0)
    </div>
    <div class="row">
        @endif
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon">
                    {!! Form::checkbox("plans[]", $key, null, ['id' => "plan-{$key}"]) !!}
                </span>
                {!! Form::label("plan-{$key}", $plan, ['class' => 'form-control']) !!}
            </div>
        </div>
        @php
            $temp++;
        @endphp
        @endforeach
    </div>
</div>

<!-- Planes Especiales Field -->
<div class="form-group col-sm-12">

    <h3 class="box-title">{!! Form::label('especials', 'Planes Especiales:') !!}</h3>
    @php
        $temp = 0;
    @endphp
    <div class="row">
        @foreach($especials->pluck('name', 'id') as $key => $especial)
            @if (($temp%3) == 0 && $temp > 0)
    </div>
    <div class="row">
        @endif
        <div class="col-lg-4">
            <div class="input-group">
                <span class="input-group-addon">
                    {!! Form::checkbox("especials[]", $key, null, ['id' => "especial-{$key}"]) !!}
                </span>
                {!! Form::label("especial-{$key}", $plan, ['class' => 'form-control']) !!}
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
    <a href="{!! route('dispositivos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
