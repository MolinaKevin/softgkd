<?php

namespace App\DataTables;

use App\Models\Caja;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CajaDataTable extends DataTable
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

        return $dataTable->addColumn('user', function (Caja $caja) {
                            return link_to_route('users.index', $caja->user->name, ['q' => $caja->user->name]);
                         })
                         ->addColumn('action', 'cajas.datatables_actions')
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Caja $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['title' => 'Acciones'])
            ->parameters([
                'dom'     => 'Bfrtip',
                'order'   => [[0, 'desc']],
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
			'name' => [
                'data' => 'name',
                'name' => 'name',
                'title' => 'Nombre',
                'width' => '15%',
                'class' => 'para-filtro',
            ],
			'user' => [
                'name' => 'user',
                'data' => 'user',
                'title' => 'Utilizando',
                'render' => 'function(){
                    return data;
                }',
                'searchable' => false,
                'orderable' => false,
                'width' => '10%'
            ],
            'cerrado'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'cajasdatatable_' . time();
    }
}