@extends('layouts.app')

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
                <!-- TABLE: LATEST ORDERS -->
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
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div><div class="row docs-premium-template">
                <div class="col-sm-12 col-md-6">
                    <div class="box box-solid">
                        <div class="box-body">
                            <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                                PREMIUM TEMPLATE
                            </h4>
                            <div class="media">
                                <div class="media-left">
                                    <a href="https://themequarry.com/theme/ample-admin-the-ultimate-dashboard-template-ASFEDA95" class="ad-click-event">
                                        <img src="https://themequarry.com/storage/images/approved/ASFEDA95_v2.1_5a0eaa448e2d5.png" alt="Ample Admin" class="media-object" style="width: 150px;height: auto;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="clearfix">
                                        <p class="pull-right">
                                            <a href="https://themequarry.com/theme/ample-admin-the-ultimate-dashboard-template-ASFEDA95" class="btn btn-success btn-sm ad-click-event">
                                                LEARN MORE
                                            </a>
                                        </p>

                                        <h4 style="margin-top: 0">Ample Admin ─ $24</h4>

                                        <p>Admin + Frontend Template</p>
                                        <p style="margin-bottom: 0">
                                            <i class="fa fa-shopping-cart margin-r5"></i> 100+ purchases
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="box box-solid">
                        <div class="box-body">
                            <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                                PREMIUM TEMPLATE
                            </h4>
                            <div class="media">
                                <div class="media-left">
                                    <a href="https://themequarry.com/theme/appzia-responsive-admin-dashboard-ASFEDAAB" class="ad-click-event">
                                        <img src="https://themequarry.com/storage/images/approved/ASFEDAAB_v1.0.0_5992c3326c307.png" alt="Appzia" class="media-object" style="width: 150px;height: auto;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="clearfix">
                                        <p class="pull-right">
                                            <a href="https://themequarry.com/theme/appzia-responsive-admin-dashboard-ASFEDAAB" class="btn btn-success btn-sm ad-click-event">
                                                LEARN MORE
                                            </a>
                                        </p>

                                        <h4 style="margin-top: 0">Appzia ─ $18</h4>

                                        <p>Responsive Admin Dashboard</p>
                                        <p style="margin-bottom: 0">
                                            <i class="fa fa-shopping-cart margin-r5"></i> 9+ purchases
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
