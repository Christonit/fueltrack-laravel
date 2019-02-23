
if (windowSize <= sm) {
    var overviewGraph = document.querySelector('#overview-graph');

    var filters = [].slice.call(document.querySelectorAll('[data-expense-filter]'));
    var filtersBtn = document.createElement('a');
    // filtersBtn.setAttribute('class','accordion-title');
    filtersBtn.setAttribute('href','#');
    var overviewFilters = document.createElement('div');

    overviewFilters.classList.add('card','clear-card','filters-accordion');
    var accHeight = 42;

    filtersBtn.onclick= (e)=>{
        overviewFilters.classList.toggle('filters-accordion-full');
        // overviewFilters.style.height = ;

        e.preventDefault();

    };

    // overviewFilters.style.height = accHeight + 'px';


    // overviewFilters.innerHTML = ' <li class="accordion-item is-active" data-accordion-item></li>';
    filtersBtn.innerText = 'Filters';
    expenses.insertBefore(overviewFilters, overviewGraph);
    // var accordionContent = document.createElement('div');
    //     accordionContent.classList.add = 'accordion-content';
    //     accordionContent.setAttribute('data-tab-content','');
    // var accordionContent = document.createElement('div');


    // // overviewFilters = overviewFilters.children;
    overviewFilters.appendChild(filtersBtn);
    // overviewFilters.appendChild(accordionContent);
    for (var r in filters) {
        overviewFilters.appendChild(filters[r]);
    }


}

var bar_ctx = document.getElementById('bar-chart').getContext('2d');

var purple_orange_gradient = bar_ctx.createLinearGradient(0, 0, 0, 600);
purple_orange_gradient.addColorStop(0, 'rgba(235,87,87,0.7)');
purple_orange_gradient.addColorStop(1, 'rgba(255,255,255,0)');

var bar_chart = new Chart(bar_ctx, {
    type: 'line',
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 8, 14, 5],
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
        legend:{
            display:false,
            labels:{
                display:false
                // fontColor: "#000",
                // boxWidth: 20,
                // padding: 20
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

var maintenanceChart = document.getElementById("maintenance-chart").getContext('2d');



new Chart(maintenanceChart, {

    type: 'doughnut',

    data: {

        labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],

        datasets: [
            {
                label: "Population (millions)",
                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                data: [2478,5267,734,784,433]        }
        ]

    },
    options: {

        cutoutPercentage:80,

        legend:{
            labels:{
                fontFamily:'Work sans',
                fontColor:'#393C40',
            },
            position:'bottom'
        }

    }
});
