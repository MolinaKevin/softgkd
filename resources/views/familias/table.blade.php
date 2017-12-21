<table class="table table-responsive" id="familias-table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th colspan="3">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($familias as $familia)
        <tr>
            <td>{!! $familia->name !!}</td>
            <td>
                {!! Form::open(['route' => ['familias.destroy', $familia->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('familia.users', [$familia->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-user"></i></a>
                    <a href="{!! route('familia.deudas', [$familia->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-list-alt"></i></a>
                    <a href="{!! route('familia.pagos', [$familia->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-usd"></i></a>
                    <a href="{!! route('familias.show', [$familia->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('familias.edit', [$familia->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>