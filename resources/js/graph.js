
let colorsArray = ['#f1635b','#0544c7','#2c1fe6','#dbfb41','#f20fd9','#4ee566','#dd48dc','#4f1f48','#e47a6e','#08e8ab','#b8740a','#f4508d','#e43e36','#ff6a1a'];
const windowSize = screen.width;
const xs = 512;
const sm = 768;
const md = 896;
const lg = 1152;
const xl = 1280;

let shuffle = (o) => {
    for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
};

if (windowSize <= sm) {
    var overviewGraph = document.querySelector('#overview-graph');

    var filters = [].slice.call(document.querySelectorAll('[data-expense-filter]'));
    var filtersBtn = document.createElement('a');
    filtersBtn.setAttribute('href','#');
    var overviewFilters = document.createElement('div');

    overviewFilters.classList.add('card','clear-card','filters-accordion');
    var accHeight = 42;

    filtersBtn.onclick= (e)=>{
        overviewFilters.classList.toggle('filters-accordion-full');
        // overviewFilters.style.height = ;

        e.preventDefault();

    };

    filtersBtn.innerText = 'Filters';
    expenses.insertBefore(overviewFilters, overviewGraph);

    overviewFilters.appendChild(filtersBtn);
    for (var r in filters) {
        overviewFilters.appendChild(filters[r]);
    }
}



var bar_ctx = document.getElementById('bar-chart').getContext('2d');

var purple_orange_gradient = bar_ctx.createLinearGradient(0, 0, 0, 600);
purple_orange_gradient.addColorStop(0, 'rgba(235,87,87,0.3)');
purple_orange_gradient.addColorStop(1, 'rgba(255,255,255,0)');

let weekly_expenses = new Array();

for(expenses of  weekly_cost){
    expenses = expenses.replace(',',' ');

    weekly_expenses.push(parseFloat(expenses));

}

var bar_chart = new Chart(bar_ctx, {
    type: 'line',
    data: {
        labels: weekly_range,
        datasets: [{
            data: weekly_expenses,
            backgroundColor: purple_orange_gradient,
            hoverBackgroundColor: purple_orange_gradient,
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
            pointHitRadius:15,
        }]
    },
    options: {
        title:{
        },
        tooltips:{
            position:'average',
            bodySpacing:8,
            xPadding:8,
            yPadding:8,
            custom: function(tooltip) {
                if (!tooltip) return;
                tooltip.displayColors = false;
            }
        },
        legend:{
            display:false,
            labels:{
                display:false,
                padding: 20
            },
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});




// Dough nut chart

// if( typeof m_s_category !== 'undefined'){


//     var maintenanceChart = document.getElementById("maintenance-chart").getContext('2d');



//     new Chart(maintenanceChart, {

//         type: 'doughnut',

//         data: {

//             labels: m_s_category,

//             datasets: [
//                 {
//                     label: "Population (millions)",
//                     backgroundColor: shuffle(colorsArray),
//                     data: m_s_total_cost       }
//             ]

//         },
//         options: {

//             cutoutPercentage:80,

//             legend:{
//                 labels:{
//                     fontFamily:'Work sans',
//                     fontColor:'#393C40',
//                 },
//                 position:'bottom'
//             }

//         }
//     });


// }

