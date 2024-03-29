<?php

namespace App\DataTables;

use App\Models\Movimiento;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class MovimientoDataTable extends DataTable
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
            ->addColumn('adeudable', function ($movimiento) {
                if (isset($movimiento->adeudable->name)) {
                    return $movimiento->adeudable->name;
                }
                return "No definido";
            })
            ->addColumn('metodo', function ($movimiento) {
                if (isset($movimiento->metodoPago->title)) {
                    return $movimiento->metodoPago->title;
                }
                return "No definido";
            })
            ->addColumn('dataFecha', function ($movimiento) {
                return $movimiento->fecha;
            })
            ->filterColumn('dataFecha', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->addColumn('action', 'movimientos.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Movimiento $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Movimiento $model)
    {
        $model = Movimiento::with('adeudable');

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
                'order'   => [[3, 'desc']],
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
            'precio' => [
                'data' => 'precio',
                'name' => 'movimientos.precio',
                'title' => 'Precio',
                'width' => '10%',
                'class' => 'para-filtro',
            ],
            'concepto' => [
                'data' => 'concepto',
                'name' => 'movimientos.concepto',
                'title' => 'Concepto',
                'width' => '50%',
                'class' => 'para-filtro',
            ],
            'metodo' => [
                'data' => 'metodo',
                'name' => 'movimientos.metodo',
                'title' => 'Metodo de pago',
            ],
            'nombre' => ['data' => 'adeudable', 'name' => 'adeudable', 'title' => 'Asociado a'],
            'created_at' => [
                'data' => 'dataFecha',
                'name' => 'dataFecha',
                'title' => 'Fecha',
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
        return 'movimientosdatatable_' . time();
    }
}
