@extends('layout')

@section('title')
   Edit Maintenance
@endsection


@section('content')

    <div class="grid-container ">





            <section id="expenses" class="small-12 medium-6 card">

                <!-- Overview chart -->



                <!-- Expenses logs  -->                        <h1 class="text-center">Edit Maintenance</h1>

                <h3 class="text-center">
                  <b>{{ucfirst($maintenance[0]->title)}} </b>
                </h3>

                <form method="POST" name="edit-maintenance" action="/my-maintenance/{{$maintenance[0]->id}}/edit">

                    {{ method_field('PATCH') }}
                    @csrf

                        {{--<input type="hidden" name="_method" value="PATCH">--}}



                        <input type="hidden" name="maintenance_service" value="">

                        <fieldset class="grid-x">

                            <div class="small-12 medium-5 cell">
                                <label for="middle-label" class="text-left middle">Date performed</label>
                            </div>
                            <div class="small-12 medium-7 cell">

                                <div class="small-12 medium-3  cell">
                                    <input type="date" name="date_performed" value="{{$maintenance[0]->date_performed}}"/>
                                </div>

                            </div>
                        </fieldset>





                        <fieldset class="grid-x">
                            <div class="small-12 medium-5 cell">
                                <label for="middle-label" class="text-left middle">Cost</label>
                            </div>
                            <div class="small-12 medium-7  cell">
                                <input type="number" name="cost" value="{{$maintenance[0]->cost}}"/>
                            </div>

                        </fieldset>




                        <fieldset class="grid-x">

                            <div class="small-12 medium-5 cell">
                                <label for="middle-label" class="text-left middle">Service category</label>

                            </div>

                            <div class="small-12 medium-7 cell">
                                <select name="service_category">
                                    <option value="part change">Part change</option>
                                    <option value="accesory install">Accesory install</option>
                                    <option value="maintenance">Maintenance</option>
                                    <option value="miscellaneous">Miscellaneous</option>


                                </select>
                            </div>

                        </fieldset>




                        {{--For Part change and maintenance--}}

                        @include('utilities.components.full-options')

                        {{--For accesory install--}}

                        <fieldset class="grid-x">

                            <div class="small-12 medium-5 cell">
                                <label for="middle-label" class="text-left middle">Workshop name</label>
                            </div>
                            <div class="small-12 medium-7  cell">
                                <input type="text" name="workshop" value="{{$maintenance[0]->workshop}}">
                            </div>

                        </fieldset>




                        <fieldset class="grid-x">





                            <div class="small-12 medium-5 cell">
                                <label for="middle-label" class="text-left middle">Details</label>
                            </div>
                            <div class="small-12 medium-7  cell">
                                <textarea name="details" rows="3">{{$maintenance[0]->details}}</textarea>
                            </div>

                        </fieldset>







                        <div class="expanded button-group ">
                            @auth
                                <?php
                                $user =  Auth()->user()->username;
                                ?>

                                <a href="/{{$user}}/my-car" class="hollow button secondary cancel" data-open="done-service">Cancel</a>

                            @endauth

                            <button type="submit" data-form-action='continue' data-close aria-label="Close reveal" class="button success" >Update</button>
                        </div>

                </form>



            </section>




    </div>





@endsection


@push('scripts')
    <script src="{{asset('js/graph.js')}}"></script>
    <script src="{{asset('js/form-handlers.js')}}"></script>
@endpush

