<template>
    <div id="signup-vehicle-info-usage" >

        <h4 class="text-center">One last thing before you go...</h4>
        <label>Usage years
            <input type="number" ref="usageYears" name="usage_years" v-model="usageYears">
        </label>

        <label>Acquisition date
            <input type="date" ref="acquisitionDate" name="acquisition_date" v-model="acquisitionDate">
        </label>

        <label>Acumulated distance - Mileage
            <input type="number" ref="initMiles" name="init_miles" v-model="initMiles">
        </label>



        <div class="expanded button-group ">
            <a href="#" class="hollow button previews" @click="previewsTab">Back</a>
            <a class="button " href="#" data-add-vehicle='continue-misc'  :class="!hasUsageInfo ? 'disabled' : ''" @click="nextTab">Continue</a>
        </div>

    </div>
</template>

<script>
    export default {
        name: "vehicle-usage-info",
        props:['nextTab','previewsTab'],
        data(){
            return {
                initMiles:'',
                usageYears:'',
                acquisitionDate:''


                // acquisitionDate:this.$refs.acquisitionDate.value
            }
        },
        computed:{
            hasUsageInfo(){

                // var acqDate = this.$refs.acquisitionDate;

                return   !isNaN(this.initMiles) && this.initMiles.length > 0 && this.usageYears.length > 0 && !isNaN(this.usageYears) && this.acquisitionDate !== '' ;
            },
        }
    }
</script>

<style scoped>

</style>
