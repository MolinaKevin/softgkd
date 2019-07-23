<?php

namespace App\DataTables\Scopes;

use Carbon\Carbon;
use Yajra\DataTables\Contracts\DataTableScope;

class UserFilterByEstadoCorrectoDataTableScope implements DataTableScope
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
        return $query->whereHas('huellas')->doesntHave('deudas')->doesntHave('revisacions')->orWhereHas('revisacions', function ($q){
            $q->where('finalizacion',">=", Carbon::now())->orWhere('aprobado', '=', false);
        })->orWhereDoesntHave('asistencias', function ($q){
            $q->where('created_at',">", Carbon::now()->subMonth()->startOfMonth());
        });
    }
}
