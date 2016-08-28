@include('layouts.partials.header')
<style>
    body {
        background-color: #cff09e;
    }
</style>
<body>
    <div id="wrapper">
        <!-- container section start -->
        <section id="container">
        @include('layouts.partials.nevbar')
            <section id="main-content">
                <section class="wrapper">
                    <div style="min-height:750px;">
                        <h1 class="mytitle">@yield('pagename')</h1>
                        @yield('content')
                    </div>
                    @include('layouts.partials.modalForm')  
                </section>
            @include('layouts.partials.footer')
            </section>
        </section>
    </div>
    <!-- container section start -->
</body>

</html>