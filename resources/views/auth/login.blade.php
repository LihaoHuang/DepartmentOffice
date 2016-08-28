@extends('layouts.logmaster')

@section('title','蜘人血統 登入')

@section('content')

<div class="jumbotron">
    <div class="container">
        <div class="row">
            <h1>歡迎進入系學會 蜘人血統控制板</h1>
            <div class="col-md-8 col-md-offset-2">
                    <div class="modal-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-md-4 control-label">使用者帳號 : </label>

                                <div class="col-md-6">
                                    <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}" placeholder="例如 : 40123456">

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">密碼 : </label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="請輸入AD密碼">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i> 登入
                                    </button>
                            </div>

                            <div class="form-group">
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- 
                <div class="col-md-6 col-md-offset-4">
                    <p style="text-align:center">
                        <div class="wrap">
                            <a type="butt" class="btn-slide2">
                                //<i class="fa fa-btn fa-sign-in"></i> Google 
                                <span class="circle2">
                                    <i class="fa fa-sign-in"></i>
                                </span>
                                <span class="title2">登入</span>
                                <span class="title-hover2">進入本系統</span>
                            </a>
                        </div>
                    </p>
                </div>
             --}}
            {{-- @if(session()->has('errMail'))
            <script>
                alertify.set({
                    'delay' : 2000,
                    'labels': {
                        ok        : "重新登入",
                        cancel    : "取消"
                    },
                    'buttonFocus' : "ok"
                });  
                alertify.confirm('{{session('errMail')}}',function(ok){ 
                    if(ok){     
                        alertify.success("即將回到Google登入頁面...");
                        window.location.href = "https://accounts.google.com/logout";
                    }else {
                        alertify.error('已確認取消登入'); 
                    }   
                });
            </script>
            @elseif(session()->has('logout'))
            <script>
                alertify.set({
                    'delay' : 2000,
                    'labels': {
                        ok      : "登出Google",
                    }
                });
                alertify.log("{{session('logout')}}"); 
                alertify.alert('點選按鈕以登出帳號',function(){
                    window.location.href = "https://accounts.google.com/logout";
                });
            </script>
            @endif --}}
        </div>
    </div>
</div>
@endsection
