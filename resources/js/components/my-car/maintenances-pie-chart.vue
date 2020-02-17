<script>
import { Doughnut, mixins } from 'vue-chartjs';
const { reactiveProp } = mixins;


export default {
  name:"maintenances-doughnut",
  mixins: [reactiveProp],
  extends:Doughnut,
  data(){
    return{
      options: { layout: {
            padding: {
                left: 56,
                right: 56,
                top: 0,
                bottom: 0
            }
        },
        cutoutPercentage:80,
        legend: {
          position: 'bottom'
        },
        responsive: true,
        maintainAspectRatio: true
      }
    }
  },
  props: {
    chartData:{
      type:Object,
      default:null
    }

  },
  
  mounted () {
    this.renderChart(this.chartData, this.options)
  }
}

</script>