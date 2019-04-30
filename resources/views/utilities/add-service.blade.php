<!-- This is the first modal -->
<div class="reveal " id="add-service" data-reveal>
    <h3 class="text-center">Add service</h3>

    <form action="" name="add-service">

        @csrf

    <fieldset class="grid-x">

        <div class="small-12 medium-3 cell">
            <label for="middle-label" class="text-left middle">Service</label>

        </div>

        <div class="small-12 medium-9 cell">
            <select name="maintenance_service" id="">
                <option value="wheel change">Wheel change</option>
                <option value="body fix">Body fix</option>
                <option value="brake check">Brake check</option>
                <option value="alignment">Alignment</option>
                <option value="battery change">Battery change</option>
                <option value="cleaning">Cleaning</option>
                <option value="coolant fill">Coolant fill</option>
                <option value="electricity check">Electricity check</option>
                <option value="engine check">Engine check</option>
                <option value="filter change">Filter change</option>
                <option value="tire change">Tire change</option>
                <option value="transmission check">Transmission check</option>
                <option value="urgent check">Urgent check</option>
                <option value="part change">Part change</option>
                <option value="oil change">Oil change</option>
                <option value="paint job">Paint job</option>
                <option value="preassure check">Preassure check</option>
                <option value="scheduled maintenance">Scheduled maintenance</option>
            </select>
        </div>

    </fieldset>

    <fieldset class="grid-x">

        <div class="small-12 medium-12">
            <legend>Due moment</legend>
            <input type="radio" name="due_moment" value="Specific distance" checked><label for="Specific distance">Specific distance</label>
            <input type="radio" name="due_moment" value="Inmediate" ><label for="Inmediate">Inmediate</label>
            <input type="radio" name="due_moment" value="Specific date" ><label for="Specific date">Date</label>
        </div>

    </fieldset>

        <fieldset id="tracked-distance-details" class="grid-x show">

            <div class="small-12 medium-4 cell">
                <label for="middle-label" class="text-left middle">Tracked distance</label>
            </div>

            <div class="small-12 medium-8 cell">
                <input type="number" id="middle-label" name="tracked_distance" placeholder="Right- and middle-aligned text input">
            </div>

        </fieldset>

        <fieldset id="due-date-details" class="grid-x hide">

            <div class="small-12 medium-4 cell">
                <label for="middle-label" class="text-left middle">Tracked date</label>
            </div>

            <div class="small-12 medium-8 cell">
                <input type="date" id="middle-label" name="final_date" placeholder="Right- and middle-aligned text input">
            </div>

        </fieldset>

    <div class="expanded button-group ">
        <a href="#" class="hollow button secondary cancel">Cancel</a>
        <a class="button success" href="#">Add</a>
    </div>

    <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>

    </form>


</div>
