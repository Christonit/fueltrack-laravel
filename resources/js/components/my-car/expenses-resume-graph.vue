<template>
    <section>
        <div id="overview-graph" class="card clearfix">
            <label class="input-group-label float-right" data-expense-filter='cost-analysis'>
                <span>Cost analysis</span>
                <select class="">
                    <option value="volvo">Last 30 days</option>
                    <option value="saab">Last 3 months</option>
                    <option value="mercedes">Last 6 months</option>
                </select>
            </label>
            <expenses-chart ref="canvas" class="expenses-line-chart" :height='280' :chart-data="fuelUpsChartData"></expenses-chart>
             <div id='graph-filter' class="grid-x">
                <div class="mobile-app-toggle small-12 medium-7" data-mobile-app-toggle data-expense-filter='date-format'>
                    <label class="input-group-label float-right">
                        <span>Date format</span>
                        <button class="button">Daily</button>
                        <button class="button is-active">Weekly</button>
                        <button class="button">Monthly</button>
                    </label>
                </div>

                <div class="small-12 medium-5" data-expense-filter='show-by'>
                    <label class="input-group-label float-right">
                        <span>Show by </span>
                        <select class="">
                            <option value="volvo">Expenses</option>
                            <option value="saab">Fuel ups</option>
                            <option value="mercedes">Trip distance</option>
                        </select>
                    </label>
                </div>
            </div>

        </div>

        <expenses-logs class="small-12 medium-12" id="expenses-logs"  :print-icon="printIcon"></expenses-logs>

    </section>
</template>

    <script>
    import ExpensesChart from './expenses-chart.vue';
    import ExpensesLogs from './expenses-logs.vue';
    import store from '../../store/index.js';

    export default {
            name: "expenses-resume-graph",
            components:{
                ExpensesChart,
                ExpensesLogs
            },
            data(){
                return {
                    fuelUps : '',
                    performance:0,
                    hasExpenses:false,
                    loaded:false,
                    
                }
            },
            props:['printIcon'],
            created(){
                // Candidato a irse a State Management.
                this.$store.dispatch('graphExpensesWeekly').then( data => {
                    
                        this.fuelUps = this.$store.state.weeklyExpenses;
                        this.loaded = true;

                })

            },
            mounted(){
                
            },
            computed:{
                 fuelUpsChartData(){
                    return {
                            labels:this.fuelUps.Dates,
                            datasets: [{
                                label: '# of fuelups',
                                data: this.fuelUps.Expenses,
                                backgroundColor: 'rgba(235,87,87,0.07)',
                                hoverBackgroundColor:'rgba(235,87,87,0.07)',
                                borderWidth: 3,
                                lineTension:0,
                                borderColor: 'rgba(235,87,87,1)',
                                pointBorderColor:'rgba(255,255,255,1)',
                                pointBorderWidth: 3,
                                pointBackgroundColor:'rgba(235,87,87,1)',
                                pointHoverBackgroundColor:'rgba(47,128,237,1)',
                                pointHoverBorderColor:'rgba(255,255,255,1)',
                                pointRadius:7,
                                pointHoverRadius:7,
                                hoverBorderWidth: 3,
                                hoverBorderColor: 'rgba(235,87,87,1)',
                                pointHitRadius:15
                                }]
                            
                            }
                         
                    }
            },

            methods:{

                    setGradient(){
                            
                    }
            }
    }
    </script>
  