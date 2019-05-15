<form name="service-performed">
@csrf
<div class="reveal " id="done-service" data-reveal>

    {{--<input type="hidden" name="_method" value="PATCH">--}}

    <h3 class="text-center">Service performed</h3>


        <input type="hidden" name="maintenance_service" value="">

        <fieldset class="grid-x">

            <div class="small-12 medium-5 cell">
                <label for="middle-label" class="text-left middle">Date performed</label>
            </div>
            <div class="small-12 medium-7 cell">

                <div class="small-12 medium-3  cell">
                    <input type="date" name="date_performed" value=""/>
                </div>

            </div>
        </fieldset>





        <fieldset class="grid-x">
            <div class="small-12 medium-5 cell">
                <label for="middle-label" class="text-left middle">Cost</label>
            </div>
            <div class="small-12 medium-7  cell">
                <input type="number" name="cost"/>
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


    <div class="expanded button-group ">
        <a href="#"  class="hollow button secondary cancel">Cancel</a>
        <a href="#" class="button success" data-open="done-service-details">Next</a>
    </div>

    <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>



</div>



<div class="reveal" id="done-service-details" data-reveal>
    <h3 class="text-center">Service performed</h3>


        {{--For Part change and maintenance--}}

        @include('utilities.components.warranty-input')

        {{--For accesory install--}}

    <fieldset class="grid-x">

        <div class="small-12 medium-5 cell">
            <label for="middle-label" class="text-left middle">Workshop name</label>
        </div>
        <div class="small-12 medium-7  cell">
            <input type="text" name="workshop" value="">
        </div>

    </fieldset>


    <fieldset class="grid-x">





        <div class="small-12 medium-5 cell">
            <label for="middle-label" class="text-left middle">Details</label>
        </div>
        <div class="small-12 medium-7  cell">
            <textarea name="details" rows="3"></textarea>
        </div>

    </fieldset>







    <div class="expanded button-group ">
        <a href="#" class="hollow button secondary cancel" data-open="done-service">Previews</a>

        button

        <a href='#'  data-form-action='continue' data-close aria-label="Close reveal" class="button success" >Continue</a>
    </div>

    <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

</form>
