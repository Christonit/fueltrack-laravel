<template>
    <div id="signup-vehicle-info-misc" >

        <h4 class="text-center">Miscellaneous but useful information.</h4>
        <label>Fuel type
            <select class="" name="fueltype">
                <option value="Gasoline">Gasoline</option>
                <option value="LPG">LPG - Liquefied petroleum gas</option>

            </select>
        </label>

        <label>Prefered distance measurement unit
            <select class="" name="meassurement_unit">
                <option value="KM">Km</option>
                <option value="MILES">Miles</option>
            </select>
        </label>




        <button class="button expanded" type="submit" data-add-vehicle='submit'>Start voyage</button>

        <hr>

        <a href="#" class="hollow button secondary expanded" data-add-vehicle='review' @click="previewsTab">Review before submit</a>

    </div>
</template>

<script>
    export default {
        name: "vehicle-misc-info",
        props:['nextTab','previewsTab'],
    }
</script>

<style scoped>

</style>
