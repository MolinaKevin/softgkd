<?php

namespace App\DataTables\Scopes;

use Carbon\Carbon;
use Yajra\DataTables\Contracts\DataTableScope;

class UserFilterByEstadoInactivoDataTableScope implements DataTableScope
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
        $this->string  = $estado;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        return $query->doesntHave('deudas')->orWhereDoesntHave('asistencias', function ($q){
            $q->where('created_at',"<=", Carbon::now()->subMonth()->startOfMonth());
        });
    }
}
