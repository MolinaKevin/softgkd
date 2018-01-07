
<table class="table table-responsive" id="plans-table">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Precio</th>
        <th colspan="3">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($plans as $plan)
        <tr>
            <td>{!! $plan->name !!}</td>
            <td>{!! $plan->precio !!}</td>
            <td>
                {!! Form::open(['route' => ['plans.destroy', $plan->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('plans.show', [$plan->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('plans.edit', [$plan->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>