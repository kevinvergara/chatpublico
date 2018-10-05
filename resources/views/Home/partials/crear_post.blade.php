<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Crear Post</h3>
    </div>
    <form class="form-horizontal file-upload" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="compose-textarea">Creador</label>
                        <input class="form-control" placeholder="Usuario" value="{{ $usuario->nick_usuario }}" disabled>
                    </div>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="compose-textarea">Texto</label>
                        <textarea id="compose-textarea-send-post" name="comentario-text" class="form-control" style="height: 100px" required=""></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <button type="submit" class="btn btn-primary btn-guardar-comentario"><i class="fa fa-envelope-o"></i> Crear</button>
            </div>
            {{--<button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Borrar Todo</button>--}}
        </div>
    </form>
</div>

<script lang="javascript">
    $(".btn-guardar-comentario").click(function(){

        $('form').submit(function(event){

            event.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "crear-post-guardar",
                data: formData,
                type: 'post',
                async: false,
                processData: false,
                contentType: false,
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
                success:function(data){
                    if(data == "error"){
                        swal.close();
                        swal({type: "error", title: "error sesión", allowOutsideClick: false, closeOnCancel: false}); 
                    }else{
                        cargarChat(data);
                        swal.close();
                    }
                }
            });

        });

        function cargarChat(id_post){
            var $datos = '&id_post='+id_post;
            $.ajax({ 
                url:"cargar-chat",
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
                    $("#contenido").html(data);
                    swal.close();
                }
            });
        }
    });
</script>