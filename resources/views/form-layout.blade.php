
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

  <head>

      @include('layout.head')


	</head>

  <body>
    <!-- This demo uses float grid but you can use flex grid too -->




         @yield('content')


    @include('layout.scripts')

    @yield('specific-scripts')


</body>
</html>
