<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>SISTEMA DE PUNTO DE VENTA Y FACTURACIÓN ELECTRÓNICA</title>
  @include('layouts.script_cabecera')
  @yield('script_cabecera')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  
  @include('layouts.top')

  @include('layouts.menu')
  
  @yield('content')

  @include('layouts.pie')
</div>

@include('layouts.script_pie')
@yield('script_pie')


</body>
</html>
