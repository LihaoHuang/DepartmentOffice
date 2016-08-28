@include('layouts.partials.header')
<style>
    body {
        background-color: #cff09e;
    }
    .jumbotron {
        background-color: #cff09e;
        text-align: center;
        margin-top: 5%;
    }
</style>
<body>
    <div id="wrapper">
        <!-- container section start -->
        <section id="container">
        @include('layouts.partials.lognevbar')

                <section class="wrapper">
                    <div style="min-height:700px;">
                        <h1 class="mytitle">@yield('pagename')</h1>
                        @yield('content')
                    {{-- </div>  --}}
                </section>
            @if (!Auth::guest())
            @include('layouts.partials.footer')
            @endif
        </section>
        @if (Auth::guest())
        @include('layouts.partials.footer')
        @endif
    </div>
    <!-- container section start -->
</body>

</html>