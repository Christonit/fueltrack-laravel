<template>

    <div class="modal">
        <span class="overlay" @click="closeModal"></span>
        <!-- This is the first modal -->
        <div class="reveal " id="add-service" data-reveal>
            <h3 class="text-center">Add service</h3>

            <form name="add-service">

                <input type="hidden" name="_token" :value="csrf">

                <fieldset class="grid-x">

                    <div class="small-12 medium-3 cell">
                        <label for="middle-label" class="text-left middle">Service</label>

                    </div>

                    <div class="small-12 medium-9 cell">
                        <select name="maintenance_service" id="" v-model="maintenance_service">
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
                        <input type="radio" name="due_moment" value="Specific distance" checked v-model="due_moment"><label for="Specific distance">Specific distance</label>
                        <input type="radio" name="due_moment" value="Inmediate" v-model="due_moment"><label for="Inmediate">Inmediate</label>
                        <input type="radio" name="due_moment" value="Specific date" v-model="due_moment"><label for="Specific date">Date</label>
                    </div>

                </fieldset>

                <fieldset id="tracked-distance-details" class="grid-x "
                 v-if="due_moment == 'Specific distance'">

                    <div class="small-12 medium-4 cell">
                        <label for="middle-label" class="text-left middle">Tracked distance</label>
                    </div>

                    <div class="small-12 medium-8 cell">
                        <input type="number" id="middle-label" name="tracked_distance" placeholder="Right- and middle-aligned text input"
                        v-model="tracked_distance">
                    </div>

                </fieldset>

                <fieldset id="due-date-details" class="grid-x " 
                v-if="due_moment == 'Specific date'">

                    <div class="small-12 medium-4 cell">
                        <label for="middle-label" class="text-left middle">Tracked date</label>
                    </div>

                    <div class="small-12 medium-8 cell">
                        <input type="date" id="middle-label" name="final_date" placeholder="Right- and middle-aligned text input"
                        v-model="tracked_date">
                    </div>

                </fieldset>

            <div class="expanded button-group ">
                <a href="#" class="hollow button secondary cancel" @click="closeModal">Cancel</a>
                <a class="button success" href="#" @click="getData">Add</a>
            </div>

            <button class="close-button" data-close aria-label="Close reveal" type="button" @click="closeModal">
                <span aria-hidden="true">&times;</span>
            </button>

            </form>


        </div>

    </div>
    


</template>

<script>
import csrf from '../my-car/mixins/laravel-utilities';
import modals from '../my-car/mixins/modals';

export default {
    name: "add-service-form",           
    data(){
        return {
            loaded:false,
            error:null,
            due_moment:'Specific distance',
            maintenance_service:'',
            tracked_distance:null,
            tracked_date:null
        }
    },
    mixins:[csrf,modals],
    mounted(){
        
    },
    computed:{
    },

    methods:{

        getData(e){
               
               

               if(this.maintenance_service == '' && this.maintenance_service.length < 5){
                   return this.error = {maintenance_service: 'Please select a valid  maintenance service.'}
               }

               if(this.due_moment == 'Specific distance'){

                    this.tracked_date = null

               }else if(this.due_moment == 'Specific date'){

                    this.tracked_distance = null;

                    if( this.tracked_date == null || this.tracked_date.length > 0 || (new Date(this.tracked_date) == 'Invalid Date') ){

                        return this.error = {tracked_date:'Please input a valid date.'};

                    }

               }else if(this.due_moment == 'Inmediate'){
                   
                    this.tracked_distance = null;
                    this.tracked_date = null;
                    this.error == null;

               }else {
                    return this.error = {due_moment:'Please select a valid due moment type.'};
               }


               if( typeof parseInt(this.tracked_distance) != 'number'){
                    return this.error = {tracked_distance:'Please input a valid number.'};

               }

                this.error = null;

               let service = { 
                maintenance_service: this.maintenance_service,
                due_moment: this.due_moment,
                final_date: this.tracked_date,
                tracked_distance: this.tracked_distance 
               } 

               fetch('/add-service',{
                   method:'POST',
                   body: JSON.stringify(service),
                   headers:{
                       'Content-Type': 'application/json',
                       'X-CSRF-TOKEN':this.csrf
                   }
               }).then( res => res.text() )
               .then(response =>  {
                  let res = JSON.parse(response);
                  if(res.Errors){
                    this.error = res.Errors;
                  }

                   
                   })
               .catch(error => console.error('Error:', error));
            

            document.querySelector('.modal').classList.remove('show')
               e.preventDefault()

        }


    }
}
</script>