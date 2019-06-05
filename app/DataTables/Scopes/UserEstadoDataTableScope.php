<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class UserEstadoDataTableScope implements DataTableScope
{
    /**
     * @var string
     */
    protected $estado;

    /**
     * @param \App\Models\Company $company
     * @param string $relation
     */
    public function __construct($estado)
    {
        $this->estado = $estado;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        return $query->filter(function($query) {
            if ($this->request()->has('search.value')) {

            }
        });
    }
}
