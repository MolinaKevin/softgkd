<table class="table table-responsive" id="revisacions-table">
    <thead>
    <tr>
        <th>Descripcion</th>
        <th>Validaci&oacute;n</th>
        <th>Finalizacion</th>
        <th>Medico</th>
        <th>Usuario</th>
        <th colspan="3">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($revisacions as $revisacion)
        <tr>
            <td>{!! $revisacion->descripcion !!}</td>
            @if ($revisacion->isVencida())
                <td>Vencida</td>
            @else
                <td>{!! $revisacion->aprobado_texto !!}</td>
            @endif
            @if ($revisacion->aprobado)
                <td>{!! $revisacion->finalizacion !!}</td>
            @else
                <td>Rechazado</td>
            @endif
            <td>{!! $revisacion->medico->name !!}</td>
            <td>{!! $revisacion->user->name !!}</td>
            <td>
                {!! Form::open(['route' => ['revisacions.destroy', $revisacion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('revisacions.show', [$revisacion->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('revisacions.edit', [$revisacion->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿EStas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>