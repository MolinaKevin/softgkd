<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $pago->id !!}</p>
</div>

<!-- Precio Field -->
<div class="form-group">
    {!! Form::label('precio', 'Precio:') !!}
    <p>{!! $pago->precio !!}</p>
</div>

<!-- Concepto Field -->
<div class="form-group">
    {!! Form::label('concepto', 'Concepto:') !!}
    <p>{!! $pago->concepto !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $pago->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $pago->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $pago->deleted_at !!}</p>
</div>

<!-- Pagable Id Field -->
<div class="form-group">
    {!! Form::label('pagable_id', 'Pagable Id:') !!}
    <p>{!! $pago->pagable_id !!}</p>
</div>

<!-- Pagable Type Field -->
<div class="form-group">
    {!! Form::label('pagable_type', 'Pagable Type:') !!}
    <p>{!! $pago->pagable_type !!}</p>
</div>

