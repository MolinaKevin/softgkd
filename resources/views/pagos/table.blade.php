<table class="table table-responsive" id="pagos-table">
    <thead>
    <tr>
        <th>Precio</th>
        <th>Concepto</th>
        <th>Familia</th>
        <th colspan="3">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pagos as $pago)
        <tr>
            <td>{!! $pago->precio !!}</td>
            <td>{!! $pago->concepto !!}</td>
            <td>{!! $pago->pagable->name !!}</td>
            <td>
                {!! Form::open(['route' => ['pagos.destroy', $pago->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('pagos.show', [$pago->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('pagos.edit', [$pago->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>