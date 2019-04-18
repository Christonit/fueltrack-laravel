@extends('form-layout')

@section('title')
    Login to account
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
                                <b><span class="highlight">Welcome,</span> sign in to
                                    your account</b>
                            </h3>

                            <p class="text-center">Don't have an account? <a href="{{ route('register') }}" class="highlight">Create one.</a></p>



                            <form class="float-center" method="POST" action="{{ route('login') }}">

                                @csrf

                                <div id="signup-user-details" class="">

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

                                        <label>
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <span class="highlight" for="remember">
                                                {{ __('Remember Me') }}
                                            </span>
                                        </label>

                                    </label>





                                </div>


                                <div >






                                </div>

                                <div class=" grid-x grid-padding-x">
                                    <div class="cell small-12 flex-container flex-dir-column button-group-container">
                                        <div class="flex-child-auto">
                                            <button type="submit" class="button expanded success ">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                        <div class=" flex-child-shrink">
                                            @if (Route::has('password.request'))
                                                <button class="button expanded hollow secondary" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </button>
                                            @endif
                                        </div>
                                    </div>

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
