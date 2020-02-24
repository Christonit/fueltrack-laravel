<script>
import { Line, mixins } from 'vue-chartjs';
const { reactiveProp } = mixins;

export default {
  extends: Line,
  name:'expenses-chart',
  mixins: [reactiveProp],
  data: () => ({
      gradient: null,

    // chartData:{
    //     labels:["Feb 22 - Feb 28","Feb 15 - Feb 21","Feb 8 - Feb 14","Feb 1 - Feb 7","Jan 25 - Jan 31"],
    //     datasets:[{
    //       label: '# of Votes',
    //       data: [0,1350,0,1673,478],
    //     }]
    // },
    options: {
          responsive: true,
          maintainAspectRatio: true
    }
    
  }),
  props: {
    chartData:{
      type:Object,
      default:null
    }
    },
  mounted () {

    this.renderChart(this.chartData, this.options)
  },
  watch: {
    // chartData () {
    //   // this.$data._chart.update()
    //       this.renderChart(this.chartdata, this.options)

    // }
  }
}
</script>
