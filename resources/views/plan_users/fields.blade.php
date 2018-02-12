<!-- Vencimiento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vencimiento', 'Vencimiento:') !!}
    {!! Form::date('vencimiento', null, ['class' => 'form-control']) !!}
</div>

<!-- Clases Field -->
<div class="form-group col-sm-6">
    {!! Form::label('clases', 'Clases:') !!}
    {!! Form::number('clases', null, ['class' => 'form-control']) !!}
</div>

<!-- Pagado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pagado', 'Pagado:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('pagado', false) !!}
        {!! Form::checkbox('pagado', '1', null) !!} 1
    </label>
</div>

<!-- Plan Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('plan_id', 'Plan Id:') !!}
    {!! Form::number('plan_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('planUsers.index') !!}" class="btn btn-default">Cancelar</a>
</div>
