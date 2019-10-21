<template>


    <div  class='small-12 medium-8 large-8 float-center'>
        <!-- No performance info message -->
        <div v-if=" vehicle.cityMpg == '' && vehicle.highwayMpg == '' " class="callout secondary">
            <h4>No data available for this vehicle:  {{vehicle.maker +' ' +  vehicle.model +' ' + vehicle.year}}</h4>
        </div>


        <div v-if=" vehicle.cityMpg != '' && vehicle.highwayMpg != '' ">
            <div   class="flex-container j-c-between align-items-center margin-vertical-1 padding-horizontal-3">
                <span><b class="label-primary-text">Performance stats resume</b></span>

                <div class="elements-group">
                    <div class="switch-container flex-container align-items-center">
                        <label for="" class="margin-right-1 "><b class="label-secondary-text">Compare vehicles</b></label>
                        <div class="flex-container switch">
                            <input class="switch-input" id="yes-no" type="checkbox" name="compare-vehicles">
                            <label class="switch-paddle" for="yes-no">
                                <!-- <span class="show-for-sr">Do you like me?</span> -->
                                <span class="switch-active" aria-hidden="true">Yes</span>
                                <span class="switch-inactive" aria-hidden="false">No</span>
                            </label>
                        </div>
                    </div>
                </div>

            </div>


            <div class="stats-table ">

                <div class="grid-x row header ">
                    <div class="cell small-3 label-hollow margin-right-2"><b>Vehicle</b></div>
                    <div class="cell small-2 label-hollow  text-center"><b>Fuel type</b></div>
                    <div class="cell small-2 label-hollow  text-center"><b>City MPG</b></div>
                    <div class="cell small-2 label-hollow  text-center"><b>Highway MPG</b></div>
                    <div class="cell small-2 label-hollow  text-center"><b>combined MPG</b></div>
                </div>

                <div class="grid-x row ">
                    <div class="cell small-3 margin-right-2">{{vehicle.maker +' ' +  vehicle.model +' ' + vehicle.year}}  </div>
                    <div class="cell small-2 text-center">{{vehicle.fuelTypePrimary}}</div>
                    <div class="cell small-2 text-center">{{vehicle.cityMpg}}</div>
                    <div class="cell small-2 text-center">{{vehicle.highwayMpg}}</div>
                    <div class="cell small-2 text-center">{{vehicle.combinedMpg}}</div>
                    <div class="cell auto">x</div>
                </div>

            </div>

        </div>




    </div>
</template>

<script>
    export default {
        name: "stats-table",
        props:['hasVehicle','vehicle']
    }
</script>

<style scoped>

</style>
