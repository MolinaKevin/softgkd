<table class="table table-responsive" id="medicos-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Role</th>
        <th>Remember Token</th>
        <th>Familia Id</th>
            <th colspan="3">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($medicos as $medico)
        <tr>
            <td>{!! $medico->name !!}</td>
            <td>{!! $medico->email !!}</td>
            <td>{!! $medico->password !!}</td>
            <td>{!! $medico->role !!}</td>
            <td>{!! $medico->remember_token !!}</td>
            <td>{!! $medico->familia_id !!}</td>
            <td>
                {!! Form::open(['route' => ['medicos.destroy', $medico->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('medicos.show', [$medico->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('medicos.edit', [$medico->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>