@extends('layouts.app')

@section('css')
    <style type="text/css">
        body { padding-right: 0 !important }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <h1>
            GKD Administracion
            <small>Version 1.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <!-- TABLE: Ultimos ingresos -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ultimos ingresos</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Revisacion medica</th>
                                    <th>Dispositivo</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ingresos as $ingreso)
                                    <tr>
                                        <td>{{ $ingreso->nombre }}</td>
                                        <td>{!! $ingreso->user->badge_estado !!}</td>
                                        @if ($ingreso->user->hasRevisacion())
                                        <td>{{ \Carbon\Carbon::parse($ingreso->user->revisacion->finalizacion)->format('d/m/Y') }}</td>
                                        @else
                                        <td>No tiene</td>
                                        @endif
                                        <td>{{ $ingreso->dispositivo->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="box box-warning col-md-6">
                        <div class="box-header with-border">
                            <h3 class="box-title">Deben Ingresar</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>{{ $ingresables }}</h1>
                                    <!-- ./chart-responsive -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <div class="box box-danger col-md-6">
                        <div class="box-header with-border">
                            <h3 class="box-title">Personas en dispositivo</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>{{ $ingresados }}</h1>
                                    <!-- ./chart-responsive -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- TABLE: Proximas revisaciones -->
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Próximas revisaciones vencidas</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Fecha</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($revisaciones as $revisacion)
                                    <tr>
                                        <td>{{ $revisacion->user->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($revisacion->user->revisacion->finalizacion)->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ultima hora</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="chart-responsive">
                                    <canvas id="pieChart" height="170" width="206"
                                            style="width: 206px; height: 170px;"></canvas>
                                </div>
                                <!-- ./chart-responsive -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Caja actual</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>{{ $caja }}</h1>
                                <!-- ./chart-responsive -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
        <div>

        </div>
    </section>
@endsection

@section('scripts')
    <script>
        function addData(chart, label, data) {
            chart.data.labels.push(label);
            chart.data.datasets.forEach((dataset) => {
                dataset.data.push(data);
            });
            chart.update();
        }

        var ctx = document.getElementById("pieChart").getContext('2d');
        var pieChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Ingresos',
                    data: [],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fixedStepSize: 1
                        }
                    }]
                }
            }
        });


        @foreach($dispositivos as $dispositivo)
            addData(pieChart,"{{ $dispositivo->name }}",{{ $dispositivo->ultima_hora }});
        @endforeach


    </script>
@endsection
