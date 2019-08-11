@extends('form-layout')

@section('title')
    Register new user
@endsection

@section('content')

    <div id='app' class="grid-container fluid">


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

                            <add-vehicle-form :current-year="currentYear" :select-maker="selectMaker">
                                <template #csrf>
                                    @csrf
                                </template>
                            </add-vehicle-form>





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
    {{--<script src="{{asset('js/fuelgov.js')}}"></script>--}}

    {{--<script>--}}

        {{--let vehicleBTN = document.querySelectorAll('a[data-add-vehicle]');--}}

        {{--vehicleBTN[0].addEventListener('click', (e) =>{--}}
            {{--vehicleValidation();--}}
            {{--console.log(e)--}}
        {{--});--}}

        {{--vehicleBTN[1].addEventListener('click', (e) =>{--}}
            {{--vehicleUsageValidation(e);--}}
        {{--});--}}

        {{--previewBtn.addEventListener('click', (e) => {--}}

            {{--vehicleInfoMisc.classList.add('hide');--}}
            {{--vehicleInfoBasic.classList.remove('hide');--}}

        {{--});--}}

        {{--backBTN1.onclick = previewsTab;--}}
        {{--backBTN2.onclick = previewsTab;--}}
        {{--//--}}
        {{--let submitBtn = document.querySelector("a[data-add-vehicle='continue-usage']");--}}
        {{--//--}}
        {{--let city_mpg = $('input[name="City_MPG"]');--}}
        {{--let avg_mpg = $('input[name="Avg_MPG"]');--}}
        {{--let highway_mpg =  $(' input[name="Highway_MPG"]');--}}

        {{--submitBtn.addEventListener('click',()=>{--}}
           {{--let vehicle =  document.querySelector('form[name="vehicle-stats"]');--}}

            {{--let vehicleMPG = [];--}}

            {{--new Promise((resolve, reject) =>{--}}
                {{--vehicleMPG.push(browseVehicles.getVehicleStats());--}}

                {{--let x  = setInterval( () =>{--}}


                    {{--if (vehicleMPG[0].length == 3 ){--}}

                        {{--clearInterval(x);--}}


                        {{--resolve();--}}



                    {{--}--}}

                {{--},100);--}}





            {{--}).then(()=>{--}}

                {{--city_mpg.attr('value', vehicleMPG[0][0] );--}}
                {{--avg_mpg.attr('value', vehicleMPG[0][1] );--}}
                {{--highway_mpg.attr('value', vehicleMPG[0][2] );--}}

                {{--return--}}


            {{--});--}}


        {{--});--}}


    {{--</script>--}}
@endsection
