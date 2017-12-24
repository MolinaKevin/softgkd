<table class="table table-responsive" id="revisacions-table">
    <thead>
    <tr>
        <th>Descripcion</th>
        <th>Aprobado</th>
        <th>Finalizacion</th>
        <th>Medico</th>
        <th>User</th>
        <th colspan="3">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($revisacions as $revisacion)
        <tr>
            <td>{!! $revisacion->descripcion !!}</td>
            <td>{!! $revisacion->aprobado !!}</td>
            <td>{!! $revisacion->finalizacion !!}</td>
            <td>{!! $revisacion->medico_id !!}</td>
            <td>{!! $revisacion->user_id !!}</td>
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