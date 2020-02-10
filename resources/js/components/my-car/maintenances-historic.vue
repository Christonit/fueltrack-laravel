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

                <template #service-icon> {{printServiceCategoryIcon(service.maintenance_service)}} </template>
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
            created(){
                // Candidato a irse a State Management.
                fetch('/maintenances/all-maintenances').then( response => response.text()).then( data => {

                            this.maintentance_services_list =JSON.parse( data);

                    })


            },

            methods:{
                printServiceCategoryIcon(maintenance_service){
                    switch(maintenance_service.toLowerCase()){

                        case('wheel change'):
                            return '&#xe800';
                        break;

                        case('alignment'):
                            return '&#xe801';
                        break;

                        case('battery change'):
                            return '&#xe802';
                        break;

                        case('body fix'):
                            return '&#xe803';
                        break;

                        case('brake check'):
                            return '&#xe804';
                        break;

                        case('cleaning'):
                            return '&#xe805';
                        break;

                        case('coolant fill'):
                            return '&#xe806';
                        break;

                        case('electricity check'):
                            return '&#xe807';
                        break;

                        case('engine check'):
                            return '&#xe808';
                        break;

                        case('filter change'):
                            return '&#xe809';
                        break;

                        case('tire change'):
                            return '&#xe810';
                        break;

                        case('transmission check'):
                            return '&#xe811';
                        break;

                        case('inmediate check'):
                            return '&#xe80a';
                        break;

                        case('oil change'):
                            return '&#xe80b';
                        break;

                        case('paint job'):
                            return '&#xe80c';
                        break;

                        case('part change'):
                            return '&#xe80d';
                        break;

                        case('preassure check'):
                            return '&#xe80e';
                        break;

                        case('scheduled maintenance'):
                        return '&#xe80f';
                        break;

                        default:
                        return '&#xe80f';

                    }

                },
                tableIsActive(e){

                    
                   let tableToExpande =  e.target.nextElementSibling;
                    //    this.$refs.nextElementSibling.classList.add = 'is-active'; 
                   console.log(this.$ref.maintenance_table)
                }
            }
    }
    </script>
  