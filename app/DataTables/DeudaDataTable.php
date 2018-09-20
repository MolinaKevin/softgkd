<?php

namespace App\DataTables;

use App\Models\Deuda;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class DeudaDataTable extends DataTable
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
            ->addColumn('adeudable', function ($user) {
                return $user->adeudable->name;
            })->addColumn('action', 'deudas.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Deuda $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Deuda $model)
    {
        $model = Deuda::with('adeudable');

        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()->columns($this->getColumns())->minifiedAjax()->addAction([
            'width' => '80px',
            'title' => 'Acciones',
        ])->parameters([
            'dom' => 'Bfrtip',
            'scrollX' => false,
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
            'initComplete' => 'function () {this.api().columns(\'.para-filtro\').every(function () {var column = this;var input = document.createElement("input");$(input).appendTo($(column.footer()).empty()).on(\'change\', function () {column.search($(this).val(), false, false, true).draw();}).width(\'100%\');});}',
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
            'precio' => [
                'data' => 'precio',
                'name' => 'deudas.precio',
                'title' => 'Precio',
                'width' => '10%',
                'class' => 'para-filtro',
            ],
            'concepto' => [
                'data' => 'concepto',
                'name' => 'deudas.concepto',
                'title' => 'Concepto',
                'width' => '50%',
                'class' => 'para-filtro',
            ],
            'nombre' => ['data' => 'adeudable', 'name' => 'adeudable', 'title' => 'Asociado a'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'deudasdatatable_'.time();
    }
}