<script src="https://code.jquery.com/jquery-latest.min.js" ></script>

<script src="https://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script
<script src="{{asset('js/vendor/what-input.js')}}"></script>
<script src="{{asset( 'js/c3.min.js' )}}"></script>

<script>
    @if (Route::has('login'))
            @auth
                var isUserSignedIn = true;



                document.querySelector('form[name="add-expense"] a.success').addEventListener('click',function () {

                    // console.log('envio exitoso');

                    fetch('/add-expense', {
                        method: 'post',
                        // mode: 'no-cors',
                        body: new FormData(document.querySelector('form[name="add-expense"]'))

                    }).then(function(response){
                        if(response.ok){

                            console.log('envio exitoso');

                            return

                        }
                        else {
                            throw "Error en la llamada Ajax";
                        }
                    }).catch(function(error){
                        console.log(error);

                    });




                });




            @else

                var isUserSignedIn = false;

            @endauth



</script>
    @endif


<script src="{{asset('js/app.js')}}" ></script>

