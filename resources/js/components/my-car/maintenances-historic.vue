<template>
<div class="tabs-panel" >

               

<table class="table-expand">

    <template v-if='maintentance_services_list.length > 0'>
        <tr  v-for='service in maintentance_services_list'>
            <maintenances-historic-row 
                :due-moment="service.due_moment" 
                :service-id="service.id"
                :overdue-distance="service.overdue_distance"
                :tracked-distance="service.tracked_distance"
                :date-performed="service.date_performed">

                <template #service-icon> {{printIcon(service.maintenance_service)}} </template>
                <template #maintenance-service> {{service.maintenance_service}} </template>
                <template #cost> {{service.cost}} </template>
                <template #workshop> {{service.workshop}} </template>
                <template #details> {{service.details}} </template>

            </maintenances-historic-row>
            
        </tr>
         
    </template>

    <template v-else>
        <tr>
            <td>
                <div class="callout secondary">

                    <h4 class="text-center">
                    You dont have performed any service yet.
                    </h4>

                </div>
            </td>
        </tr>
    </template>
</table>
</div>
</template>

    <script>
    import MaintenancesHistoricRow from './maintenances-historic-row.vue';
    export default {
            name: "maintenances-historic",
            components:{
                MaintenancesHistoricRow
            },
            data(){
                return {
                    maintentance_services_list : '',
                    performance:0,
                    hasExpenses:false
                }
            },
            props:['printIcon'],
            created(){
                this.$store.dispatch('maintenanceHistoric').then( () => {
                    this.maintentance_services_list = this.$store.state.maintenanceHistoric;
                })
                
            },

            methods:{

                tableIsActive(e){

                    
                   let tableToExpande =  e.target.nextElementSibling;
                    //    this.$refs.nextElementSibling.classList.add = 'is-active'; 
                   console.log(this.$ref.maintenance_table)
                }
            }
    }
    </script>
  