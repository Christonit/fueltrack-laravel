<template>

    <div class="modal">
        <span class="overlay" @click="closeModal"></span>
        <div class="reveal " id="add-expense" data-reveal>
            <h3 class="text-center">Add fuel expense</h3>
            <button class="close-button" @click="closeModal">
                <span aria-hidden="true">&times;</span>
            </button>
            <form name="add-expense">
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
                    <a class="button success" href="#">Add</a>
                </div>
            </form>
        </div>
    </div>
    


</template>

<script>
export default {
    name: "add-expense-form",           
    data(){
        return {
            loaded:false
        }
    },
    mounted(){
        
    },
    computed:{
    },

    methods:{

        closeModal(e){
            let el = e.target.closest('.modal');
            return el.classList.remove('show');
        }
    }
}
</script>