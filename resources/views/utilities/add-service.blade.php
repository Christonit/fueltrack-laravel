<!-- This is the first modal -->
<div class="reveal " id="add-service-1" data-reveal>
    <h3 class="text-center">Add service</h3>

    <fieldset class="grid-x">

        <div class="small-12 medium-3 cell">
            <label for="middle-label" class="text-left middle">Title</label>
        </div>

        <div class="small-12 medium-9 cell">
            <input type="text" id="middle-label" placeholder="Right- and middle-aligned text input">
        </div>

    </fieldset>

    <fieldset class="grid-x">

        <div class="small-12 medium-3 cell">
            <label for="middle-label" class="text-left middle">Category</label>

        </div>

        <div class="small-12 medium-9 cell">
            <select name="Category" id="">
                <option value="Part change">Part change</option>
                <option value="Scheduled maintenance">Scheduled maintenance</option>
                <option value="Quick fix">Quick fix</option>
            </select>
        </div>

    </fieldset>

    <fieldset class="grid-x">

        <div class="small-12 medium-12">
            <legend>Due moment</legend>
            <input type="radio" name="pokemon" value="Red" id="pokemonRed" required><label for="pokemonRed">Specific distance</label>
            <input type="radio" name="pokemon" value="Blue" id="pokemonBlue"><label for="pokemonBlue">Inmediate</label>
            <input type="radio" name="pokemon" value="Yellow" id="pokemonYellow"><label for="pokemonYellow">Date</label>
        </div>

    </fieldset>

    <fieldset class="grid-x">

        <div class="small-12 medium-4 cell">
            <label for="middle-label" class="text-left middle">Tracked distance</label>
        </div>

        <div class="small-12 medium-8 cell">
            <input type="number" id="middle-label" placeholder="Right- and middle-aligned text input">
        </div>

    </fieldset>

    <div class="expanded button-group ">
        <a href="#" class="hollow button secondary cancel">Cancel</a>
        <a class="button success" href="#">Add</a>
    </div>

    <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>

</div>