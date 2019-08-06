<div id='expenses-resume' class="grid-x card">

    <div class="small-12 medium-12">
        {{--@foreach($averages as $average)--}}

        <ul class="stats-list">


            <li><span class="stats-list-label"><b>This week</b> {{ end($weekly_expenses['weeks'])  }}</span>
                <span class="stat">$ {{$vehicle_averages['current_week'] }}</span>

                <span>
                            <i class="material-icons">
                                {{ ($vehicle_averages['increase_decrease_percentage'] < 0) ? "arrow_downward":"arrow_upward" }}
                            </i>
                            {{round(abs($vehicle_averages['increase_decrease_percentage'])) }}%
                        </span>
            </li>

            <li class="stats-list-positive">
                <span class="stats-list-label"><b>Last week</b></span>
                <span class="stat">${{$vehicle_averages['last_week'] }}</span>
            </li>
            <li class="stats-list-positive">
                <span class="stats-list-label"><b>Last Month expenses</b></span>
                <span class="stat">${{$vehicle_averages['last_month'] }}</span>
            </li>
            <li class="stats-list-negative">
                <span class="stats-list-label"><b>Tracked this week</b></span>
                <span class="stat">{{$vehicle_averages['tracked_current_week']}}</span> miles
            </li>

            <li class="stats-list-negative">
                <span class="stats-list-label"><b>Total Distance Tracked</b></span>
                <span class="stat">{{round($vehicle_averages['total_distance']) }}</span> miles
            </li>

            <li class="stats-list-negative">
                <span class="stats-list-label"><b>Fuel Ups</b></span>
                <span class="stat">{{$vehicle_averages['fuelups_current_month'] }}</span> this month

            </li>

            <li class="stats-list-negative">
                <span class="stats-list-label"><b>Fuel Ups Last Month</b></span>
                <span class="stat">{{ $vehicle_averages['fuelups_last_month']}}</span>
            </li>


            <li class="stats-list-negative">
                <span class="stats-list-label"><b>Total Fuel Ups</b></span>
                <span class="stat">{{ $vehicle_averages['fuelups_current_year']}} </span>this year
            </li>

            <li class="stats-list-negative">
                <span class="stats-list-label"><b>Maintenance cost</b></span>
                <span class="stat">$ {{$vehicle_averages['total_maintenance_expenses']}}</span> Yearly
            </li>

        </ul>

        {{--@endforeach--}}


    </div>

</div>