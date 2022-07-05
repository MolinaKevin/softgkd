<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class UserRoleDataTableScope implements DataTableScope
{
    /**
     * @var string
     */
    protected $rol;

    /**
     * @param \App\Models\Company $company
     * @param string $relation
     */
    public function __construct($rol)
    {
        $this->rol  = $rol;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        return $query->whereHas('roles', function ($q){
            $q->where('name', $this->rol);
        });
    }
}
