<header class="top-bar grid-x">
  
  <div class="cell small-4 medium-2">
    <a id='logo' href="/"><img src="/images/logo.svg"/></a>

    <a href="#"class="show-for-small-only" data-responsive-toggle="main-menu" data-hide-for="medium">
      <i class="material-icons" data-toggle="main-menu">menu</i>
    </a>


  </div>




  <div id="main-menu" class=" top-bar-left">

     <ul class="dropdown menu" data-dropdown-menu>
       <li class="menu-text"></li>

         <li>
             <a href="/browse">Browse </a>
         </li>

         @if (Route::has('login'))
             @auth
                 <?php
                 $user =  Auth()->user()->username;
                  ?>

                 <li><a href="/{{$user}}/my-car" class="active">My vehicle</a></li>

             @endauth
         @endif


       <li>

       </li>
     </ul>

 </div>


<div class=" top-bar-right {{Auth::check() ? 'is-signed-in' : ''}}">

  <ul class=" menu" data-misc>

    <li >
      <a href="#" class="hollow button secondary flex-middle">
        <i class="ft-icon i-alt i-pencil">&#xe904;</i>
        <span class='hide-for-small-only'>Share tip</span>
      </a>
    </li>

    <li >
      <a href="#" class="hollow button secondary flex-middle fuelprices-btn">
        <i class="ft-icon i-alt i-pump">&#xe901;</i>
        <span class='hide-for-small-only'>Fuel prices </span>
      </a>
    </li>

      @if (Route::has('login'))
              @auth
              <li><button 
              data-type-action='add-expense'   
              class="button alternative hide-for-small-only"
              @click='showAddExpenseModal'>+ Add expense</button></li>
              <!-- <li><button data-type-action='add-expense'  data-open= "add-expense" class="button alternative hide-for-small-only">+ Add expense</button></li> -->

              @else

                  <li><a href="{{ route('login') }}" data-type-action='login' class="button">Log In</a></li>


                  @if (Route::has('register'))

                      <li><a href="{{ route('register') }}" data-type-action='signup' class="button">Sign Up</a></li>

                  @endif
              @endauth
      @endif

      @guest
      @else
          <li><a href="#"><i class="ft-icon i-alt i-notif">&#xe903;</i></a></li>

      @endguest




  </ul>
</div>

    @guest
             @else

                  <div id='user-settings-dropdown' class="">

                      <ul class=" dropdown menu nav-user-settings" data-dropdown-menu data-user-settings='menu'>

                          <li>
                              <a id='account-settings-nav' href="#">
                                  <img src="https://via.placeholder.com/42x42" alt="">
                              </a>

                              <ul class="menu">
                                  <li>
                                      <a class="dropdown-item" href="/add-vehicle">
                                         Add new vehicle
                                      </a>
                                      <a class="dropdown-item" href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                          {{ __('Logout') }}
                                      </a>

                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                          @csrf
                                      </form>
                                  </li>


                              </ul>


                          </li>

                      </ul>
                  </div>


      @endguest


   </header>

<add-expense-form ref='addExpenseModal'></add-expense-form>