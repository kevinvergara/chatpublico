<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Elegir Post</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <select class="form-control select-post" style="width: 50%">
                        @foreach ($posts as $post)
                            <option value="{{ $post->id_post }}">{{ $post->post }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="pull-right">
            <button type="button" class="btn btn-primary" id="ir_post"><i class="fa fa-envelope-o"></i> Ir A Post</button>
        </div>
    </div>
</div>

<script lang="javascript">
    $(".select-post").select2({
        width: 'resolve' // need to override the changed default
    });

    $("#ir_post").click(function(){
        var $datos = '&id_post='+$(".select-post").val();
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
    });
</script>