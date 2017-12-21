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

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-user"></i><span>Usuarios</span></a>
</li>

