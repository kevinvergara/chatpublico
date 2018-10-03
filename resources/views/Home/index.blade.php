<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="{{asset('/images/icon.png') }}">

        <title>Inicio Chat Público</title>

        <!-- Bootstrap core CSS -->
        <link href="{{asset('/css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{asset('/css/index.css') }}" rel="stylesheet" type="text/css">
    </head>

    <body class="text-center">
        <div class="container">
            <div class="row">
                <div class="col col-form">
                    <form class="form-signin">
                        <img class="mb-4" src="{{asset('/images/icon.png') }}" alt="" width="72" height="72">
                        <h1 class="h3 mb-3 font-weight-normal">Ingrese Nick</h1>
                        <label for="inputEmail" class="sr-only">Email address</label>
                        <input type="text" id="inputnick" class="form-control" placeholder="Nick" required="" autofocus="">
                        <br>
                        <button class="btn btn-lg btn-primary btn-block btn-login" type="button">Entrar</button>
                        
                        <p class="mt-5 mb-3 text-muted">© kevin 2018</p>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Completar Nick</h4>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <footer>
        <script type="text/javascript">
        
            $(document).ready(function() {
                $(".btn-login").on('click',(function(e){
        
                    var nick = $("#inputnick").val();
                    alert(nick);
                    var $datos = '&nick='+nick;
                    $.ajax({         
                        url:"clasificacion-ajax/busqueda-filtros-contratos",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: "POST",
                        datatype:"json",
                        data:$datos,          
                        statusCode: {
                            404: function(){
                                
                            }
                        },
                        beforeSend: function() {
                            
                        },
                        error: function(jqXHR,estado,error){
                                      
                        },
                        success: function(data){
                            
                        }
                    });
                }));
            });
                
                
        </script>
    </footer>
</html>