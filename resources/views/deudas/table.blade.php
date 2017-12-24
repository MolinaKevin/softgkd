<table class="table table-responsive" id="deudas-table">
    <thead>
    <tr>
        <th>Precio</th>
        <th>Familia</th>
        <th colspan="3">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($deudas as $deuda)
        <tr>
            <td>{!! $deuda->precio !!}</td>
            <td>{!! $deuda->familia->name !!}</td>
            <td>
                {!! Form::open(['route' => ['deudas.destroy', $deuda->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('deudas.show', [$deuda->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('deudas.edit', [$deuda->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>