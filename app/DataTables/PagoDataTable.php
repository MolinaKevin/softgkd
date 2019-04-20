<?php

namespace App\DataTables;

use App\Models\Pago;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class PagoDataTable extends DataTable
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
            ->addColumn('usuario', function ($pago) {
                return $pago->asociado;
            })
            ->orderColumn('usuario', 'concepto $1')
            ->addColumn('dataFecha', function ($pago) {
                return $pago->fecha;
            })
            ->addColumn('dataDia', function ($pago) {
                return $pago->dia;
            })
            ->addColumn('dataMes', function ($pago) {
                return $pago->mes;
            })
            ->addColumn('dataAnio', function ($pago) {
                return $pago->anio;
            })
            ->orderColumn('dataDia', 'updated_at $1')
            ->orderColumn('dataMes', 'updated_at $1')
            ->orderColumn('dataAnio', 'updated_at $1')
            ->filterColumn('dataDia', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%d') like ?", ["%$keyword%"]);
            })
            ->filterColumn('dataMes', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%m') like ?", ["%$keyword%"]);
            })
            ->filterColumn('dataAnio', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%Y') like ?", ["%$keyword%"]);
            })
            ->editColumn('updated_at', function ($user) {
                return $user->updated_at->format('Y/m/d');
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->addColumn('action', 'pagos.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pago $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pago $model)
    {
        $model = Pago::with('pagable')->orderBy('id','desc');

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
                'order'   => [[2, 'desc']],
                'buttons' => [
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
            'nombre' => [
                'data' => 'usuario',
                'name' => 'usuario',
                'title' => 'Asociado',
            ],
            'updated_at' => [
                'data' => 'updated_at',
                'name' => 'updated_at',
                'title' => '',
                "visible" => false,
            ],
            'precio' => [
                'data' => 'precio',
                'name' => 'pagos.precio',
                'title' => 'Precio',
                'width' => '10%',
                'class' => 'para-filtro',
            ],
            'concepto' => [
                'data' => 'concepto',
                'name' => 'pagos.concepto',
                'title' => 'Concepto',
                'width' => '40%',
                'class' => 'para-filtro',
            ],
            'dia' => [
                'data' => 'dataDia',
                'name' => 'dataDia',
                'title' => 'Día',
                'class' => 'para-filtro',
            ],
            'mes' => [
                'data' => 'dataMes',
                'name' => 'dataMes',
                'title' => 'Mes',
                'class' => 'para-filtro',
            ],
            'anio' => [
                'data' => 'dataAnio',
                'name' => 'dataAnio',
                'title' => 'Año',
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
        return 'pagosdatatable_' . time();
    }
}