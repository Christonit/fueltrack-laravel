<template>
    

    <section id="maintenance" class="small-12 medium-3">

    <div id='maintenance-resume' class="card no-m-bottom">

        <div class="clearfix">
            <h5 class="float-left">Maintenances</h5>
            <button class="hollow  button float-right alternative" data-open="add-service">Add service</button>
        </div>

    </div>

    <div id="scheduled-maintenance" class="card no-m-top">
        <template v-if="maintenance_list.length > 0">
            <div class="scheduled-maintenance-card clearfix" v-for=" maintenance in maintenance_list ">
                <div class="scheduled-maintenance-detail">

                    <i class="service-icon scheduled-maintenance-category float-left">
                    </i>

                     <h6 class="scheduled-maintenance-title float-center">
                        {{maintenance.maintenance_service}}
                    </h6>

                    <ul class="dropdown menu more-options float-right" data-dropdown-menu>
                        <li>
                            <a href="#">
                                <i class="material-icons">
                                    more_vert
                                </i>
                            </a>
                            <ul class="menu">
                                <li><a href="#">Item 1A</a></li>
                            </ul>

                        </li>

                    </ul>
                    <template v-if="maintenance.due_moment == 'Inmediate' || maintenance.due_moment == 'Specific distance' &&   maintenance.maintenance_current_distance > maintenance.tracked_distance || maintenance.due_moment == 'Specific date' &&  today > maintenance.final_date">
                            <span :data-maintenance-id="maintenance.id" class="faux-checkbox" data-open="done-service">
                                     <span class="dot"></span>
                            </span>
                    </template>


                </div>

                <div class="status-progress">
                

                <template v-if="maintenance.due_moment == 'Specific distance'">
                    <span class="status-current">
                        <b>Current</b>
                        <br>
                        <template v-if="maintenance.current_distance > maintenance.tracked_distance">
                            {{`${maintenances.current_distance - maintenance.tracked_distance } miles overdue`}}
                        </template>

                        <template v-else>
                            {{maintenance.current_distance}}
                        </template>
                    </span>

                    <span class="status-current text-right">
                        <b>Tracked</b><br>
                        {{maintenance.tracked_distance}}
                    </span>

                    <progress max="100" :value=" (maintenance.current_distance / maintenance.tracked_distance)*100"></progress>

                </template>

                <template v-if=" maintenance.due_moment == 'Specific date'">

                    <span class="status-current" v-if="daysBetween(maintenance.final_date) > 0">
                        <b>Days left</b><br>
                        {{ daysBetween(maintenance.final_date)}}
                    </span>

                    <span class="status-current" v-else>
                        <b>Days overdue</b><br>
                        {{` ${ -1 * daysBetween(maintenance.final_date)}`}}
                    </span>

                    <span class="status-current text-right">
                        <b>Target date</b><br>
                        {{maintenance.final_date}}
                    </span>

                    <progress max="100" value="90"></progress>

                </template>
                <template v-if=" maintenance.due_moment == 'Inmediate'">

                    <span class="status-current">
                        <b>Urgency</b><br>
                        Inmediate
                    </span>
                    <span class="status-current text-right"></span>
                    <progress max="100" value="100"></progress>

                </template>
              
                </div>
            </div>
        </template>

        <div class="scheduled-maintenance-card clearfix"  v-else>
                <div class="scheduled-maintenance-detail callout secondary">

                    <h4 class="text-center">
                        Currently there are no maintenances pending.
                    </h4>

                </div>

            </div>
       

            


    </div>


</section>

</template>

<script>
export default {
            name: "user-vehicle-maintenances",
            components:{
               
            },
            data(){
                return {
                   maintenance_list:'',
                   today: null 
                }
            },
            computed:{
                
            },
            created(){
                let currentDate = new Date();
                this.today = `${currentDate.getFullYear()}-${currentDate.getMonth() + 1 }-${currentDate.getDate()}`;

                // Candidato a irse a State Management.
                fetch('/maintenances/user/active-mainetances').then( response => response.text()).then( data => {

                        return this.maintenance_list = JSON.parse(data);

                })
            },

            methods:{
               daysBetween(targetDate){

                    let target = new Date(targetDate);
                    let today = new Date(this.today);
                    let Difference_In_Time = target.getTime() - today.getTime(); 

                     return (Difference_In_Time / (1000 * 3600 * 24));
                }
            }
    
}
</script>