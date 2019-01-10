@extends('layout')

@section('title')
  My car
@endsection


@section('content')


<div class="grid-container fluid">

  <section id='main-container' class="">




  <div id='landing-header' class="grid-x grid-padding-x">
    <div class="large-12 cell">
      <h2 class="text-center"><b>Manage & track  </b> <br> any expenses
about your vehicle</h2>
    </div>


      <form action="" class="medium-8 large-7 float-center">
          <div id='vehicle-search' class="grid-x grid-padding-x">
              <div class="large-3 medium-3 cell">
                  <label>Maker</label>

                  <select name="maker" id="">

                  </select>
              </div>
              <div class="large-3 medium-3 cell">
                  <label>Model</label>
                  <select name="model" id="">
                  </select>

              </div>
              <div class="large-3 medium-3 cell">
                  <label>Year</label>
                  <select name="year" id="">

                  </select>
              </div>
              <div class="large-3 medium-3 cell">
                  <label>&#160;</label>

                  <button type="button" class="button expanded alternative flex-middle">
                      <span>Search </span>
                      <i class="material-icons">search</i>
                  </button>

              </div>
          </div>
      </form>


</div>

<div class='grid-x align-bottom'>
  <div id='hero-image' class="medium-6 float-center"></div>
</div>

</section>

</div>

@endsection
