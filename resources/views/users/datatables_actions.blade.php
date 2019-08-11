{!! Form::open(['route' => ['users.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="#" class='btn btn-success btn-xs btnPago'><i class="glyphicon glyphicon-usd"></i></a>
    <a href="#" class='btn btn-default btn-xs btnDeuda'><i class="glyphicon glyphicon-paperclip"></i></a>
    <a href="{{ route('users.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    <a href="#" class='btn btn-default btn-xs btnAdmin'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('¿Estas seguro?')"
    ]) !!}
</div>
{!! Form::close() !!}
