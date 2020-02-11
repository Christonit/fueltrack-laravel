@extends('layout')

@section('title')
    My car
@endsection


@section('content')

    <div class="grid-container fluid">

       
        <!-- Overview section header -->
        <div id="section-header" class="grid-x grid-padding-x">
            <div class="small-12 medium-7 cell">

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
        <expenses-resume></expenses-resume>
        <section class="grid-x">

            <performance-sheet id="performance" class=" small-12 medium-3 "></performance-sheet>

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

                <expenses-logs class="small-12 medium-12" id="expenses-logs"></expenses-logs>

            </section>


            @include('vehicle.maintenances')

        </section>


    </div>





@endsection


@push('scripts')
    <script src="{{asset('js/graph.js')}}"></script>
    <script src="{{asset('js/form-handlers.js')}}"></script>
@endpush

