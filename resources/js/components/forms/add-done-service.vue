<template>

    <div class="modal">
        <span class="overlay" @click="closeModal"></span>
        <div class="reveal " id="add-expense" data-reveal>

            <h3 class="text-center">Service performed</h3>
           
            <form name="service-performed">
                <input type="hidden" name="_token" :value="csrf">

                <div class="revealbutton" id="done-service" data-reveal>

                    <!-- {{--<input type="hidden" name="_method" value="PATCH">--}} -->



                        <input type="hidden" name="maintenance_service" value="">

                        <fieldset class="grid-x">

                            <div class="small-12 medium-5 cell">
                                <label for="middle-label" class="text-left middle">Date performed</label>
                            </div>
                            <div class="small-12 medium-7 cell">

                                <div class="small-12 medium-3  cell">
                                    <input type="date" name="date_performed" v-model="date_performed" value=""/>
                                </div>

                            </div>

                            <span class="small-12 alert" v-if=" error.date != ''">
                                {{error.date}}
                            </span>
                        </fieldset>
                        





                        <fieldset class="grid-x">
                            <div class="small-12 medium-5 cell">
                                <label for="middle-label" class="text-left middle">Cost</label>
                            </div>
                            <div class="small-12 medium-7  cell">
                                <input type="number" v-model="cost" name="cost"/>
                            </div>

                            <span class="small-12 alert" v-if="error.cost != ''">
                                {{error.cost}}
                            </span>

                        </fieldset>




                        <fieldset class="grid-x">

                            <div class="small-12 medium-5 cell">
                                <label for="middle-label" class="text-left middle">Service category</label>

                            </div>

                            <div class="small-12 medium-7 cell">
                                <select name="service_category" v-model="service_category">
                                    <option value="part change">Part change</option>
                                    <option value="accesory install">Accesory install</option>
                                    <option value="maintenance">Maintenance</option>
                                    <option value="miscellaneous">Miscellaneous</option>


                                </select>
                            </div>

                            <span class="small-12 alert" v-if="error.service_category != ''">
                                {{error.service_category}}
                            </span>

                        </fieldset>


                    <div class="expanded button-group ">
                        <button  class="hollow button secondary cancel" @click="closeModal">Cancel</button>
                        <button class="button success" type="button" data-open="done-service-details" @click="first_step_validation">Next</button>
                    </div>

                    <button class="close-button" data-close aria-label="Close reveal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>



                </div>



                <div class="reveal hide" id="done-service-details" data-reveal>
                    <h3 class="text-center">Service performed</h3>

                        <template v-if="service_category == 'maintenance'">
                            <fieldset id="warranty-options" class="grid-x">

                                <div class="small-12 medium-5 cell">
                                    <label for="middle-label" class="text-left">Warranty/Insurance</label>
                                </div>
                                <div class="small-12 medium-7 cell">

                                    <input type="radio" name="warranty_insurance" v-model="warranty_insurance" value="1"/><label    for="warranty_insurance">Yes</label>
                                    <input type="radio" name="warranty_insurance" v-model="warranty_insurance" value="0"/><label    for="warranty_insurance">No</label>
                                </div>

                                <span class="small-12 alert" v-if="error.warranty_insurance != ''">
                                    {{error.warranty_insurance}}
                                </span>
                            </fieldset>
                        </template>
                        

                        <template v-else-if="service_category == 'part change'">

                            <fieldset id="warranty-options" class="grid-x">

                                <div class="small-12 medium-5 cell">
                                    <label for="middle-label" class="text-left">Warranty/Insurance</label>
                                </div>
                                <div class="small-12 medium-7 cell">

                                    <input type="radio" name="warranty_insurance" v-model="warranty_insurance" value="1"/><label    for="warranty_insurance">Yes</label>
                                    <input type="radio" name="warranty_insurance" v-model="warranty_insurance" value="0"/><label    for="warranty_insurance">No</label>
                                </div>

                                 <span class="small-12 alert" v-if="error.warranty_insurance != ''">
                                    {{error.warranty_insurance}}
                                </span>
                            </fieldset>


                            <div id="other-options" class="grid-x">

                                <div class="small-12 medium-6 cell">
                                    <label for="middle-label" class="text-left">Self service</label>

                                    <input type="radio" name="self_service" v-model="self_service" value="1">
                                    <label for="self-service">Yes</label>

                                    <input type="radio" name="self_service" v-model="self_service" value="0">
                                    <label for="self-service">No</label>

                                    <div v-if="error.self_service != ''">
                                        {{error.self_service}}
                                    
                                    </div>
                                </div>


                                <div class="small-12 medium-6 cell">
                                    <label for="middle-label" class="text-left">Is original</label>
                                    <input type="radio" name="original_rep" v-model="original_rep" value="1"/><label    for="original_rep">Yes</label>
                                    <input type="radio" name="original_rep" v-model="original_rep" value="0"/><label    for="original_rep">No</label>
                                    <div v-if="error.original_rep != ''">
                                        {{error.original_rep}}
                                    </div>
                                </div>

                            </div>
                        </template>

                        <template v-else>
                            <div id="service-options" class="grid-x middle">

                                <div class="small-12 medium-6 cell">
                                    <label for="middle-label" class="text-left">Self service</label>

                                    <input type="radio" name="self_service" v-model="self_service" value="1">
                                    <label for="self-service">Yes</label>

                                    <input type="radio" name="self_service" v-model="self_service" value="0">
                                    <label for="self-service">No</label>

                                    <div v-if="error.original_rep != ''">
                                        {{error.original_rep}}
                                    </div>
                                </div>


                                <div class="small-12 medium-6 cell">
                                    <label for="middle-label" class="text-left">Warranty/Insurance</label>
                                    <input type="radio" name="warranty_insurance" v-model="warranty_insurance" value="1"/><label    for="warranty_insurance">Yes</label>
                                    <input type="radio" name="warranty_insurance" v-model="warranty_insurance" value="0"/><label    for="warranty_insurance">No</label>
                                    <div v-if="error.warranty_insurance != ''">
                                        {{error.warranty_insurance}}
                                    </div>
                                </div>
                            </div>
                        </template>



                    <fieldset class="grid-x" v-if="self_service == 0">

                        <div class="small-12 medium-5 cell" >
                            <label for="middle-label" class="text-left middle">Workshop name</label>
                        </div>
                        <div class="small-12 medium-7  cell">
                            <input type="text" name="workshop" v-model="workshop" value="">
                        </div>

                    </fieldset>


                    <fieldset class="grid-x">





                        <div class="small-12 medium-5 cell">
                            <label for="middle-label" class="text-left middle">Details</label>
                        </div>
                        <div class="small-12 medium-7  cell">
                            <textarea name="details" v-model="details" rows="3"></textarea>
                        </div>

                    </fieldset>







                    <div class="expanded button-group ">
                        <button class="hollow button secondary cancel"  @click="prevEl">Previews</button>

                        

                        <button  class="button success"  @click="getData">Continue</button>
                    </div>

                    <button class="close-button" data-close aria-label="Close reveal" type="button" @click="closeModal">
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
            error:{
                service_category:null,
                cost: null,
                date:null

            },
            date_performed:'',
            cost: '',
            service_category: '',
            warranty_insurance: '',
            self_service: '',
            original_rep: '',
            workshop: '',
            details: '',
        }
    },
    props:{
        serviceId: {type: Number, default: 0}
    },
    mounted(){
        
    },
    computed:{

    },

    methods:{
        prevEl(e){
            document.querySelector('#done-service-details').classList.add('hide');
            document.querySelector('#done-service').classList.remove('hide');

            e.preventDefault();

        },
        first_step_validation(e){

            if(this.date_performed == ''){
                this.error.date = 'Insert a valid date'; 
            }else{
               
                    this.error.date = '';
                
            }

            if(typeof this.cost != 'number' && this.cost.length < 1 && this.cost.length == ''){
                this.error.cost = 'Insert service cost';
            }else{
                this.error.cost = '';
            }
            
           
            if( !(this.service_category == 'part change' || this.service_category == 'accesory install' || this.service_category == 'maintenance' || this.service_category == 'miscellaneous') ){
                
                this.error.service_category = 'Select a service category';
            }else{
              
                this.error.service_category = '';
            }

            if( !(this.date_performed == '' &&  this.cost == '' &&     this.service_category == '')  ){
                document.querySelector('#done-service-details').classList.remove('hide');
                document.querySelector('#done-service').classList.add('hide');
            }


            e.preventDefault();

        },

        closeModal(e){

            let el = document.querySelector('.modal.show');
            this.$emit('serviceToDefault');
            return el.classList.remove('show');
        },
        getData(e){

            if(this.service_category == 'part change'){
                if(this.original_rep ==  ''){

                    this.error.original_rep = 'Please select an option';

               }else{

                    this.error.original_rep = ''; 
               }

               if(this.self_service ==  ''){

                    this.error.self_service = 'Please select an option';

               }else{

                    this.error.self_service = ''; 
               }


               if(this.warranty_insurance ==  ''){

                 this.error.warranty_insurance = 'Please select an option';

               }else{
                   this.error.warranty_insurance = ''
               }

               if(this.self_service == 1 && this.workshop ==  ''){

                 this.workshop = 'At home'; 

               }else if(this.self_service == 0 && this.workshop ==  '') {

                   this.error.workshop = "This field is mandatory"
               }else{
                   this.error.workshop = ""
               }
            }

            if(this.service_category == 'accesory install' || this.service_category == 'miscellaneous'){

                this.error.original_rep = null; 

               if(this.self_service ==  ''){

                    this.error.self_service = 'Please select an option';

               }else{

                    this.error.self_service = ''; 
               }


               if(this.warranty_insurance ==  ''){

                 this.error.warranty_insurance = 'Please select an option';

               }else{
                   this.error.warranty_insurance = ''
               }

               if(this.self_service == 1 && this.workshop ==  ''){

                 this.workshop = 'At home'; 

               }else if(this.self_service == 0 && this.workshop ==  '') {

                   this.error.workshop = "This field is mandatory"
               }else{
                   this.error.workshop = ""
               }
            }

            if(this.service_category == 'maintenance'){

                this.error.original_rep = null; 
                this.self_service ==  null

               if(this.warranty_insurance ==  ''){

                 this.error.warranty_insurance = 'Please select an option';

               }else{
                   this.error.warranty_insurance = ''
               }

               if(this.workshop ==  ''){

                 this.workshop = 'At home'; 

               }
            }

               
                
               
                
               let payload = { 
                date_performed:this.date_performed,
                cost:this.cost,
                service_category:this.service_category,
                warranty_insurance:this.warranty_insurance,
                self_service:this.self_service,
                original_rep:this.original_rep,
                workshop:this.workshop,
                details:this.details,
                // maintenance_service:this.serviceId
               } 


               fetch('/mark-as-performed/'+this.serviceId,{
                   method:'POST',
                   body: JSON.stringify(payload),
                   headers:{
                       'Content-Type': 'application/json',
                       'X-CSRF-TOKEN':this.csrf
                   }
               }).then( res => {
                   console.log(res.status)
                   if(res.status == 200 || res.status == 201){

                        this.$store.dispatch('getActiveMaintenances')
                        this.$store.dispatch('getMaintenancesExpenses')
                        this.$store.dispatch('expensesResume')
                        this.$store.dispatch('maintenanceHistoric');

                        return this.closeModal();

                   }

                   return res.text()
                   
                })
               .then(response =>  {
                   console.log(response)
                   
                   })
               .catch(error => console.error('Error:', error));
            

               e.preventDefault()

        }


    }
}
</script>