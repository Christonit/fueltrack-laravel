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
                                <b>Account created</b>
                            </h3>
                            <ul class="tabs" data-tabs id="sign-up-tabs">
                                <li class="tabs-title "><b>Your details</b></a>
                                </li>
                                <li class="tabs-title is-active"><b>Your vehicle info</b></a>
                                </li>
                            </ul>
                            <form class="float-center" method="POST" action="/add-vehicle">

                                @csrf

                                <div id="signup-vehicle-info-basic"  class=''>

                                    <h4 class="text-center">Your basic vehicle info</h4>

                                    <label>Maker
                                        <select class="" name="maker">
                                            <option value="BMW">BMW</option>
                                            <option value="MAZDA">Mazda</option>
                                        </select>
                                    </label>

                                    <label>Model
                                        <select class="" name="model">
                                            <option value="M3">M3</option>
                                            <option value="6">6</option>

                                        </select>
                                    </label>

                                    <label>Year
                                        <select class="" name="year">
                                            <option value="2018">2018</option>
                                            <option value="2017">2017</option>
                                        </select>
                                    </label>


                                    <button class="button success" type="submit" >Continue</button>

                                    <div class="expanded button-group ">
                                        <a href="#" class="hollow button previews">Back</a>

                                        <a class="button success" href="#" data-add-vehicle='continue-usage'>Continue</a>
                                    </div>


                                    <hr>

                                    <a href="#" class="hollow button secondary expanded" data-user-info='submit-user-info'>Finish for now & fill vehicle info later</a>

                                </div>

                                <div id="signup-vehicle-info-usage" class="hide">

                                    <h4>One last thing before you go...</h4>
                                    <label>Usage years
                                        <input type="number" name="usageYear" value="">
                                    </label>

                                    <label>Acquisition date
                                        <input type="date" name="AcquisitionDate">
                                    </label>

                                    <label>Acumulated distance - Mileage
                                        <input type="number" name="totalDistance">
                                    </label>



                                    <div class="expanded button-group ">
                                        <a href="#" class="hollow button previews">Back</a>
                                        <a class="button success" href="#" data-add-vehicle='continue-misc'>Continue</a>
                                    </div>

                                </div>

                                <div id="signup-vehicle-info-misc" class="hide">

                                    <h4 class="text-center">Miscellaneous but useful information.</h4>
                                    <label>Fuel type
                                        <select class="" name="">
                                            <option value="Gasoline">Gasoline</option>
                                        </select>
                                    </label>

                                    <label>Prefered distance measurement unit
                                        <select class="" name="">
                                            <option value="KM">Km</option>
                                            <option value="MILES">Miles</option>
                                        </select>
                                    </label>



                                    <a class="button expanded" href="#" data-add-vehicle='submit'>Start voyage</a>

                                    <hr>

                                    <a href="#" class="hollow button secondary expanded" data-add-vehicle='review'>Review before submit</a>

                                </div>

                            </form>


                        </div>

                    </div>
                    <footer class="social-footer small-12 align-bottom">
                        <p>What is Fueltrack? <a href="#">Learn more.</a></p>
                    </footer>
                </div>





            </div>
            <div id="login-billboard" class="small-12 medium-6 full-height billboard-img hide-for-small-only">

            </div>


        </div>


    </div>
    {{----}}
{{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">{{ __('Register') }}</div>--}}

                {{--<div class="card-body">--}}
                    {{--<form method="POST" action="{{ route('register') }}">--}}
                        {{--<!-- @csrf -->--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="username" class="col-md-4 col-form-label text-md-right">{{ __('username') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>--}}

                                {{--@if ($errors->has('username'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('username') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row mb-0">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--{{ __('Register') }}--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
