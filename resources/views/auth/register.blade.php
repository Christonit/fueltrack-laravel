@extends('form-layout')

@section('title')
    Register new user
@endsection

@section('content')

    <div id="app" class="grid-container fluid">


        <!-- Overview section header -->
        <div class="grid-x grid-padding-x  grid-frame">

            <div id="login-form"  class="small-12 medium-6 ">

                @include('layout.form-header')

                <div class="grid-x">
                    <div class="small-10 medium-8 small-offset-1 medium-offset-2">



                        <p  class="text-center">
                        </p>

                        <div id="form-container" class="">
                            <h3 class="text-center">
                                <b>Create your account</b>
                            </h3>
                            <ul class="tabs" data-tabs id="sign-up-tabs">
                                <li class="tabs-title is-active"><b>Your details</b></a>
                                </li>
                                <li class="tabs-title"><b>Your vehicle info</b></a>
                                </li>
                            </ul>

                            <register-users-form action="{{ route('register') }}">
                                <template #csrf>
                                    @csrf
                                </template>



                            </register-users-form>


                        </div>

                    </div>
                    
                </div>


                <footer class="social-footer align-bottom">
                    <p>What is Fueltrack? <a href="#">Learn more.</a></p>

                </footer>





            </div>
            <div id="login-billboard" class="small-12 medium-6 full-height billboard-img hide-for-small-only">

            </div>


        </div>


    </div>

@endsection
