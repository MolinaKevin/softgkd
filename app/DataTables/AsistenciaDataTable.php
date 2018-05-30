<?php

namespace App\DataTables;

use App\Models\Asistencia;
use App\Models\User;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class AsistenciaDataTable extends DataTable
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
        return $dataTable->addColumn('action', 'asistencias.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Asistencia $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Asistencia $model)
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
            'fecha' => ['data' => 'fecha','name' => 'asistencias.horario','title' => 'Fecha'],
            'hora' => ['data' => 'hora','name' => 'asistencias.horario','title' => 'Hora'],
            'actividad' => ['data' => 'actividad','name' => 'asistencias.actividad','title' => 'Actividad'],
            'user' => ['data' => 'asistencias.user.id','name' => 'asistencias.user.id','title' => 'aaa'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'asistenciasdatatable_' . time();
    }
}