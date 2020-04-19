<template>
    <div class="tabs-panel">
    <table class="dashboard-table">

      
            <thead>

            <tr>
                <th class='text-left'><a href="#">Date <i class="fa fa-caret-down"></i></a></th>
                <th class='text-center'><a href="#">Quantity <i class="fa fa-caret-down"></i></a></th>
                <th class='text-right'><a href="#">Cost <i class="fa fa-caret-down"></i></a></th>

            </tr>
            </thead>

            <tbody>

                
                <template v-if="hasExpenses">
                    <tr  v-for="expense in expenses">
                            <td>
                                <h6 class="dashboard-table-text">{{expense.Date}}</h6>
                                <span class="dashboard-table-timestamp">10:00 PM</span>
                            </td>
                    

                            <td class='text-center'>
                                <h6>
                                    {{expense.Galons}}
                                    Gal
                                </h6>
                                    <span class="dashboard-table-timestamp">{{Math.round(expense.Galons * performance.Avg_MPG ) }} Km Est. Drivable Distance </span>
                            </td>

                            <td class='text-right'>
                                <h6 class="dashboard-table-text">RD$ {{(expense.Galons * expense.Current_fuel_price)}}</h6>
                                <span class="dashboard-table-timestamp">RD$ {{expense.Current_fuel_price}} Fuel Price</span>
                            </td>
                    </tr>
                </template>

                <tr v-else>
                    <td colspan="3">
                        <div class="callout secondary">

                            <h4 class="text-center">
                                You have no fuel expenses to show.
                            </h4>

                        </div>
                    </td>
                </tr>
                    
            </tbody>


            
    </table>



</div>
</template>


<script>
import store from '../../store/index.js';
export default {
        name: "expenses-historic",
        data(){
            return {
                expenses : '',
                performance:0,
                hasExpenses:false
            }
        },
        created(){

            // Candidato a irse a State Management.

            this.$store.dispatch('expensesHistoric').then( () => {

                let res = this.$store.state.expensesHistoric;
                this.performance = res.vehicle_p[0]
                this.expenses = res.expense.data;
                    if(!this.expenses == ''){
                        return this.hasExpenses = true;
                    }else{
                        return false
                    }
                })
        },

        methods:{

        }
}
</script>
