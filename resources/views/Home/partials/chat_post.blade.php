<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Post</h3>
    </div>
    <form class="form-horizontal file-upload" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id_post" value="{{$post->idpost}}">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input class="form-control" placeholder="Post" value="{{ "#".$post->idpost }}" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="compose-textarea">Creador</label>
                        <input class="form-control" placeholder="Usuario" value="{{ $usuario_post->nick_usuario }}" disabled>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="compose-textarea">Texto Post</label>
                        <textarea id="compose-textarea" class="form-control" disabled>{{ $post->texto }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" style="">
                    <div class="box box-primary">
                        <div class="box-body" style="height: 400px; overflow-y: scroll;">
                            <!-- The time line -->
                            <ul class="timeline">
                                @foreach ($chat as $item)
                                    {{--
                                        "comentario.idcomentario as id_comentario",
                                "comentario.comentario_text as comentario",
                                "comentario.extension_archivo as extension_arch",
                                "comentario.ruta_archivo as ruta_storage",
                                "comentario.usuario_idusuario as id_user",
                                "comentario.fecha_comentario as fecha",
                                "comentario.key_redis_comentario as key_redis",
                                "comentario.tipo_id_post as tipo_comentario",
                                "usuario.nick_usuario as nick_user"
                                        --}}
                                    @if($item->tipo_comentario == 1) {{--tipo texto--}}
                                        <li>
                                            <i class="fa fa-comments bg-yellow"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> {{ $item->fecha }}</span>
                                                <h3 class="timeline-header"><a href="#">{{ $item->nick_user }}</a> ha comentado</h3>
                                                <div class="timeline-body">
                                                    {{ $item->comentario }}
                                                </div>
                                            </div>
                                        </li>
                                    @elseif($item->tipo_comentario == 2){{--tipo imagen--}}
                                        <li>
                                            <i class="fa fa-camera bg-purple"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> {{ $item->fecha }}</span>
                                                <h3 class="timeline-header"><a href="#">{{ $item->nick_user }}</a> ha comentado con una imagen</h3>
                                                <div class="timeline-body">
                                                    <img src="{{ url("storage/".$item->ruta_storage)}}" alt="..." class="margin">
                                                </div>
                                                <div class="timeline-footer">
                                                    {{ $item->comentario }}
                                                </div>
                                            </div>
                                        </li>
                                    @elseif($item->tipo_comentario == 3){{--tipo video--}}
                                        <li>
                                            <i class="fa fa-video-camera bg-maroon"></i>
                                            <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> {{ $item->fecha }}</span>
                                            <h3 class="timeline-header"><a href="#">{{ $item->nick_user }}</a> ha comentado con un video</h3>
                                            <div class="timeline-body">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe class="embed-responsive-item" src="{{url("storage/".$item->ruta_storage)}}"
                                                        frameborder="0" allowfullscreen></iframe>
                                                </div>
                                            </div>
                                            <div class="timeline-footer">
                                                {{ $item->comentario }}
                                            </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="compose-textarea">Comentar</label>
                        <textarea id="compose-textarea-send" name="comentario-text" class="form-control" style="height: 100px"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="btn btn-default btn-file">
                            <i class="fa fa-paperclip"></i> Adjuntar Archivo
                            <input type="file" name="archivo" id="archivo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <button type="submit" class="btn btn-primary btn-guardar-comentario"><i class="fa fa-envelope-o"></i> Enviar</button>
            </div>
            {{--<button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Borrar Todo</button>--}}
        </div>
    </form>
</div>

<script lang="javascript">
    $(".btn-guardar-comentario").click(function(){
        alert("aedfawr");
        /*var token_ = $('meta[name="csrf-token"]').attr('content');
        var archivo = $("#archivo");
        var comentario = $('#compose-textarea-send').val();
        */
        $('form').submit(function(event){

            event.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "guardar-comentario",
                data: formData,
                type: 'post',
                async: false,
                processData: false,
                contentType: false,
                success:function(data){
                    
                    console.log(data);
                }
            });

        });


        /*var $datos = '&token_='+token_+'&file='+archivo+'&comentario='+comentario;
        $.ajax({ 
            url:"guardar-comentario",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            datatype: "json",
            data: $datos, 
            statusCode: {
                404: function(){
                    swal({type: "error", title: "Página no encontrada"}); 
                }
            },
            beforeSend: function() {
                swal({
                    title: 'Cargando Post...',
                    allowOutsideClick: false,
                    closeOnCancel: false,
                    onOpen: () => {
                        swal.showLoading()
                    }
                });
            },
            error: function(jqXHR,estado,error){
                swal.close();
                swal({type: "error", title: error, allowOutsideClick: false, closeOnCancel: false}); 
            },
            success: function(data){
                //$("#contenido").html(data);
                console.log(data);
                swal.close();
            }
        });*/
    });
</script>