<div class="scheduled-maintenance-card clearfix">
    <div class="scheduled-maintenance-detail">
        <i class="service-icon scheduled-maintenance-category float-left">
            @switch($maintenances->maintenance_service)
                @case('wheel change')
                &#xe800;
                @break

                @case('alignment')
                &#xe801;
                @break

                @case('battery change')
                &#xe802;
                @break

                @case('body fix')
                &#xe803;
                @break

                @case('brake check')
                &#xe804;
                @break

                @case('cleaning')
                &#xe805;
                @break

                @case('coolant fill')
                &#xe806;
                @break

                @case('electricity check')
                &#xe807;
                @break

                @case('engine check')
                &#xe808;
                @break

                @case('filter change')
                &#xe809;
                @break

                @case('tire change')
                &#xe810;
                @break

                @case('transmission check')
                &#xe811;
                @break

                @case('inmediate check')
                &#xe80a;
                @break

                @case('oil change')
                &#xe80b;
                @break

                @case('paint job')
                &#xe80c;
                @break

                @case('part change')
                &#xe80d;
                @break

                @case('preassure check')
                &#xe80e;
                @break


                @case('scheduled maintenance')
                &#xe80f;
                @break

                @default
                &#xe80f;

            @endswitch
        </i>
        {{--</span>--}}

        <h6 class="scheduled-maintenance-title float-center">
            {{ ucwords($maintenances->maintenance_service)}}
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

                //                                $daysPercentage = 3;
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
