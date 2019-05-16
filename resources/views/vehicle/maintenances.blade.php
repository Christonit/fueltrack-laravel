<section id="maintenance" class="small-12 medium-3">

    <div id='maintenance-resume' class="card no-m-bottom">

        <div class="clearfix">
            <h5 class="float-left">Maintenances</h5>
            <button class="hollow  button float-right alternative" data-open="add-service">Add service</button>
        </div>

        @if($total_m_s_expenses !== 0)

            <span id='maintenance-resume-total' class="text-center">


				<span class="stat">{{ number_format($total_m_s_expenses) }}</span>

				<br>

				<span class="stats-list-label">
				  Total expenses
				</span>

			  </span>


            <canvas id="maintenance-chart" height="75vh" width="85vw">

            </canvas>


        @else

            <div class="callout secondary">

                <h4 class="text-center">
                    Currently there are no maintenances expenses.
                </h4>

            </div>




        @endif




    </div>

    <div id="scheduled-maintenance" class="card no-m-top">

        @if(count($maintenance) > 0)
            @foreach($maintenance as $maintenances)

                @include('vehicle.maintenance-template')

            @endforeach

        @else

            <div class="scheduled-maintenance-card clearfix">
                <div class="scheduled-maintenance-detail callout secondary">

                    <h4 class="text-center">
                        Currently there are no maintenances pending.
                    </h4>

                </div>

            </div>

        @endif

    </div>
</section>


@auth
    @include('utilities.done-service')

@endauth
