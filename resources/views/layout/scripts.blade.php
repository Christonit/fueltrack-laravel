<script src="https://code.jquery.com/jquery-latest.min.js" ></script>

<script src="https://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/randomcolor/0.5.4/randomColor.min.js"></script>
<script src="{{asset('js/vendor/what-input.js')}}"></script>
<script src="{{asset( 'js/c3.min.js' )}}"></script>

<script>
    @if (Route::has('login'))
            @auth
                var isUserSignedIn = true;



                document.querySelector('form[name="add-expense"] a.success').addEventListener('click',function (e) {

                    fetch('/add-expense', {
                        method: 'post',
                        // mode: 'no-cors',
                        body: new FormData(document.querySelector('form[name="add-expense"]'))

                    }).then(function(response){
                        if(response.ok){

                            console.log('envio exitoso');

                            return $('#add-expense').foundation('close');

                        }
                        else {
                            throw "Error en la llamada Ajax";
                        }
                    }).then(function () {
                        if(filename.includes('my-car')){


                            //Ajaxy addes the latest record from database

                            fetch('/latest-expense')
                                .then(response =>{

                                    // console.log(response);

                                    return response.text();

                                }).then(data =>{



                                let ExpenseLogBody =  document.querySelector('#fuel-expenses-logs tbody');


                                let ExpenselogFirstC = ExpenseLogBody.firstChild.nextSibling;

                                let child = document.createElement('tr');

                                ExpenseLogBody.insertBefore(child, ExpenselogFirstC);

                                ExpenselogFirstC.innerHTML = data;

                                return;


                            }).catch(function(error){
                                console.log(error);

                            });
                        }

                        return;
                    }).catch(function(error){

                        console.log(error);

                    });

                    e.preventDefault();

                });


                document.querySelector('form[name="add-service"] a.success').addEventListener('click',function (e) {

                    fetch('/add-service', {
                        method: 'post',
                        // mode: 'no-cors',
                        body: new FormData(document.querySelector('form[name="add-service"]'))

                    }).then(function(response){
                        if(response.ok){

                            console.log('envio exitoso');

                            return $('#add-service').foundation('close');

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




@stack('scripts')

{{--@if(url()->current()->is('*/my-car/'))--}}

    {{----}}


{{--@endif--}}
