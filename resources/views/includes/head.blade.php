<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="chat publico prueba tecnica">
    <meta name="author" content="kevinvergara">
    <title>Chat Público</title>
    {{--ESTILOS--}}
    <link href="{{asset('/css/app.css') }}" rel="stylesheet" type="text/css">
    {{--FIN ESTILOS--}}
    @yield('css-en-vista')
</head>
<div id="app"></div>
