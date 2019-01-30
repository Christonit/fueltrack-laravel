
// Window size parameters.

var windowSize = screen.width;
var xs = 512;
var sm = 768;
var md = 896;
var lg = 1152;
var xl = 1280;



// URL and view validator


var filename = window.location.pathname;



var emailPtrn = /(?!.*\.{2})^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;


// UI components selectors.
var userDetails = document.querySelector('#signup-user-details'),
    vehicleInfoBasic = document.querySelector('#signup-vehicle-info-basic'),
    vehicleInfoUsage = document.querySelector('#signup-vehicle-info-usage'),
    vehicleInfoMisc = document.querySelector('#signup-vehicle-info-misc'),
    selector = document.querySelector('a[data-responsive-toggle]');


    var addVehicleForms = [
      '#signup-user-details',
      '#signup-vehicle-info-basic',
      '#signup-vehicle-info-usage',
      '#signup-vehicle-info-misc'
    ];

    var continueBTN = document.querySelector(addVehicleForms[0] + ' a.success');



    var backBTN1 = document.querySelector('#signup-vehicle-info-basic .previews');
    var backBTN2 = document.querySelector('#signup-vehicle-info-usage .previews');
    var backBTN3 = document.querySelector('#signup-vehicle-info-misc .previews');
    var previewBtn = document.querySelector('[data-add-vehicle="review"]');



// Sign up forms functions

function previewsTab(e){
  var currentEl = this.parentElement.parentElement.getAttribute('id');

  if(currentEl == 'signup-vehicle-info-misc'){

      console.log('esto funciona');

  }else if (currentEl == 'signup-vehicle-info-usage') {

    vehicleInfoBasic.classList.remove('hide');
    vehicleInfoUsage.classList.add('hide');


  }else if (currentEl == 'signup-vehicle-info-basic') {

    vehicleInfoBasic.classList.add('hide');
    userDetails.classList.remove('hide');
    document.querySelector('.tabs-title.is-active').classList.remove('is-active');
    document.querySelector('.tabs-title.is-done').classList.add('is-active');
    document.querySelector('.tabs-title.is-done').classList.remove('is-done');


  }

}

function reviewInfo(){



}




function vehicleValidation(e){

      var maker = document.querySelector('select[name="maker"]');
      var model = document.querySelector('select[name="model"]');
      var year = document.querySelector('select[name="year"]');

      if ( maker.value == '' && model.value == '' && year.value == '') {

        console.log('fuck');

      }else {

        vehicleInfoBasic.classList.add('hide');
        vehicleInfoUsage.classList.remove('hide');

        continueBTN = document.querySelector(addVehicleForms[1] + ' a.success').onclick = vehicleUsageValidation;


      }

      e.preventDefault();
}


function vehicleUsageValidation(e){

    var  usageYears = document.querySelector('input[name="usage_years"]');
    var  acquisitionDate = document.querySelector('input[name="acquisition_date"]');
    var  totalDistance = document.querySelector('input[name="init_miles"]');

      if ( usageYears.value == '' && acquisitionDate.value == '' && totalDistance.value == '') {


      }else {

        vehicleInfoUsage.classList.add('hide');
        vehicleInfoMisc.classList.remove('hide');
      }

}

function signUpValidation(){

    var  username = document.querySelector('input[name="username"]').value;
    var  email = document.querySelector('input[name="email"]').value;
    var  password = document.querySelector('input[name="password"]').value;


      if (username !== '' && email !== '' &&  password !== '' && emailPtrn.test(email) == true ) {

        document.querySelector('#signup-vehicle-info-basic').classList.remove('hide');
        userDetails.classList.add('hide');
        document.querySelector('.tabs-title.is-active').classList.replace('is-active','is-done');
        document.querySelector('.tabs-title.is-done').nextElementSibling.classList.add('is-active');
        continueBTN = document.querySelector(addVehicleForms[1] + ' a.success').onclick = vehicleValidation;



      }else{
      }
      alert('Revisar tu:' + username + ' '+ password + ' ' + email);

}


//Sign up and login validation and tabs management.

if (filename == '/sign-up') {

  continueBTN.onclick = function(){
    signUpValidation();

  };

  previewBtn.addEventListener('click', (e) => {

        document.querySelector('.tabs-title').nextElementSibling.classList.remove('is-done','is-active');
        vehicleInfoMisc.classList.add('hide');
        userDetails.classList.remove('hide');
        document.querySelector('.tabs-title ').classList.add('is-active');
  });

  backBTN1.onclick = previewsTab;
  backBTN2.onclick = previewsTab;

}




// End forms functions


var signUpBtn = document.querySelector('a[href="sign-up"]'),
    menu = document.querySelector('[data-toggle="main-menu"]'),
    menuDropDown = document.querySelector('#main-menu'),
    menuDropDownList = document.querySelector('#main-menu ul'),
    miscButtons = document.querySelector('.top-bar-right ul'),
    header = document.querySelector('header'),
    userSttg = document.querySelector('#user-settings-dropdown'),
    userSttgBtn = document.querySelector('[data-user-settings="menu"]'),
    body = document.querySelector('body'),
    expenses = document.querySelector('#expenses');

    if(filename !== 'sign-up' && filename !== 'login' ){
      var menuChild = document.querySelector('[data-dropdown-menu] li:last-child');
    }

////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
// Overlay creation

var overlayExist = false;
var overlay;


class overlayPop{
     createOverlay(){

         var  elm = document.createElement('div');
              elm.className = 'overlay';
              body.appendChild(elm);

         overlay = document.getElementsByClassName('overlay');

         overlayExist = true;

      // return overlay;

    }

    closeOverlay(){

            for (var i = 0; i < overlay.length; i++) {
              overlay[i].remove();
            }
            overlayExist = false;
    }

    removeOverlay(toHide){

            for (var i = 0; i < overlay.length; i++) {
              overlay[i].remove();
            }

            toHide.style.display = 'none';
            overlayExist = false;
    }

}


// Creates menu overlay
var p = new overlayPop();

if(filename == '/index' || filename == '/my-car' || filename == '/' ){


  selector.onclick = function(e){

    if (overlayExist == false) {
      p.createOverlay();
      overlay[0].onclick=function(){
        p.removeOverlay(menuDropDown);
      };
    }else {
      p.removeOverlay(menuDropDown);
    }

  };


}

// Executes code if logged in and in 'My car view'
// This code pertains to mainly to graphs and filters manipulations.
if(filename == '/my-car'){
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
  purple_orange_gradient.addColorStop(0, 'orange');
  purple_orange_gradient.addColorStop(1, 'purple');

  var bar_chart = new Chart(bar_ctx, {
      type: 'bar',
      data: {
          labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
          datasets: [{
              label: '# of Votes',
              data: [12, 19, 3, 8, 14, 5],
  						backgroundColor: purple_orange_gradient,
  						hoverBackgroundColor: purple_orange_gradient,
  						hoverBorderWidth: 2,
  						hoverBorderColor: 'purple'
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





}



$('[data-open-details]').click(function (e) {
  e.preventDefault();
  $(this).next().toggleClass('is-active');
  $(this).toggleClass('is-active');
});



// //////////////////////////////////////
// //////////////////////////////////////

// Conditions for mobile only scripts

if(windowSize <= sm){

  // creates Floating Action Button
    if(filename == '/my-car' & isUserSignedIn == true){
      var fActionButton = document.querySelector('.fab');

          fActionButton.addEventListener('touchstart', function(e){

              this.classList.toggle('active');

                  if(overlayExist == false){

                    p.createOverlay();
                    overlay[0].style.zIndex = 999;
                    overlay[0].addEventListener('touchstart', function(){
                      p.closeOverlay();
                      fActionButton.classList.remove('active');
                    } );
                  }else {
                    p.closeOverlay();
                  }

          });
    }

    var statsViewsAnchors = '<li class="tabs-title is-active"><a href="#m-expenses"  aria-selected="true">Expenses</a></li><li class="tabs-title"><a data-tabs-target="m-maintenances" href="#m-maintenances">Maintenances</a></li><li class="tabs-title "><a href="#m-performance"  data-tabs-target="m-performance" >Performance</a></li>'
    var statsContent = $('<div class="tabs-content" data-tabs-content="m-vehicle-stats"><div class="tabs-panel is-active" id="m-expenses"></div><div class="tabs-panel" id="m-maintenances"></div><div class="tabs-panel" id="m-performance"></div></div>');
    var mStatsTabs = $('<ul class="tabs" data-tabs id="m-vehicle-stats"></ul>');

    var vehicleExpenses = $('#expenses');
    var vehicleMaintenance = $('#maintenance');
    var vehiclePerformance = $('#performance');

        $('#expenses-resume').after(statsContent);
        $('#expenses-resume').after(mStatsTabs);
        $('#m-vehicle-stats').append(statsViewsAnchors);
        $('#m-expenses').append(vehicleExpenses);
        $('#m-maintenances').append(vehicleMaintenance);
        $('#m-performance').append(vehiclePerformance);



  if(filename !== '/sign-up' & filename !== '/login' ){

      header.appendChild(miscButtons);
      document.querySelector('.top-bar-right').remove();
      body.insertBefore(menuDropDown, header.nextSibling);

      if(isUserSignedIn == true){

            header.appendChild(userSttgBtn)


      }else if(isUserSignedIn == false){
          var logInBtn = document.querySelector('ul[data-misc] li:nth-child(3)');

          menuDropDownList.appendChild(logInBtn)

      }

    }


  }
