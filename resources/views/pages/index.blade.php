@extends('layouts.master')

@section('title', '蜘人血統控制板')

@section('content')
<style type="text/css">
  .info-box{
    height: 750px;
  }
  p.ex {
    height: 100px;
    width: 100px;
  }
  .centerTitle{
    color:black;
  }
  .h1Padding{
    padding-top: 250px;
  }
</style>
  @if (session('message'))
    <script> alert('{{ session('message') }}') </script>
  @endif
  <!--main content start-->
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="info-box">
            <h1 class="mytitle"><?=$mainTitle?></h1>
            <p class="titleContent">歡迎來到</p>
            <p class="titleContent">資工系辦公室　蜘人血統控制板</p>
        </div>
    </div>
  </div>
  <!--main content end-->
@endsection