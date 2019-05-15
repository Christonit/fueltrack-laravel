<script src="https://code.jquery.com/jquery-latest.min.js" ></script>

<script src="https://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/randomcolor/0.5.4/randomColor.min.js"></script>
<script src="{{asset('js/vendor/what-input.js')}}"></script>
<script src="{{asset( 'js/c3.min.js' )}}"></script>

<script>
        @if (Route::has('login'))

        @auth


    let isUserSignedIn = true;



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

                            return response.text();

                        }).then(data =>{

                        return $('#fuel-expenses-logs tbody').prepend(data);

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

        let due_moment_btn = $('input[name="due_moment"]');
        let add_expense_btn = $('button[data-open="add-service"]');
        let tracked_distance_details = $('#tracked-distance-details');
        let due_date_details =  $('#due-date-details');

        let dueMomentCheck = (x)=>{
            switch(x){
                case'Specific distance':
                    tracked_distance_details.addClass('show').removeClass('hide');

                    due_date_details.is('.show') ? due_date_details.addClass('hide').removeClass('show') : '';

                    break;

                case'Specific date':

                    due_date_details.removeClass('hide').addClass('show');

                    tracked_distance_details.is('.show') ? tracked_distance_details.addClass('hide').removeClass('show') : '';

                    break;

                case'Inmediate':


                    if(tracked_distance_details.is('.show') || due_date_details.is('.show')){
                        due_date_details.removeClass('show').addClass('hide');
                        tracked_distance_details.removeClass('show').addClass('hide');
                    }

                    break;


            }
        }


        add_expense_btn.on('click',dueMomentCheck($('input[name="due_moment"]:checked').val()) );
        due_moment_btn.on('click',(e)=>{

            dueMomentCheck(e.target.value );

        });





            @else

        let isUserSignedIn = false;

    @endauth


    // $('.fuelprices-btn').click( ()=>{
    //
    //     fetch('/latest-expense')
    //         .then(response =>{
    //
    //             return response.text();
    //
    //         }).then(data =>{
    //
    //         return $('#fuel-expenses-logs tbody').prepend(data);
    //
    //     }).catch(function(error){
    //         console.log(error);
    //
    //     });
    //
    // });



</script>
@endif





<script src="{{asset('js/app.js')}}" ></script>




@stack('scripts')
