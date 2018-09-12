<!-- Codigo Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::textarea('codigo', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tags.index') !!}" class="btn btn-default">Cancelar</a>
</div>
