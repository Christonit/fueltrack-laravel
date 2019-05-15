
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
