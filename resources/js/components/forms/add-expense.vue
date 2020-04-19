<template>

    <div class="modal">
        <span class="overlay" @click="closeModal"></span>
        <div class="reveal " id="add-expense" data-reveal>
            <h3 class="text-center">Add fuel expense</h3>
            <button class="close-button" @click="closeModal">
                <span aria-hidden="true">&times;</span>
            </button>
            <form name="add-expense" >
                <input type="hidden" name="_token" :value="csrf">
                <div >
                    <fieldset class="grid-x">
                        <div class="small-3  cell">
                            <label for="middle-label" class="text-left middle">Fuel type</label>
                        </div>
                        <div class="small-9 cell">
                            <select name="FuelType" ref="FuelType" id="">
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
                            <input type="date" id="middle-label" name="Date" ref='date' placeholder="Right- and middle-aligned text input">
                        </div>

                    </fieldset>


                    <fieldset class="grid-x">
                        <div class="small-12 medium-3 cell">
                            <label for="middle-label" class="text-left middle">Budget</label>
                        </div>
                        <div class="small-12 medium-9 cell">
                            <input type="number" id="middle-label" ref='budget' name="budget" placeholder="Right- and middle-aligned text input">
                        </div>
                    </fieldset>

                </div>
                <div class="expanded button-group ">
                    <a href="#" class="hollow button secondary cancel">Cancel</a>
                    <button class="button success" @click="getData" >Add</button>
                </div>
            </form>
        </div>
    </div>
    


</template>

<script>
import csrf from '../my-car/mixins/laravel-utilities';

export default {
    name: "add-expense-form",
    mixins:[csrf],      
    data(){
        return {
            loaded:false,
            error:''
        }
    },
    // props:['csrf'],
    mounted(){
        
    },
    computed:{
    },

    methods:{

        closeModal(e){
            let el = e.target.closest('.modal');
            return el.classList.remove('show');
        },
        getData(e){
               let fuel_type = this.$refs.FuelType.value;
               let budget = this.$refs.budget.value;
               let date = this.$refs.date.value;

               let expense = { 
                FuelType: fuel_type,
                budget: budget,
                Date: date 
               } 

               fetch('/add-expense',{
                   method:'POST',
                   body: JSON.stringify(expense),
                   headers:{
                       'Content-Type': 'application/json',
                       'X-CSRF-TOKEN':this.csrf
                   }
               }).then( res => res.text() )
               .then(response =>  {
                  let res = JSON.parse(response);
                        if(res.Errors){
                            this.error = res.Errors;
                        }else{
                            
                            document.querySelector('.modal.show').classList.remove('show')

                            this.$store.dispatch('expensesHistoric')
                            this.$store.dispatch('expensesResume')
                            this.$store.dispatch('graphExpensesWeekly')


                        }


                   
                   })
               .catch(error => console.error('Error:', error));
            

               e.preventDefault()

        }


    }
}
</script>