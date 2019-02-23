    <td>

        <h6 class="dashboard-table-text">{{$latestExpense->Date}}</h6>
        <span class="dashboard-table-timestamp">10:00 PM</span>

        <!-- <div class="flex-container align-justify align-top">

          <div class="flex-child-grow">

          </div>
        </div> -->
    </td>

    <td class='text-center'>
        <h6>
            {{$latestExpense->Galons}}
            Gal
        </h6>
        <span class="dashboard-table-timestamp">256Km Est. Drivable Distance </span>
    </td>
    <td class='text-right'>
        <h6 class="dashboard-table-text">RD$ {{($latestExpense->Galons * $latestExpense->Current_fuel_price)}}</h6>
        <span class="dashboard-table-timestamp">{{$latestExpense->Current_fuel_price}} Oil Price</span>
    </td>


