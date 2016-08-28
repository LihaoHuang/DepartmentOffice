<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->    
    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
    
    <!-- bootstrap theme -->
    {{-- <link href="{{URL::asset('css/bootstrap-theme.css')}}" rel="stylesheet"/> --}}

    <!-- font icon -->
    <link href="{{URL::asset('css/elegant-icons-style.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('css/font-awesome.min.css')}}" rel="stylesheet" />

    <!-- Custom styles -->
    <link href="{{URL::asset('css/fullcalendar.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('css/widgets.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('css/style.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('css/style-responsive.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('css/xcharts.min.css')}}" rel=" stylesheet"/> 
    <link href="{{URL::asset('css/jquery-ui-1.10.4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('css/customStyle.css')}}" rel="stylesheet"/>
    
    <!--Button-->
    <link rel="stylesheet"type="text/css" href="{{URL::asset('css/plugins/css3-hover-button-animation/btn1.css')}}" />
    <link rel="stylesheet"type="text/css" href="{{URL::asset('css/plugins/css3-hover-button-animation/normalize.css')}}" />
    <link rel="stylesheet"type="text/css" href="{{URL::asset('css/plugins/css3-hover-button-animation/style.css')}}" />
    
    
    <!--Alertify.css-->
    <link rel="stylesheet" href="{{URL::asset('css/plugins/alertify.core.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('css/plugins/alertify.default.css')}}" />

    <!-- 最新編譯和最佳化的 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"/>

    <!-- 選擇性佈景主題 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css"/>

    <!-- 最新編譯和最佳化的 JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
    <!--Alertify.js-->
    <script type="text/javascript" src="{{URL::asset('/js/plugins/alertfy-0.3.11/alertify.min.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb"
        crossorigin="anonymous"></script>

    <script type="text/javascript" src="{{URL::asset('chart/chart.js/dist/Chart.js')}}"></script>
  </head>