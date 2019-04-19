@if($m_s_performed->count() > 0)
    @foreach($m_s_performed as $performed)
        <tr class="table-expand-row" data-open-details>

            <td>
                <div class="maintenance-logs-resume">
                    <span class="maintenance-category">
                        <i class="service-icon">
                            @switch($performed->maintenance_service)
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
                        </i></span>

                    <span class="maintenance-service">
                            <b>{{ ucwords($performed->maintenance_service) }}</b>

                                @if($performed->due_moment == "Specific distance" )
                            <p>
                                At

                            {{ $performed->overdue_distance + $performed->tracked_distance }}


                            miles   | {{ $performed->date_performed }}
                            </p>
                        @endif
                        </span>

                    <span class="hollow-label-large text-right maintenance-cost">${{$performed->cost}}</span>

                    <div class="maintenance-options-btn "><i class="material-icons">
                            more_vert
                        </i>
                        <span class="button-hover-reveal">
                            <a href="#" class="">Edit</a>
                            <a href="#" >Delete</a>
                        </span>


                    </div>

                </div>
            </td>
        </tr>

        <tr class="table-expand-row-content">
            <td colspan="8" class="table-expand-row-nested">
                <div class="grid-x">

                    <p class="small-6"><b>Tracked miles</b> {{$performed->tracked_distance}}</p>
                    <p class="small-6"><b>Miles overdue</b> {{$performed->overdue_distance}}</p>

                    {{--<p class="small-6"><b>Brand</b> 50,500</p>--}}
                    <p class="small-12"><b>Workshop</b> {{$performed->workshop}}</p>


                    <p class="small-12"><b>Details</b><br> {{$performed->details}}</p>

                </div>

            </td>
        </tr>

    @endforeach

@else
    <tr>
        <td>
            <div class="callout secondary">

                <h4 class="text-center">
                    You dont have performed any service yet.
                </h4>

            </div>
        </td>
    </tr>
@endif
