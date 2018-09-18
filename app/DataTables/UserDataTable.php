<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->setRowAttr([
                'data-id' => '{{$id}}',
            ])->addColumn('estado', function ($user) {
                return $user->badge_estado;
            })->addColumn('agregar', function ($user) {
                return route('users.agregar', $user->id);
            })->addColumn('grupo', function ($user) {
                return link_to_route('familias.index', $user->familia->name, ['q' => $user->familia->name]);
            })->addColumn('action', 'users.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $model = User::orderBy('first_name', 'ASC')->orderBy('last_name', 'ASC')->with('familia');

        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()->columns($this->getColumns())->minifiedAjax()->addAction(['title' => 'Acciones'])->parameters([
                'dom' => 'Bfrtip',
                'order' => [[0, 'desc']],
                'buttons' => [
                    [
                        'extend' => 'create',
                        'text' => '<i class="fa fa-plus"></i> Crear',
                    ],
                    [
                        'extend' => 'export',
                        'text' => '<i class="fa fa-download"></i> Exportar',
                    ],
                    [
                        'extend' => 'print',
                        'text' => '<i class="fa fa-print"></i> Imprimir',
                    ],
                    [
                        'extend' => 'reset',
                        'text' => '<i class="fa fa-undo"></i> Limpiar',
                    ],
                    [
                        'extend' => 'reload',
                        'text' => '<i class="fa fa-refresh"></i> Recargar',
                    ],
                ],
                'select' => true,
                'initComplete' => 'function () {this.api().columns().every(function () {var column = this;var input = document.createElement("input");$(input).appendTo($(column.footer()).empty()).on(\'change\', function () {column.search($(this).val(), false, false, true).draw();});});}',
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => ['visible' => false, 'exportable' => true],
            'first_name' => ['data' => 'first_name', 'name' => 'first_name', 'title' => 'Nombre'],
            'last_name' => ['data' => 'last_name', 'name' => 'last_name', 'title' => 'Apellido'],
            'email',
            'estado' => [
                'data' => 'estado',
                'title' => 'Estado',
                'render' => 'function(){
                    return \'<span class="label label-\'+data.replace(/\s(.)/g, function($1) { return $1.toUpperCase(); }).replace(/\s/g, \'\').replace(/^(.)/, function($1) { return $1.toLowerCase(); })+\'">\'+data+\'</span>\';
                }',
            ],
            'grupo' => [
                'name' => 'grupo',
                'data' => 'grupo',
                'title' => 'Grupo',
                'searchable' => false,
                'ordereable' => false,
                'render' => 'function(){
                    return data;
                }',
            ],
            'agregar' => [
                'data' => 'agregar',
                'title' => 'Habilitar',
                'render' => 'function(id){
                    return \'<a href=\"\'+data+\'\" class="btn btn-info btn-xs">Habilitar usuario</a>\';
                }',
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'usersdatatable_'.time();
    }
}