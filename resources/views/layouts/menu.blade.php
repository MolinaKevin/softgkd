<li class="{{ Request::is('familias*') ? 'active' : '' }}">
    <a href="{!! route('familias.index') !!}"><i class="fa fa-users"></i><span>Familias</span></a>
</li>

<li class="{{ Request::is('plans*') ? 'active' : '' }}">
    <a href="{!! route('plans.index') !!}"><i class="fa fa-dollar"></i><span>Planes</span></a>
</li>

<li class="{{ Request::is('revisacions*') ? 'active' : '' }}">
    <a href="{!! route('revisacions.index') !!}"><i class="fa fa-stethoscope"></i><span>Revisaciones</span></a>
</li>

<li class="{{ Request::is('deudas*') ? 'active' : '' }}">
    <a href="{!! route('deudas.index') !!}"><i class="fa fa-book"></i><span>Deudas</span></a>
</li>

<li class="{{ Request::is('pagos*') ? 'active' : '' }}">
    <a href="{!! route('pagos.index') !!}"><i class="fa fa-credit-card"></i><span>Pagos</span></a>
</li>

<li class="treeview {{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}">
        <i class="fa fa-user"></i><span>Usuarios</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="{!! route('users.index') !!}">Todos</a>
        </li>
        @foreach($roles as $rol)
            <li>
                <a href="{{ route('users.roles',str_slug($rol->name)) }}">
                    {{ $rol->name }}
                </a>
            </li>
        @endforeach
    </ul>
</li>


<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a href="{!! route('roles.index') !!}"><i class="fa fa-edit"></i><span>Roles</span></a>
</li>

<li class="{{ Request::is('horarios*') ? 'active' : '' }}">
    <a href="{!! route('horarios.index') !!}"><i class="fa fa-edit"></i><span>Horarios</span></a>
</li>


<li class="{{ Request::is('asistencias*') ? 'active' : '' }}">
    <a href="{!! route('asistencias.index') !!}"><i class="fa fa-edit"></i><span>Asistencias</span></a>
</li>


<li class="{{ Request::is('huellas*') ? 'active' : '' }}">
    <a href="{!! route('huellas.index') !!}"><i class="fa fa-edit"></i><span>Huellas</span></a>
</li>

