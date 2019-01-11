<div class="reveal" id="add-expense" data-reveal >
    <h3 class="text-center">Add fuel expense</h3>
    <button class="close-button" aria-label="Close alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <form>
        <div >
            <fieldset class="grid-x">
                <div class="small-3 cell">
                    <label for="middle-label" class="text-left middle">Fuel type</label>
                </div>
                <div class="small-9 cell">
                    <select name="fuelType" id="">
                        <option value="GasolinaPremium">Gasolina Premium</option>
                        <option value="GasolinaRegular">Gasolina Regular</option>
                        <option value="GasNaturl">Gas Natural</option>
                        <option value="GLP">Gas GLP</option>
                    </select>
                </div>
            </fieldset>

            <fieldset class="grid-x">
                <div class="small-12 medium-3 cell">
                    <label for="middle-label" class="text-left middle">Date</label>
                </div>
                <div class="small-12 medium-9 cell">
                    <input type="date" id="middle-label" placeholder="Right- and middle-aligned text input">
                </div>

            </fieldset>


            <fieldset class="grid-x">
                <div class="small-12 medium-3 cell">
                    <label for="middle-label" class="text-left middle">Cost</label>
                </div>
                <div class="small-12 medium-9 cell">
                    <input type="number" id="middle-label" placeholder="Right- and middle-aligned text input">
                </div>
            </fieldset>



            <fieldset class="grid-x">
                <div class="small-12 medium-3 cell">
                    <label for="middle-label" class="text-left middle">Galons</label>
                </div>
                <div class="small-12 medium-2  cell">
                    <input type="number" id="middle-label" placeholder="Right- and middle-aligned text input">
                </div>

                <div class="small-12 medium-2 medium-offset-2 cell">
                    <label for="middle-label" class="text-left middle">Distance</label>
                </div>
                <div class="small-12 medium-3 cell">
                    <input type="number" id="middle-label" placeholder="Right- and middle-aligned text input">
                </div>
            </fieldset>




        </div>
        <div class="expanded button-group ">
            <a href="#" class="hollow button secondary cancel">Cancel</a>
            <a class="button success" href="#">Add</a>
        </div>
    </form>
</div>