@extends('form-layout')

@section('title')
    Register new user
@endsection

@section('content')

    <div class="grid-container fluid">


        <!-- Overview section header -->
        <div class="grid-x grid-padding-x  grid-frame">

            <div id="login-form"  class="small-12 medium-6 ">

                @include('layout.form-header')

                <div class="grid-x">
                    <div class="small-10 medium-8 small-offset-1 medium-offset-2">



                        <p  class="text-center">
                        </p>

                        <div id="form-container" class="">
                            <h3 class="text-center">
                                <b>Account created</b>
                            </h3>
                            <ul class="tabs" data-tabs id="sign-up-tabs">
                                <li class="tabs-title "><b>Your details</b></a>
                                </li>
                                <li class="tabs-title is-active"><b>Your vehicle info</b></a>
                                </li>
                            </ul>
                            <form id="add-vehicle" class="float-center" method="POST" action="/add-vehicle">

                                @csrf

                                <div id="signup-vehicle-info-basic"  class=''>

                                    <h4 class="text-center">Your basic vehicle info</h4>

                                    <label>Maker
                                        <select class="" name="maker">

                                        </select>
                                    </label>

                                    <label>Model
                                        <select class="" name="model">


                                        </select>
                                    </label>

                                    <label>Year
                                        <select class="" name="year">

                                        </select>
                                    </label>


                                    {{--<button class="button success" type="submit" >Continue</button>--}}

                                    <div class="expanded button-group ">
                                        <a href="#" class="hollow button previews">Back</a>

                                        <a class="button success" href="#" data-add-vehicle='continue-usage'>Continue</a>
                                    </div>


                                    <hr>

                                    <a href="#" class="hollow button secondary expanded" data-user-info='submit-user-info'>Finish for now & fill vehicle info later</a>

                                </div>

                                <div id="signup-vehicle-info-usage" class="hide">

                                    <h4 class="text-center">One last thing before you go...</h4>
                                    <label>Usage years
                                        <input type="number" name="usage_years" value="">
                                    </label>

                                    <label>Acquisition date
                                        <input type="date" name="acquisition_date">
                                    </label>

                                    <label>Acumulated distance - Mileage
                                        <input type="number" name="init_miles">
                                    </label>



                                    <div class="expanded button-group ">
                                        <a href="#" class="hollow button previews">Back</a>
                                        <a class="button success" href="#" data-add-vehicle='continue-misc'>Continue</a>
                                    </div>

                                </div>

                                <div id="signup-vehicle-info-misc" class="hide">

                                    <h4 class="text-center">Miscellaneous but useful information.</h4>
                                    <label>Fuel type
                                        <select class="" name="fueltype">
                                            <option value="Gasoline">Gasoline</option>
                                            <option value="LPG">LPG - Liquefied petroleum gas</option>

                                        </select>
                                    </label>

                                    <label>Prefered distance measurement unit
                                        <select class="" name="meassurement_unit">
                                            <option value="KM">Km</option>
                                            <option value="MILES">Miles</option>
                                        </select>
                                    </label>


                                        <input type="hidden" name="Avg_MPG" value="">
                                        <input type="hidden" name="City_MPG" value="">

                                        <input type="hidden" name="Highway_MPG" value="">



                                    <button class="button expanded" type="submit" data-add-vehicle='submit'>Start voyage</button>

                                    <hr>

                                    <a href="#" class="hollow button secondary expanded" data-add-vehicle='review'>Review before submit</a>

                                </div>

                            </form>




                        </div>

                    </div>
                    <footer class="social-footer small-12 align-bottom">
                        <p>What is Fueltrack? <a href="#">Learn more.</a></p>
                    </footer>
                </div>





            </div>
            <div id="login-billboard" class="small-12 medium-6 full-height billboard-img hide-for-small-only">

            </div>


        </div>


    </div>



@endsection



@section('specific-scripts')
    <script src="{{asset('js/fuelgov.js')}}"></script>

    <script>

        let vehicleBTN = document.querySelectorAll('a[data-add-vehicle]');

        vehicleBTN[0].addEventListener('click', (e) =>{
            vehicleValidation();
            console.log(e)
        });

        vehicleBTN[1].addEventListener('click', (e) =>{
            vehicleUsageValidation(e);
        });

        previewBtn.addEventListener('click', (e) => {

            vehicleInfoMisc.classList.add('hide');
            vehicleInfoBasic.classList.remove('hide');

        });

        backBTN1.onclick = previewsTab;
        backBTN2.onclick = previewsTab;
        //
        let submitBtn = document.querySelector("a[data-add-vehicle='continue-usage']");
        //
        let city_mpg = $('input[name="City_MPG"]');
        let avg_mpg = $('input[name="Avg_MPG"]');
        let highway_mpg =  $(' input[name="Highway_MPG"]');

        submitBtn.addEventListener('click',()=>{
           let vehicle =  document.querySelector('form[name="vehicle-stats"]');

            // let performance = browseVehicles.getVehicleStats();

            let vehicleMPG = [];

            new Promise((resolve, reject) =>{
                vehicleMPG.push(browseVehicles.getVehicleStats());

                let x  = setInterval( () =>{
                    // console.log(browseVehicles.getVehicleStats());
                    // console.log(hola[0][1]);


                    if (vehicleMPG[0].length == 3 ){



                        clearInterval(x);


                        console.log('1:' + vehicleMPG[0][0] + ', 2: '+ vehicleMPG[0][1] +', 3: '+ vehicleMPG[0][2]);


                        resolve();



                    }

                },100);





            }).then(()=>{


                console.log(city_mpg);
                city_mpg.attr('value', vehicleMPG[0][0] );
                avg_mpg.attr('value', vehicleMPG[0][1] );
                highway_mpg.attr('value', vehicleMPG[0][2] );

                return


            });

            // .then( ()=>{
            //     fetch('/add-vehicle/performance', {
            //         method: 'post',
            //         // mode: 'no-cors',
            //         body: new FormData(vehicle)
            //
            //     }).then(function(response){
            //         if(response.ok){
            //             console.log('envio exitoso');
            //
            //             return
            //
            //         }
            //         else {
            //             throw "Error en la llamada Ajax";
            //         }
            //     }).catch(function(error){
            //         console.log(error);
            //
            //     });
            // });

        });


    </script>
@endsection
