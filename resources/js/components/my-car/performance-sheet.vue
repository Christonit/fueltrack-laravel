<template>
    <section >
        <div id="performance" class="card">
            <h5 >Performance</h5>
            <div class="performance-section">
                <div class="performance-stat">

                    <i class="ft-icon i-performance icon-highway">&#xe902;</i>

                    <p class="performance-category-title float-center">Highway</p>

                    <p class="hollow-label float-right">{{ Math.round(car.Highway_MPG) }} mpg</p>

                </div>

                <div class="performance-stat">

                    <i class="ft-icon i-performance icon-city">&#xe907;</i>

                    <p class="performance-category-title float-center">City</p>

                    <p class="hollow-label float-right">{{ Math.round(car.City_MPG) }} mpg</p>

                </div>

                <div class="performance-stat">

                    <i class="ft-icon i-performance icon-average">&#xe905;</i>

                    <p class="performance-category-title float-center">Average C/H</p>

                    <p class="hollow-label float-right">{{ Math.round(car.Avg_MPG) }} mpg</p>

                </div>

                <div class="performance-stat">

                    <i class="ft-icon i-performance icon-tank">&#xe908;</i>

                    <p class="performance-category-title float-center">Tank size</p>

                    <p class="hollow-label float-right">999 Km</p>

                </div>


                <div class="performance-stat">

                    <i class="ft-icon i-performance icon-distance">&#xe906;</i>

                    <p class="performance-category-title float-center">Drivable distance</p>

                    <p class="hollow-label float-right">999 Km</p>

                </div>

                <div class="performance-stat">

                    <i class="ft-icon i-performance icon-cost">&#xe900;</i>

                    <p class="performance-category-title float-center">Cost to fill up</p>

                    <p class="hollow-label float-right">9,999 Km</p>

                </div>
            </div>
        </div>
        <div class="share-info card">

            <h6 class='text-center'>Share with pals</h6>

            <div class="rounded-social-buttons">
                <a class="social-button facebook" href="#"></a>
                <a class="social-button twitter" href="#"></a>
                <a class="social-button" href="#"> <i class="material-icons">attachment </i> </a>
                <a class="social-button" href="#"> <i class="material-icons">email </i> </a>

            </div>
        </div>
    </section>
</template>


<script>
    export default {
            name: "performance-sheet",
            data(){
                return {
                    car:''
                }
            },
            created(){

                // Candidato a irse a State Management.
                fetch('/vehicle/user/performance').then( response => response.text()).then( data => {

                        return this.car = JSON.parse(data);

                })
            },

            methods:{

            }
    }
</script>
