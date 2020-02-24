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
        <!-- <expenses-resume></expenses-resume> -->
        <section class="grid-x">

            <performance-sheet id="performance" class=" small-12 medium-3 "></performance-sheet>
            <expenses-resume-graph id="expenses" class="small-12 medium-6" :print-icon="printServiceCategoryIcon"></expenses-resume-graph>
            <user-vehicle-maintenances class="small-12 medium-3" :print-icon="printServiceCategoryIcon"></user-vehicle-maintenances>


        </section>


    </div>




@endsection


@push('scripts')
    <script src="{{asset('js/graph.js')}}"></script>
    <script src="{{asset('js/form-handlers.js')}}"></script>
@endpush

