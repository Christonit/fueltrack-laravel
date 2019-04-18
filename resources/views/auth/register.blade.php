@extends('form-layout')

@section('title')
    Register new user
@endsection

@section('content')

    <div class="grid-container fluid">


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
                            <form class="float-center" method="POST" action="{{ route('register') }}">

                                @csrf

                                <div id="signup-user-details" class="">


                                    <label>Username
                                        <input id="username" type="text" class="{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                        @endif

                                    </label>
                                    <label>Email
                                        <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </label>

                                    <label>Password
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </label>

                                    <label>Confirm password
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                    </label>

                                    <button type="submit" class="button expanded success">
                                        {{ __('Register') }}
                                    </button>



                                    {{--<a class="button expanded success" href="#">Continue</a>--}}

                                </div>

                            </form>


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
