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

                <div class="scheduled-maintenance-card clearfix">
                    <div class="scheduled-maintenance-detail">
			  <span class="scheduled-maintenance-category float-left">
				X
			  </span>

                        <h6 class="scheduled-maintenance-title float-center">
                            {{$maintenances->maintenance_service}}
                        </h6>


                        <ul class="dropdown menu more-options float-right" data-dropdown-menu>
                            <li>
                                <a href="#">
                                    <i class="material-icons">
                                        more_vert
                                    </i>
                                </a>
                                <ul class="menu">
                                    <li><a href="#">Item 1A</a></li>
                                    <!-- ... -->
                                </ul>

                            </li>

                        </ul>

                        @if($maintenances->due_moment == 'Inmediate' || $maintenances->due_moment == 'Specific distance' && $maintenances->current_distance > $maintenances->tracked_distance || $maintenances->due_moment == 'Specific date' &&  date("Y-m-d") > $maintenances->final_date )

                            <span data-maintenance-id='{{$maintenances->id}}' class="faux-checkbox" data-open="done-service">
                                     <span class="dot"></span>
                            </span>

                        @endif


                    </div>
                    <div class="status-progress">

                        @if($maintenances->due_moment == 'Specific distance')

                            <span class="status-current">
												<b>Current</b><br>

                                            @if($maintenances->current_distance > $maintenances->tracked_distance )



                                    {{($maintenances->current_distance - $maintenances->tracked_distance)."miles overdue" }}


                                @else


                                    {{$maintenances->current_distance}}


                                @endif

										</span>



                            <span class="status-current text-right">
											<b>Tracked</b><br>
                                {{$maintenances->tracked_distance}}
									  </span>

                            <progress max="100" value="{{ ( ($maintenances->current_distance / $maintenances->tracked_distance)*100 ) }}"></progress>


                        @elseif($maintenances->due_moment == 'Specific date')



                            <span class="status-current">

										<?php
                                $fDate = date_create($maintenances->final_date);

                                $cDate = date_create( date("Y-m-d") );

                                $createdDate = date_create(  $maintenances->created_at  );

                                $totalDaysToWait = date_diff($createdDate,$fDate)->format("%a");

                                //Total days to maintenance since created maintenance
                                $maintenance_date = date_diff($cDate,$fDate)->format("%R%a");

                                $daysPercentage = round((($totalDaysToWait - $maintenance_date)/$totalDaysToWait)*100);

                                ?>

                                @if($maintenance_date > 0)

                                    <b>Days left</b><br>

                                    <?= substr($maintenance_date,1);?>

                                @endif

                                @if($maintenance_date < 0)

                                    <b></b><br>

                                    <?= substr($maintenance_date,1)." days overdue"?>

                                @endif
									  </span>

                            <span class="status-current text-right">
											<b>Target date</b><br>
                                {{$maintenances->final_date}}
									  </span>

                            <progress max="100" value="<?= ($daysPercentage < 100 ? $daysPercentage : '100') ?>"></progress>


                        @elseif($maintenances->due_moment == 'Inmediate')
                            <span class="status-current">
                                              <b>Urgency</b><br>
                                                Inmediate
									  </span>
                            <span class="status-current text-right"></span>
                            <progress max="100" value="100"></progress>
                        @endif
                    </div>

                </div>
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
