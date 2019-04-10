<div class="tabs-panel is-active" id="fuel-expenses-logs">
    <table class="dashboard-table">

        <colgroup>


        </colgroup>



        @if($expenses->count() !== 0)

            <thead>

            <tr>
                <th class='text-left'><a href="#">Date <i class="fa fa-caret-down"></i></a></th>
                <th class='text-center'><a href="#">Quantity <i class="fa fa-caret-down"></i></a></th>
                <th class='text-right'><a href="#">Cost <i class="fa fa-caret-down"></i></a></th>

            </tr>
            </thead>

            <tbody>


            @foreach($expenses as $expense)


                <tr>
                    <td>

                        <h6 class="dashboard-table-text">{{$expense->Date}}</h6>
                        <span class="dashboard-table-timestamp">10:00 PM</span>

                        <!-- <div class="flex-container align-justify align-top">

                          <div class="flex-child-grow">

                          </div>
                        </div> -->
                    </td>

                    <td class='text-center'>
                        <h6>
                            {{$expense->Galons}}
                            Gal
                        </h6>

                        @foreach($vehicle_p as $performance)

                            <span class="dashboard-table-timestamp">{{($expense->Galons * $performance->Avg_MPG ) }}Km Est. Drivable Distance </span>

                        @endforeach

                    </td>

                    <td class='text-right'>
                        <h6 class="dashboard-table-text">RD$ {{($expense->Galons * $expense->Current_fuel_price)}}</h6>
                        <span class="dashboard-table-timestamp">RD$ {{$expense->Current_fuel_price}} Fuel Price</span>
                    </td>

                </tr>

            @endforeach

            </tbody>

        @else

            <tr>
                <td colspan="3">
                    <div class="callout secondary">

                        <h4 class="text-center">
                            You have no fuel expenses to show.
                        </h4>

                    </div>
                </td>
            </tr>
        @endif
    </table>



</div>
