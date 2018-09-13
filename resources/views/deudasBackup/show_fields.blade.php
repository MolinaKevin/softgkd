<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $deuda->id !!}</p>
</div>

<!-- Precio Field -->
<div class="form-group">
    {!! Form::label('precio', 'Precio:') !!}
    <p>{!! $deuda->precio !!}</p>
</div>

<!-- Familia Id Field -->
<div class="form-group">
    {!! Form::label('familia_id', 'Familia Id:') !!}
    <p>{!! $deuda->familia_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $deuda->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $deuda->updated_at !!}</p>
</div>

