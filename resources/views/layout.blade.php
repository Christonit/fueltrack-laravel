
<!doctype html>
<html class="no-js" lang="en" dir="ltr">



  <head>




    {{--<!-- <meta charset="utf-8">--}}
    {{--<meta http-equiv="x-ua-compatible" content="ie=edge">--}}
    {{--<meta name="viewport" content="width=device-width, initial-scale=1.0">--}}

    {{--<title> for Sites</title>--}}

    {{--<link rel="stylesheet" href="{{asset('css/foundation.min.css')}} ">--}}
    {{--<link rel="stylesheet" href="{{asset('css/style.css')}}"> -->--}}

      @include('layout.head')

      <meta name="csrf-token" content="{{ csrf_token() }}">


	</head>

  <body>
    <!-- This demo uses float grid but you can use flex grid too -->


    @include('layout.header')


    @auth
      @include('utilities.add-expense')
      @include('utilities.add-service')

    @endauth

    @yield('content')



    @include('layout.footer')

    @auth
      @include('utilities.floating-action-btn')

    @endauth

    @include('layout.scripts')


<!-- Compressed CSS -->



    @yield('specific-scripts')


  </body>
</html>
