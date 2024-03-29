<?php

namespace App\DataTables;

use App\Models\User;
use DebugBar\DebugBar;
use Illuminate\Support\Facades\DB;
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
                'data-deuda' => '{{$estado}}'
            ])
            ->addColumn('estado', function ($user) {
                return $user->estado;
            })
            ->addColumn('agregar', function ($user) {
                return route('users.agregar', $user->id);
            })
            ->addColumn('grupo', function (User $user) {
                return link_to_route('familias.index', $user->familia->name, ['q' => $user->familia->name]);
            })
            //->addColumn('aCuenta', function (User $user) {
            //    return $user->cuenta;
            //})
            ->filterColumn('name', function($query, $keyword) {
                $sql = "CONCAT(users.first_name,' ',users.last_name) like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('grupo', function($query, $keyword) {
                $sql = "users.familia.name like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action', 'users.datatables_actions')
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $model = User::select([
                '*',
                DB::raw("CONCAT(users.first_name,' ',users.last_name) as name"),
            ])
            ->with('familia');

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
            'initComplete' => 'function () {this.api().columns(\'.para-filtro\').every(function () {var column = this;var input = document.createElement("input");$(input).appendTo($(column.footer()).empty()).on(\'input\', function () {column.search($(this).val(), false, false, true).draw();}).width(\'100%\');});}',
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
            'name' => [
                'data' => 'name',
                'name' => 'name',
                'title' => 'Nombre',
                'width' => '15%',
                'class' => 'para-filtro',
            ],
            //'email' => [
            //    'data' => 'email',
            //    'title' => 'Email',
            //    'width' => '10%',
            //    'class' => 'para-filtro',
            //],
            'estado' => [
                'data' => 'estado',
                'title' => 'Estado',
                'render' => 'function(){
                    return \'<a href=\"users/estado/\'+data+\'\" class="label label-\'+data.replace(/\s(.)/g, function($1) { return $1.toUpperCase(); }).replace(/\s/g, \'\').replace(/^(.)/, function($1) { return $1.toLowerCase(); })+\'">\'+data+\'</a>\';
                }',
                'width' => '3%',
                'searchable' => true,
                'sortable' =>true
            ],
            'grupo' => [
                'name' => 'grupo',
                'data' => 'grupo',
                'title' => 'Grupo',
                'render' => 'function(){
                    return data;
                }',
                'searchable' => false,
                'orderable' => false,
                'width' => '10%'
            ],
            //'cuenta' => [
            //    'name' => 'aCuenta',
            //    'data' => 'aCuenta',
            //    'title' => 'Cuenta',
            //    'searchable' => true,
            //    'orderable' => true,
            //    'width' => '10%'
            //],

            'descuento' => [
                'data' => 'descuento',
                'title' => 'Descuento',
                'width' => '5%',
                'class' => 'para-filtro',
            ],
            'proximo_vencimiento' => [
                'data' => 'proximo_vencimiento',
                'title' => 'Proximo Vencimiento',
                'width' => '5%',
                'class' => 'para-filtro',
                'searchable' => false,
                'orderable' => false,

            ],
            'agregar' => [
                'data' => 'agregar',
                'title' => 'Habilitar',
                'render' => 'function(id){
                    return \'<a href=\"\'+data+\'\" class="btn btn-info btn-xs">Habilitar usuario</a>\';
                }',
                'width' => '1%'
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
