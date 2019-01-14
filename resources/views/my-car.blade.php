@extends('layout')

@section('title')
  My car
@endsection


@section('content')

    <div class="grid-container fluid">

        <!-- Overview section header -->
        <div id="section-header" class="grid-x grid-padding-x">
            <div class="small-12 medium-7 cell">

                <h3> {{$user_vehicle[0]->maker}} {{$user_vehicle[0]->model}} {{$user_vehicle[0]->year}}  </h3>

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

        <div id='expenses-resume' class="grid-x card">

            <div class="small-12 medium-12">
                <ul class="stats-list">
                    <li><span class="stats-list-label"><b>This week</b> 15-23 Oct</span>
                        <span class="stat">RD$ 9,999</span> <i class="material-icons">
                            arrow_upward
                        </i> 20%
                    </li>
                    <li class="stats-list-positive">
                        <span class="stats-list-label"><b>Monthly expense  </b></span>
                        <span class="stat">RD$ 89,000</span>
                    </li>
                    <li class="stats-list-negative">
                        <span class="stats-list-label"><b>Tracked this week</b></span>
                        <span class="stat">890</span> kms
                    </li>

                    <li class="stats-list-negative">
                        <span class="stats-list-label"><b>Total Distance Tracked</b></span>
                        <span class="stat">89,000</span> kms
                    </li>

                    <li class="stats-list-negative">
                        <span class="stats-list-label"><b>Maintenance cost</b></span>
                        <span class="stat">RD$ 289,000</span> Yearly
                    </li>

                    <li class="stats-list-negative">
                        <span class="stats-list-label"><b>Total fuel ups</b></span>
                        <span class="stat">89</span> this month
                    </li>


                </ul>


            </div>

        </div>

        <section class="grid-x">
            <section id="performance" class=" small-12 medium-3 ">

                <div id="performance" class="card">

                    <h5 >Performance</h5>

                    <div class="performance-section">

                        <div class="performance-stat">

                            <i class="ft-icon i-performance icon-highway">&#xe902;</i>

                            <p class="performance-category-title float-center">Highway</p>

                            <p class="hollow-label float-right">999 Km</p>

                        </div>

                        <div class="performance-stat">

                            <i class="ft-icon i-performance icon-city">&#xe907;</i>

                            <p class="performance-category-title float-center">City</p>

                            <p class="hollow-label float-right">999 Km</p>

                        </div>

                        <div class="performance-stat">

                            <i class="ft-icon i-performance icon-average">&#xe905;</i>

                            <p class="performance-category-title float-center">Average C/H</p>

                            <p class="hollow-label float-right">999 Km</p>



                        </div>

                        <div class="performance-stat">

                            <i class="ft-icon i-performance icon-tank">&#xe908;</i>

                            <p class="performance-category-title float-center">Tank size</p>

                            <p class="hollow-label float-right">999 Km</p>



                        </div>


                        <div class="performance-stat">

                            <i class="ft-icon i-performance icon-distance">&#xe906;</i>

                            <p class="performance-category-title float-center">Drivable distance</p>

                            <p class="hollow-label float-right">999 Km</p>



                        </div>

                        <div class="performance-stat">

                            <i class="ft-icon i-performance icon-cost">&#xe900;</i>

                            <p class="performance-category-title float-center">Cost to fill up</p>

                            <p class="hollow-label float-right">9,999 Km</p>



                        </div>






                    </div>



                </div>
                <div class="share-info card">

                    <h6 class='text-center'>Share with pals</h6>

                    <div class="rounded-social-buttons">
                        <a class="social-button facebook" href="#"></a>
                        <a class="social-button twitter" href="#"></a>
                        <a class="social-button" href="#"> <i class="material-icons">attachment </i> </a>
                        <a class="social-button" href="#"> <i class="material-icons">email </i> </a>

                    </div>



                </div>





            </section>








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
                                <button class="button is-active">Daily</button>
                                <button class="button">Weekly</button>
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

                <div class="small-12 medium-12" id="expenses-logs">

                    <ul class="tabs" data-deep-link="true" data-update-history="true" data-deep-link-smudge="true" data-deep-link-smudge-delay="500" data-tabs id="deeplinked-tabs">
                        <li class="tabs-title is-active"><a href="#fuel-expenses-logs" aria-selected="true">Fuel ups</a></li>
                        <li class="tabs-title"><a href="#maintenance-logs">Services</a></li>
                    </ul>

                    <div class="tabs-content" data-tabs-content="deeplinked-tabs">

                        <div class="tabs-panel is-active" id="fuel-expenses-logs">
                            <table class="dashboard-table">

                                <colgroup>


                                </colgroup>

                                <thead>
                                <tr>
                                    <th class='text-left'><a href="#">Date <i class="fa fa-caret-down"></i></a></th>
                                    <th class='text-center'><a href="#">Quantity <i class="fa fa-caret-down"></i></a></th>
                                    <th class='text-right'><a href="#">Cost <i class="fa fa-caret-down"></i></a></th>

                                </tr>
                                </thead>

                                <tr>
                                    <td>

                                        <h6 class="dashboard-table-text">July 25, 18</h6>
                                        <span class="dashboard-table-timestamp">10:00 PM</span>

                                        <!-- <div class="flex-container align-justify align-top">

                                          <div class="flex-child-grow">

                                          </div>
                                        </div> -->
                                    </td>

                                    <td class='text-center'>
                                        <h6>
                                            9.6 Gal
                                        </h6>
                                        <span class="dashboard-table-timestamp">256Km Est. Drivable Distance </span>
                                    </td>
                                    <td class='text-right'>
                                        <h6 class="dashboard-table-text">RD$ 7000</h6>
                                        <span class="dashboard-table-timestamp">246.7 Oil Price</span>
                                    </td>

                                </tr>

                                </tbody>
                            </table>



                        </div>

                        <div class="tabs-panel" id="maintenance-logs">
                            <table class="table-expand">

                                <tbody>
                                <tr class="table-expand-row" data-open-details>
                                    <td class="maintenance-logs-resume">
                                        <table id="maintenance-logs-resume">
                                            <tr>
                                                <td><i class="material-icons">attachment </i></td>
                                                <td><p><b>Engine check</b></p>At 50,000 miles   |  July 25, 18</td>
                                                <td class="text-right"><span class="hollow-label-large">RD$ 7000</span></td>
                                                <td class="hide-for-small-only">
                                                    <a href="#" class=" button  hollow-label-large flex-middle secondary"><i class="material-icons">attachment </i> <span>Details</span></a>
                                                </td>
                                                <td><i class="material-icons">
                                                        more_vert
                                                    </i></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr class="table-expand-row-content">
                                    <td colspan="8" class="table-expand-row-nested">
                                        <div class="grid-x">

                                            <p class="small-6"><b>Tracked miles</b> 50,500</p>
                                            <p class="small-6"><b>Miles overdue</b> 500</p>

                                            <p class="small-6"><b>Brand</b> 50,500</p>
                                            <p class="small-6"><b>Workshop</b> 500</p>


                                            <p class="small-12"><b>Details</b><br> ipsum dolor sit amet, consectetur adipisicing elit. Eaque unde quaerat reprehenderit ipsa ipsam, adipisci facere repellendus impedit at, quisquam dicta optio veniam quia nesciunt, inventore quod in neque magni?</p>

                                        </div>

                                    </td>
                                </tr>



                                </tbody>
                            </table>



                        </div>

                    </div>


                </div>


            </section>


            <section id="maintenance" class="small-12 medium-3">

                <div id='maintenance-resume' class="card no-m-bottom">

                    <div class="clearfix">
                        <h5 class="float-left">Maintenances</h5>
                        <button class="hollow  button float-right alternative" data-open="add-service">+ Add service</button>
                    </div>
                    <span id='maintenance-resume-total' class="text-center">


                <span class="stat">89,000</span>

                <br>

                <span class="stats-list-label">
                  Total expenses
                </span>

              </span>


                    <canvas id="maintenance-chart" height="60vh" width="80vw">

                    </canvas>


                </div>

                <div id="scheduled-maintenance" class="card no-m-top">
                    <div class="scheduled-maintenance-card clearfix">
                        <div class="scheduled-maintenance-detail">
              <span class="scheduled-maintenance-category float-left">
                X
              </span>

                            <h6 class="scheduled-maintenance-title float-center">
                                Scheduled Maintenance
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

                        </div>


                        <div class="status-progress">
                  <span class="status-current">
                    <b>Current</b><br>
                    Date
                  </span>
                            <span class="status-current">
                    <b>Tracked</b><br>
                    Date
                  </span>

                            <progress max="100" value="75"></progress>
                        </div>
                    </div>
                </div>
            </section>
        </section>



    </div>





@endsection
