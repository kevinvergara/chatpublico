@extends('layouts.default')
@section('content')
<div id="app"></div>
<div class="container">
    {{--<div class="box-body">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </div>--}}
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Menú</h3>
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#" id="elegir_chat"><i class="fa fa-inbox"></i> Comentar</a></li>
                            <li><a href="#" id="notificaciones"><i class="fa fa-envelope-o"></i> Notificaciones</a></li>
                            <li><a href="#" id="crear_post"><i class="fa fa-envelope-o"></i> Notificaciones</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9" id="contenido">

            </div>
        </div>
    </section>
</div>

@section('css-en-vista')
    {{--recursosapp/ClasificacionCnt/css--}}
@endsection

@section('scripts-en-vista')
    {{--recursosapp/ClasificacionCnt/js--}}
    <script  src="{{ asset('apphome/index.js') }}" type="text/javascript"></script>
@endsection

@endsection