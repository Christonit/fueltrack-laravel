@extends('layout')

@section('title')
   Edit Maintenance
@endsection


@section('content')

    <div class="grid-container ">





            <section id="expenses" class="small-12 medium-6 card">

                <!-- Overview chart -->



                <!-- Expenses logs  -->                        <h1 class="text-center">Delete Maintenance</h1>

                <h3 class="text-center">
                  <b>{{ucfirst($maintenance[0]->title)}} </b>
                </h3>

                <form method="POST" name="edit-maintenance" action="/my-maintenance/{{$maintenance[0]->id}}/delete">

                    @method('DELETE')
                    @csrf

                        <p>Are you sure you want to delete this project.</p>


                        <div class="expanded button-group ">
                            @auth
                                <?php
                                $user =  Auth()->user()->username;
                                ?>

                                <a href="/{{$user}}/my-car" class="hollow button secondary cancel" data-open="done-service">Cancel</a>

                            @endauth

                            <button type="submit" data-form-action='continue' data-close aria-label="Close reveal" class="button success" >Delete</button>
                        </div>

                </form>



            </section>




    </div>





@endsection


@push('scripts')
    <script src="{{asset('js/graph.js')}}"></script>
    <script src="{{asset('js/form-handlers.js')}}"></script>
@endpush

