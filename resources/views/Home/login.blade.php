<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{asset('/images/icon.png') }}">

        <title>Inicio Chat Público</title>

        <!-- Bootstrap core CSS -->
        <link href="{{asset('/css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{asset('/css/index.css') }}" rel="stylesheet" type="text/css">
    </head>

    <body class="text-center">
        <div class="container" id="app">
            <div class="row">
                <div class="col col-form">
                    <form class="form-signin">
                        <img class="mb-4" src="{{asset('/images/icon.png') }}" alt="" width="72" height="72">
                        <h1 class="h3 mb-3 font-weight-normal">Ingrese Nick</h1>
                        <label for="inputEmail" class="sr-only">Email address</label>
                        <input type="text" id="inputnick" class="form-control" placeholder="Nick" required="" autofocus="">
                        <br>
                        <button class="btn btn-lg btn-primary btn-block btn-login" type="button">Entrar</button>
                        <hr><br>
                        <p class="mt-5 mb-3 text-muted">© kevin 2018</p>
                    </form>
                </div>
            </div>
        </div>
    </body>

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
    
        $(document).ready(function(){
            $('.btn-login').click(function(){
                var nick = $("#inputnick").val().replace(" ", "");
                if(nick != ""){
                    var $datos = '&nick='+nick+'&token_='+$('meta[name="csrf-token"]').attr('content');
                    $.ajax({ 
                        url:"login-nick",
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
                                title: 'Entrando ...',
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
                            swal.close();
                            window.location = data;
                        }
                    });
                }else{
                    swal({type: "error", title: "Completar Nick", allowOutsideClick: false, closeOnCancel: false}); 
                }
                
            });
        });
    </script>
</html>