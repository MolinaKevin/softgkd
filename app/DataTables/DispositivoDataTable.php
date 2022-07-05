<?php

namespace App\DataTables;

use App\Models\Dispositivo;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class DispositivoDataTable extends DataTable
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

        return $dataTable
            ->setRowAttr([
                'data-id' => '{{$id}}',
            ])
            ->addColumn('action', 'dispositivos.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Dispositivo $model)
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
            ->addAction(['width' => '80px','title' => 'Acciones'])
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
                'width' => '25%',
                'class' => 'para-filtro',
            ],
            'ip' => [
                'data' => 'ip',
                'name' => 'ip',
                'title' => 'IP',
                'width' => '25%',
                'class' => 'para-filtro',
            ],
            'puerto' => [
                'data' => 'puerto',
                'name' => 'puerto',
                'title' => 'Puerto',
                'width' => '20%',
                'class' => 'para-filtro',
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
        return 'dispositivosdatatable_' . time();
    }
}