<!-- This is the first modal -->
@extends('layout')

@section('title')
   Testing a form
@endsection


@section('content')
    <div>
        <h3 class="text-center">Add fuel expense</h3>
        <button class="close-button" data-close aria-label="Close modal">
            <span aria-hidden="true">&times;</span>
        </button>
        <form name="add-expense" method="post" action="test">
            @csrf
            <div >
                <fieldset class="grid-x">
                    <div class="small-3 cell">
                        <label for="middle-label" class="text-left middle">Fuel type</label>
                    </div>
                    <div class="small-9 cell">
                        <select name="FuelType" id="">
                            <option value="Gasolina Premium">Premium gasoline</option>
                            <option value="Gasolina Regular">Regular gasoline</option>
                            <option value="Gas Natural">Natural gas</option>
                            <option value="GLP">LPG</option>
                        </select>
                    </div>
                </fieldset>

                <fieldset class="grid-x">
                    <div class="small-12 medium-3 cell">
                        <label for="middle-label" class="text-left middle">Date</label>
                    </div>
                    <div class="small-12 medium-9 cell">
                        <input type="date" id="middle-label" name="Date" placeholder="Right- and middle-aligned text input">
                    </div>

                </fieldset>


                <fieldset class="grid-x">
                    <div class="small-12 medium-3 cell">
                        <label for="middle-label" class="text-left middle">Budget</label>
                    </div>
                    <div class="small-12 medium-9 cell">
                        <input type="number" id="middle-label" name="budget" placeholder="Right- and middle-aligned text input">
                    </div>
                </fieldset>


            </div>
            <div class="expanded button-group ">
                <a href="#" class="hollow button secondary cancel">Cancel</a>
                <button type="submit" class="button success">Add</button>
            </div>
        </form>
    </div>


@endsection


@push('scripts')
    <script src="{{asset('js/graph.js')}}"></script>
    <script src="{{asset('js/form-handlers.js')}}"></script>
@endpush

