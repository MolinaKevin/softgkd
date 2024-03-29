{!! Form::open(['route' => ['dispositivos.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="#" class='btn btn-default btn-xs btnPlan'><i class="glyphicon glyphicon-plus"></i></a>
    <a href="#" class='btn btn-warning btn-xs btnEspecial'><i class="glyphicon glyphicon-plus"></i></a>
    <a href="#" class='btn btn-success btn-xs btnPlanes'><i class="glyphicon glyphicon-eye-open"></i></a>
    <a href="{{ route('dispositivos.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    <a href="{{ route('dispositivos.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('¿Estas seguro?')"
    ]) !!}
</div>
{!! Form::close() !!}
