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


    <fieldset class="grid-x">
        {{--For Part change and maintenance--}}
        <div class="small-12 medium-5 cell">
            <label for="middle-label" class="text-left middle">Warranty/Insurance</label>
        </div>
        <div class="small-12 medium-7 cell">

                <input type="radio" name="warranty_insurance" class='middle' value="1"/><label  class='middle'  for="warranty_insurance">Yes</label>
                <input type="radio" name="warranty_insurance" class='middle' value="0"/><label class='middle'   for="warranty_insurance">No</label>

        </div>

        {{--For accesory install--}}
        {{--<div class="small-12 medium-5 cell">--}}
            {{--<label for="middle-label" class="text-left middle">Self service</label>--}}
        {{--</div>--}}
        {{--<div class="small-12 medium-7 cell">--}}

                {{--<input type="radio" name="warranty_insurance" value="true"><label for="warranty_insurance">Yes</label>--}}
                {{--<input type="radio" name="warranty_insurance" value="false"><label for="warranty_insurance">No</label>--}}

        {{--</div>--}}

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
        <a href='#'  data-form-action='continue' class="button success" >Continue</a>
    </div>

    <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

</form>
