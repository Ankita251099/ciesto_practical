<!DOCTYPE html>
<html lang="en">


@include('layouts.head')
@yield('css')

<body>

   
    <div id="preloader"><div class="spinner"><div class="spinner-a"></div><div class="spinner-b"></div></div></div>
    
    <div id="main-wrapper">


        @include('layouts.header')

        @include('layouts.menu')

        <div class="content-body">
   <div class="container-fluid">
            
           @yield('content')
    </div>
        </div>
        @include('layouts.footer')
    
    </div>
   
    @include('layouts.script')
    @yield('script')

</body>

</html>