<template>

    <div class="modal">
        <span class="overlay" @click="closeModal"></span>
        <div class="reveal " id="add-expense" data-reveal>
            <h3 class="text-center">Add fuel expense</h3>
            <button class="close-button" @click="closeModal">
                <span aria-hidden="true" @click="closeModal">&times;</span>
            </button>

            <form name="service-performed">
                <input type="hidden" name="_token" :value="csrf">

                <div class="reveal " id="done-service" data-reveal>

                    <!-- {{--<input type="hidden" name="_method" value="PATCH">--}} -->

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
                        <fieldset id="warranty-options" class="grid-x">

                            <div class="small-12 medium-5 cell">
                                <label for="middle-label" class="text-left">Warranty/Insurance</label>
                            </div>
                            <div class="small-12 medium-7 cell">

                                <input type="radio" name="warranty_insurance" value="1"/><label    for="warranty_insurance">Yes</label>
                                <input type="radio" name="warranty_insurance" value="0"/><label    for="warranty_insurance">No</label>
                            </div>
                        </fieldset>


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
        </div>
    </div>
    


</template>

<script>
import csrf from '../my-car/mixins/laravel-utilities';

export default {
    name: "done-service-form",
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
            let el = document.querySelector('.modal.show');
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