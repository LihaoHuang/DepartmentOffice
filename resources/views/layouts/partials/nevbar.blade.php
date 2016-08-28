<header class="header dark-bg">
    <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
    </div>

    <!--logo start-->
    <a href="/" class="logo">資工系辦 <span class="lite">蜘人血統控制板</span></a>
    <!--logo end-->

    <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">

            <!-- alert notification end-->
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="username">
                            <i class="fa fa-user" aria-hidden="true"></i> {{substr(Auth::user()->email,0,8)}}<i class="caret"></i>
                    </span>
                </a>
                <form id="logout" action="{{route('log.out')}}" class="dropdown-menu extended logout" method="post">
                    <div class="log-arrow-up"></div>
                    <li class="eborder-top">
                        {{csrf_field()}}
                        <a href="#" onclick="document.getElementById('logout').submit();"><i class="icon_lock-open"> 登出</i></a>
                    </li>
                </form>
            </li>
            <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
    </div>
    
    {{-- 關閉頁面時，留下登出紀錄 --}}
    <script>
        window.onbeforeunload = function(){
            documnet.getElementById('logout').submit();
        }
    </script>
</header>
<!--header end-->

<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
            <li class="active">
                <a class="">
                    <i class="icon_house_alt"></i>
                    <span>資工系辦</span>
                </a>
            </li>
            @can('show', Auth::user()) 
            {{-- dropMenu --}}
            <li>
                <a class="" href="{{route('apply')}}">
                    <i class="icon_documents_alt" aria-hidden="true"></i>
                    <span>失物招領</span>
                </a>
            </li>
            @can('member', Auth::user())
            @else
            <li>
                <a class="" href="{{route('manager')}}">
                    <i class="icon_group" aria-hidden="true"></i>
                    <span>人員管理 </span>
                </a>
            </li>        
            <li>
                <a class="" href="{{route('log')}}">
                    <i class=" icon_pencil-edit" aria-hidden="true"></i>
                    <span>Log</span>
                </a>
            </li>
            @endcan
        </ul>
        @endcan
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
