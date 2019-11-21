<!DOCTYPE html>
<html>
<head>
    @include('includes.album.head')
</head>
<body>

    @include('includes.album.section.loader')

    <div id="all">
        
        @include('includes.github-corner')

        @yield('menu')
        
        @yield('header')

        @yield('content')

        @yield('contact')

        @include('includes.album.footer')

    </div>
</body>
</html>