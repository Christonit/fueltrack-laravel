@extends('layout')

@section('title')
  My car
@endsection


@section('content')


    <div id='app' class="grid-container fluid">

        <section id='main-container' class="">
            <div id='landing-header' class="grid-x grid-padding-x margin-bottom-5">
                <div class="large-12 cell">
                    <h2 class="text-center"><b>Manage & track  </b> <br> any expenses
                        about your vehicle</h2>
                </div>


                <form   action="" class="medium-8 large-8 small-12 float-center">
                    <div id='vehicle-search' class="grid-x">
                        <div class="large-3 medium-3 cell">
                            <label>Year</label>
                            <select ref='selectedYear' name="year" id="" class="border-radius-clear br-top-left-sm br-bottom-left-sm" @click.once="years = getYears()" @change="makers = getMakers()">
                                <option v-for='year in years' :value="year">@{{ year }}</option>
                            </select>
                        </div>
                        <div class="large-3 medium-3 cell">
                            <label>Maker</label>

                            <select   ref='selectedMaker' name="maker" class="border-radius-clear" class="border-horizontal-clear-sm" @change="selectMaker" id="">
                                <option v-for='maker in makers' :value="maker">@{{ maker }}</option>
                            </select>
                        </div>
                        <div class="large-3 medium-3 cell">
                            <label>Model</label>
                            <select ref='selectedModel' name="model" class="border-radius-clear" id="">
                                <option v-for='model in models' :value="model">@{{ model }}</option>
                            </select>

                        </div>

                        <div class="large-3 medium-3 cell">
                            <label>&#160;</label>

                            <button type="button" class="button expanded alternative flex-middle border-radius-clear br-top-right-sm br-bottom-right-sm" @click="getVehicleStats">
                                <span>Search </span>
                                <i class="material-icons">search</i>
                            </button>

                        </div>
                    </div>
                </form>





            </div>

            <div  class='grid-x align-bottom'>
                <div  class='small-12 medium-8 large-8 float-center'>
                    <stats-table v-if=" hasVehicle " :has-vehicle="hasVehicle" :vehicle="vehicle"></stats-table>

                    <div v-if='!vehicle'  id='hero-image' class="medium-6 float-center"></div>

                </div>



        </section>

    </div>

@endsection

@section('specific-scripts')
    {{--<script src="{{asset('js/fuelgov.js')}}"></script>--}}
@endsection

