<template>
   <div >

        <ul class="tabs" data-deep-link="true" data-update-history="true" data-deep-link-smudge="true" data-deep-link-smudge-delay="500" data-tabs id="deeplinked-tabs">
            <li class="tabs-title is-active"><button type='button'  data-tab='fuel-expenses-logs' @click="changeTabs">Fuel ups</button></li>
            <li class="tabs-title"><button type="button" data-tab='maintenance-logs'  @click="changeTabs">Services</button></li>
        </ul>

        <div class="tabs-content" data-tabs-content="deeplinked-tabs">


            <expenses-historic  id="fuel-expenses-logs" ref="fuel-expenses-logs"></expenses-historic>
            <maintenances-historic class="is-active" id="maintenance-logs" ref="maintenance-logs"></maintenances-historic>




        </div>

    </div>

</template>

<script>

    import ExpensesHistoric from './expenses-historic.vue';
    import MaintenancesHistoric from './maintenances-historic.vue';

    export default {
            name: "expenses-logs",
            components:{
                ExpensesHistoric,
                MaintenancesHistoric
            },
            data(){
                return {
                   
                }
            },
            created(){
                // Candidato a irse a State Management.

            },

            methods:{
               changeTabs(e){
                 let el = e.target.getAttribute('data-tab');
                 let ActiveTab =  document.querySelector('.tabs-panel.is-active');
                 ActiveTab.classList.remove('is-active');
                 document.querySelector(`#${el}`).classList.add('is-active');

               }
            }
    }

</script>
  