@extends('layout')

@section('title')
    My car
@endsection


@section('content')

    <div class="grid-container fluid">


        <!-- Overview section header -->
        <div id="section-header" class="grid-x grid-padding-x">
            <div class="small-12 medium-7 cell">

                <? $user_id = auth()->id() ?>

                <h3> {{ $vehicle->first()->maker }} {{ $vehicle->first()->model }} {{ $vehicle->first()->year }} </h3>

            </div>

            <div class="small-12 medium-5 cell clearfix">


                <div class="button-group float-right">

                    <label class="input-group-label float-right">
                        <span>Distance unit</span>

                        <select class="">
                            <option value="km">Km</option>
                            <option value="miles">Miles</option>
                        </select>

                    </label>

                    <a href="#" class="button hollow">Compare period</a>

                    <a href="#" class="button hollow flex-middle">
                        <i class="material-icons">
                            insert_drive_file
                        </i>
                        <span>Report</span>
                    </a>


                </div>






            </div>


        </div>

        @include('my-car.resume')

        <section class="grid-x">
            <section id="performance" class=" small-12 medium-3 ">

                <div id="performance" class="card">

                    <h5 >Performance</h5>

                    @foreach($vehicle_p as $performance)

                        <div class="performance-section">

                            <div class="performance-stat">

                                <i class="ft-icon i-performance icon-highway">&#xe902;</i>

                                <p class="performance-category-title float-center">Highway</p>

                                <p class="hollow-label float-right">{{round($performance->Highway_MPG,1)}} mpg</p>

                            </div>

                            <div class="performance-stat">

                                <i class="ft-icon i-performance icon-city">&#xe907;</i>

                                <p class="performance-category-title float-center">City</p>

                                <p class="hollow-label float-right">{{ round($performance->City_MPG,1)}} mpg</p>

                            </div>

                            <div class="performance-stat">

                                <i class="ft-icon i-performance icon-average">&#xe905;</i>

                                <p class="performance-category-title float-center">Average C/H</p>

                                <p class="hollow-label float-right">{{round($performance->Avg_MPG,1)}} mpg</p>



                            </div>

                            <div class="performance-stat">

                                <i class="ft-icon i-performance icon-tank">&#xe908;</i>

                                <p class="performance-category-title float-center">Tank size</p>

                                <p class="hollow-label float-right">999 Km</p>



                            </div>


                            <div class="performance-stat">

                                <i class="ft-icon i-performance icon-distance">&#xe906;</i>

                                <p class="performance-category-title float-center">Drivable distance</p>

                                <p class="hollow-label float-right">999 Km</p>



                            </div>

                            <div class="performance-stat">

                                <i class="ft-icon i-performance icon-cost">&#xe900;</i>

                                <p class="performance-category-title float-center">Cost to fill up</p>

                                <p class="hollow-label float-right">9,999 Km</p>



                            </div>






                        </div>


                    @endforeach



                </div>
                <div class="share-info card">

                    <h6 class='text-center'>Share with pals</h6>

                    <div class="rounded-social-buttons">
                        <a class="social-button facebook" href="#"></a>
                        <a class="social-button twitter" href="#"></a>
                        <a class="social-button" href="#"> <i class="material-icons">attachment </i> </a>
                        <a class="social-button" href="#"> <i class="material-icons">email </i> </a>

                    </div>



                </div>





            </section>








            <section id="expenses" class="small-12 medium-6">

                <!-- Overview chart -->
                <div id="overview-graph" class="card clearfix">
                    <label class="input-group-label float-right" data-expense-filter='cost-analysis'>
                        <span>Cost analysis</span>
                        <select class="">
                            <option value="volvo">Last 30 days</option>
                            <option value="saab">Last 3 months</option>
                            <option value="mercedes">Last 6 months</option>
                        </select>
                    </label>

                    <canvas id="bar-chart"></canvas>

                    <div id='graph-filter' class="grid-x">
                        <div class="mobile-app-toggle small-12 medium-7" data-mobile-app-toggle data-expense-filter='date-format'>
                            <label class="input-group-label float-right">
                                <span>Date format</span>
                                <button class="button">Daily</button>
                                <button class="button is-active">Weekly</button>
                                <button class="button">Monthly</button>
                            </label>
                        </div>



                        <div class="small-12 medium-5" data-expense-filter='show-by'>
                            <label class="input-group-label float-right">
                                <span>Show by </span>
                                <select class="">
                                    <option value="volvo">Expenses</option>
                                    <option value="saab">Fuel ups</option>
                                    <option value="mercedes">Trip distance</option>
                                </select>
                            </label>
                        </div>

                    </div>

                </div>


                <!-- Expenses logs  -->

                <div class="small-12 medium-12" id="expenses-logs">

                    <ul class="tabs" data-deep-link="true" data-update-history="true" data-deep-link-smudge="true" data-deep-link-smudge-delay="500" data-tabs id="deeplinked-tabs">
                        <li class="tabs-title is-active"><a href="#fuel-expenses-logs" aria-selected="true">Fuel ups</a></li>
                        <li class="tabs-title"><a href="#maintenance-logs">Services</a></li>
                    </ul>

                    <div class="tabs-content" data-tabs-content="deeplinked-tabs">




                        @include('vehicle.expenses-history')



                        <div class="tabs-panel" id="maintenance-logs">
                            <table class="table-expand">

                                <tbody>

                                @include('vehicle.maintenances-history')









                                </tbody>
                            </table>



                        </div>

                    </div>


                </div>


            </section>


            @include('vehicle.maintenances')

        </section>


    </div>





@endsection


@push('scripts')
    <script src="{{asset('js/graph.js')}}"></script>
    <script src="{{asset('js/form-handlers.js')}}"></script>
@endpush

