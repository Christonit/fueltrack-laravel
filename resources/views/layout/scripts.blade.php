<script src="https://code.jquery.com/jquery-latest.min.js" ></script>
<script src="{{asset('js/vendor/what-input.js')}}"></script>

<script src="https://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script src="{{asset( 'js/c3.min.js' )}}"></script>

<script>
    @if (Route::has('login'))
            @auth
                var isUserSignedIn = true;


            @else

                var isUserSignedIn = false;

            @endauth
    @endif


</script>
<script src="{{asset('js/app.js')}}" ></script>

