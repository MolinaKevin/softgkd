<table class="table table-responsive" id="users-table">
    <thead>
    <tr>
        <th>Nombre Completo</th>
        <th>Email</th>
        <th>Familia</th>
        <th colspan="3">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr data-id="{{ $user->id }}">
            <td>{!! $user->name !!}</td>
            <td>{!! $user->email !!}</td>
            <td>{!! link_to_route('familias.index', $user->familia->name, ['q' => $user->familia->name]) !!}</td>
            <td>
                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="#" class='btn btn-success btn-xs btnPago'><i class="glyphicon glyphicon-usd"></i></a>
                    <a href="#" class='btn btn-default btn-xs btnPlan'><i class="glyphicon glyphicon-plus"></i></a>
                    <a href="{!! route('especials.user.create', [$user->id]) !!}" class='btn btn-warning btn-xs'><i class="glyphicon glyphicon-plus"></i></a>
                    <a href="#" class='btn btn-default btn-xs btnHuella'><i class="glyphicon glyphicon-record"></i></a>
                    <a href="{!! route('users.plans', [$user->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-list-alt"></i></a>
                    <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>