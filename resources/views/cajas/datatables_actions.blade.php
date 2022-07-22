{!! Form::open(['route' => ['cajas.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @php
        $id;
    @endphp
    @if($caja)
    <a href="#" class='btn btn-success btn-xs abrirCaja'><i class="glyphicon glyphicon-folder-open"></i></a>
    @else
    <a href="#" class='btn btn-success btn-xs cerrarCaja'><i class="glyphicon glyphicon-folder-close"></i></a>
    @endif
    <a href="{{ route('cajas.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    <a href="{{ route('cajas.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('¿Estas seguro?')"
    ]) !!}
</div>
{!! Form::close() !!}
