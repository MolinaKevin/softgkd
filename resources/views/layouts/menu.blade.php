<li class="{{ Request::is('home*') ? 'active' : '' }}">
    <a href="{!! route('home') !!}"><i class="fas fa-laptop"></i><span>Dashboard</span></a>
</li>
@can('familias.index')
<li class="{{ Request::is('familias*') ? 'active' : '' }}">
    <a href="{!! route('familias.index') !!}"><i class="fa fa-users"></i><span>Grupos</span></a>
</li>
@endcan
@can('plans.index')
<li class="{{ Request::is('plans*') ? 'active' : '' }}">
    <a href="{!! route('plans.index') !!}"><i class="fa fa-folder-open"></i><span>Planes</span></a>
</li>
@endcan
@can('especials.index')
<li class="{{ Request::is('especials*') ? 'active' : '' }}">
    <a href="{!! route('especials.index') !!}"><i class="fa fa-calendar"></i><span>Planes especiales</span></a>
</li>
@endcan
@can('revisacions.index')
<li class="{{ Request::is('revisacions*') ? 'active' : '' }}">
    <a href="{!! route('revisacions.index') !!}"><i class="fa fa-stethoscope"></i><span>Revisaciones</span></a>
</li>
@endcan
@can('deudas.index')
<li class="{{ Request::is('deudas*') ? 'active' : '' }}">
    <a href="{!! route('deudas.index') !!}"><i class="fa fa-book"></i><span>Deudas</span></a>
</li>
@endcan
@can('pagos.index')
<li class="{{ Request::is('pagos*') ? 'active' : '' }}">
    <a href="{!! route('pagos.index') !!}"><i class="fa fa-usd"></i><span>Pagos</span></a>
</li>
@endcan
@can('users.index')
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
@endcan
@can('roles.index')
<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a href="{!! route('roles.index') !!}"><i class="fa fa-sitemap"></i><span>Roles</span></a>
</li>
@endcan
@can('horarios.index')
<li class="{{ Request::is('horarios*') ? 'active' : '' }}">
    <a href="{!! route('horarios.index') !!}"><i class="fa fa-clock-o"></i><span>Horarios</span></a>
</li>
@endcan
@can('asistencias.index')
<li class="{{ Request::is('asistencias*') ? 'active' : '' }}">
    <a href="{!! route('asistencias.index') !!}"><i class="fa fa-list-alt"></i><span>Asistencias</span></a>
</li>
@endcan
@can('dispositivos.index')
<li class="{{ Request::is('dispositivos*') ? 'active' : '' }}">
    <a href="{!! route('dispositivos.index') !!}"><i class="fa fa-laptop"></i><span>Dispositivos</span></a>
</li>
@endcan

<li class="{{ Request::is('cajas*') ? 'active' : '' }}">
    <a href="{!! route('cajas.index') !!}"><i class="fa fa-edit"></i><span>Cajas</span></a>
</li>

{{-- <li class="{{ Request::is('arqueos*') ? 'active' : '' }}">
    <a href="{!! route('arqueos.index') !!}"><i class="fa fa-edit"></i><span>Cierre de caja</span></a>
</li> --}}

<li class="{{ Request::is('movimientos*') ? 'active' : '' }}">
    <a href="{!! route('movimientos.index') !!}"><i class="fa fa-edit"></i><span>Movimientos</span></a>
</li>

<li class="{{ Request::is('metodoPagos*') ? 'active' : '' }}">
    <a href="{!! route('metodoPagos.index') !!}"><i class="fa fa-edit"></i><span>Metodo Pagos</span></a>
</li>

<li class="{{ Request::is('tipoPagos*') ? 'active' : '' }}">
    <a href="{!! route('tipoPagos.index') !!}"><i class="fa fa-edit"></i><span>Tipo Pagos</span></a>
</li>

<li class="{{ Request::is('conexions*') ? 'active' : '' }}">
    <a href="{!! route('conexions.index') !!}"><i class="fa fa-edit"></i><span>Conexions</span></a>
</li>

<li class="{{ Request::is('opciones*') ? 'active' : '' }}">
    <a href="{!! route('opciones.index') !!}"><i class="fa fa-edit"></i><span>Opciones</span></a>
</li>

