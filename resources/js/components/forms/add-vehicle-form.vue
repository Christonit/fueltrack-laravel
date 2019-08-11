<template>
        <form id="add-vehicle" class="float-center" method="POST" action="/add-vehicle">

            <slot name="csrf"></slot>

            <input type="hidden" name="Avg_MPG" :value="vehicleStats.combinedMpg">
            <input type="hidden" name="City_MPG" :value="vehicleStats.cityMpg">

            <input type="hidden" name="Highway_MPG" :value="vehicleStats.highwayMpg">


            <div id="signup-vehicle-info-basic"  class=''>

                <h4 class="text-center">Your basic vehicle info</h4>

                <label>Year
                    <select ref='selectedYear' class="" name="year" @click.once="getYears" @change="getMakers">
                        <option v-for='year in years' :value="year"> {{year}}</option>
                    </select>
                </label>

                <label>Maker
                    <select ref='selectedMaker' class="" name="maker" @change="getModels" :disabled="hasMaker == false  ">
                        <option v-for='maker in makers' :value="maker">{{ maker }}</option>
                    </select>
                </label>

                <label>Model
                    <select ref='selectedModel'  name="model" @change="getStats" :disabled="hasModel  == false">
                        <option v-for='model in models' :value="model">{{ model }}</option>
                    </select>
                </label>


                <label v-if="hasStats">
                    <span v-if="checkStats" class="callout error " >This vehicle doesn't have official performance stats. Try another one or type your personal vehicle stats.</span>
                </label>


                <div class="expanded button-group ">
                    <a href="#" class="hollow button previews">Back</a>

                    <a class="button" href="#" data-add-vehicle='continue-usage' :class="!checkVehicleStats ? ' disabled' : '' "  @click="nextTab">Continue</a>
                </div>


                <hr>

                <a href="#" class="hollow button secondary expanded" data-user-info='submit-user-info'>Finish for now & fill vehicle info later</a>

            </div>

            <vehicle-usage-info class="hide" :previews-tab="previewsTab" :next-tab="nextTab"></vehicle-usage-info>

            <vehicle-misc-info class="hide" :previews-tab="previewsTab" :next-tab="nextTab" ></vehicle-misc-info>



        </form>

</template>

<script>
    import VehicleMiscInfo from './vehicle-misc-info.vue';
    import VehicleUsageInfo from './vehicle-usage-info.vue';

    export default {
        name: "add-vehicle-form",
        props:['currentYear','selectMaker'],
        components:{
            VehicleUsageInfo,
            VehicleMiscInfo
        },
        data(){
          return {
              years:'',
              makers:'',
              models:'',
              hasStats: false,
              hasVehicleStats: false,
              hasModel: false,
              hasMaker: false,
              vehicleStats:''
          }
        },
        computed:{

            checkVehicleStats(){
                if(this.vehicleStats != ''){

                    return this.vehicleStats.cityMpg != ''  && this.vehicleStats.combinedMpg != '' && this.vehicleStats.highwayMpg != '' && this.vehicleStats.combinedMpg != 0
                }

            },
            checkStats(){

                return this.vehicleStats.cityMpg == undefined  && this.vehicleStats.combinedMpg == undefined && this.vehicleStats.highwayMpg == undefined || this.vehicleStats.combinedMpg == 0 ||  this.vehicleStats == ''

            }
        },
        methods:{
            previewsTab(e){
                e.target.parentElement.parentElement.classList.add('hide')
                e.target.parentElement.parentElement.previousElementSibling.classList.remove('hide')
            },
            nextTab(e){
              e.target.parentElement.parentElement.classList.add('hide')
              e.target.parentElement.parentElement.nextElementSibling.classList.remove('hide')
            },
             getStats(){
                let maker = this.$refs.selectedMaker.value;
                let model = this.$refs.selectedModel.value;
                let year = this.$refs.selectedYear.value;

                 this.$store.dispatch("getVehicleStats",{
                    maker:maker,
                    year:year,
                    model:model
                }).then(()=>{
                     this.vehicleStats =  this.$store.state.stats
                     this.hasStats = true;
                 });
            },

            getYears(){
                this.$store.dispatch("getYears");
                this.years = this.$store.state.years;

            },getModels(e){

                let year =  this.$refs.selectedYear.value;
                let maker = this.$refs.selectedMaker.value;

                this.$store.dispatch("getModels",{
                    maker:maker,
                    year:year
                });

                this.models = this.$store.state.models;
                this.hasModel = true

            },
            getMakers(e){

                let year = this.$refs.selectedYear.value

                this.$store.dispatch("getMakers",year);

                this.makers = this.$store.state.makers;
                this.hasMaker = true
            }
        }
    }
</script>

<style scoped>

</style>
