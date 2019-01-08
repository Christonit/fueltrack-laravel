// import {formAjx} from 'form-handlres.js';


var windowSize = screen.width;

var xs = 512;
var sm = 768;
var md = 896;
var lg = 1152;
var xl = 1280;

// Sign up selectors
var url = window.location.pathname;
    url = url.substring(0,(url.lastIndexOf('/')+1));

var filename = window.location.pathname;
    filename = filename.substring(url.length,filename.length);

// var currentView  = url + url.substring(url.lastIndexOf('/') + 1)

//Session info

var isSignedUp = true;


var userDetails = document.querySelector('#signup-user-details'),
    vehicleInfoBasic = document.querySelector('#signup-vehicle-info-basic'),
    vehicleInfoUsage = document.querySelector('#signup-vehicle-info-usage'),
    vehicleInfoMisc = document.querySelector('#signup-vehicle-info-misc'),
    selector = document.querySelector('a[data-responsive-toggle]');

    addVehicleForms = [
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
  currentEl = this.parentElement.parentElement.getAttribute('id');

  if(currentEl == 'signup-vehicle-info-misc'){

      console.log('esto funciona');

  }else if (currentEl == 'signup-vehicle-info-usage') {

    vehicleInfoBasic.classList.remove('hide');
    vehicleInfoUsage.classList.add('hide');


  }else if (currentEl == 'signup-vehicle-info-basic') {

    vehicleInfoBasic.classList.add('hide');
    userDetails.classList.remove('hide');
    // document.querySelector('.tabs-title.is-active').previousSibling.classList.remove('is-done').classList.add('is-active');
    document.querySelector('.tabs-title.is-active').classList.remove('is-active');
    document.querySelector('.tabs-title.is-done').classList.add('is-active');
    document.querySelector('.tabs-title.is-done').classList.remove('is-done');


  }

}

function reviewInfo(){



}

function signUpValidation(e){
      username = document.querySelector('input[name="username"]');
      email = document.querySelector('input[name="email"]');
      password = document.querySelector('input[name="password"]');


      if (username.value == '' || email.value == '' ||  password.value == '') {

        console.log('fuck');


      }else {

        document.querySelector('#signup-vehicle-info-basic').classList.remove('hide');
        userDetails.classList.add('hide');
        document.querySelector('.tabs-title.is-active').classList.replace('is-active','is-done');
        document.querySelector('.tabs-title.is-done').nextElementSibling.classList.add('is-active');
        continueBTN = document.querySelector(addVehicleForms[1] + ' a.success').onclick = vehicleValidation;

      }

      e.preventDefault();
}


function vehicleValidation(e){

      maker = document.querySelector('select[name="maker"]');
      model = document.querySelector('select[name="model"]');
      year = document.querySelector('select[name="year"]');

      if ( maker.value == '' && model.value == '' && year.value == '') {

        console.log('fuck');

      }else {

        vehicleInfoBasic.classList.add('hide');
        vehicleInfoUsage.classList.remove('hide');

        continueBTN = document.querySelector(addVehicleForms[2] + ' a.success').onclick = vehicleUsageValidation;


      }

      e.preventDefault();
}


function vehicleUsageValidation(e){

      usageYears = document.querySelector('input[name="usageYear"]');
      acquisitionDate = document.querySelector('input[name="AcquisitionDate"]');
      totalDistance = document.querySelector('input[name="totalDistance"]');

      if ( usageYears.value == '' && acquisitionDate.value == '' && totalDistance.value == '') {


      }else {

        vehicleInfoUsage.classList.add('hide');
        vehicleInfoMisc.classList.remove('hide');
        // continueBTN = document.querySelector(addVehicleForms[3] + ' a.success').onclick = vehicleUsageValidation;
      }

}


if (filename == 'sign-up.html') {

  continueBTN.onclick = signUpValidation;

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


var signUpBtn = document.querySelector('a[href="sign-up.html"]'),
    menuChild = document.querySelector('[data-dropdown-menu] li:last-child'),
    menu = document.querySelector('[data-toggle="main-menu"]'),
    menuDropDown = document.querySelector('#main-menu'),
    miscButtons = document.querySelector('.top-bar-right ul'),
    header = document.querySelector('header'),
    userSttgBtn = document.querySelector('[data-user-settings="menu"]'),
    body = document.querySelector('body'),
    expenses = document.querySelector('#expenses')


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

      return overlay;

    }

    removeOverlay(toHide){

            for (var i = 0; i < overlay.length; i++) {
              overlay[i].remove();
            }

            toHide.style.display = 'none';
            overlayExist = false;

    }

}

p = new overlayPop();

if(filename == 'index.html' || filename == 'My Car.html' || filename == '' ){


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

// if(filename == 'My Car.html'){
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

  // var bar_ctx = document.getElementById('bar-chart').getContext('2d');

  // var purple_orange_gradient = bar_ctx.createLinearGradient(0, 0, 0, 600);
  // purple_orange_gradient.addColorStop(0, 'orange');
  // purple_orange_gradient.addColorStop(1, 'purple');
  //
  // var bar_chart = new Chart(bar_ctx, {
  //     type: 'bar',
  //     data: {
  //         labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
  //         datasets: [{
  //             label: '# of Votes',
  //             data: [12, 19, 3, 8, 14, 5],
  // 						backgroundColor: purple_orange_gradient,
  // 						hoverBackgroundColor: purple_orange_gradient,
  // 						hoverBorderWidth: 2,
  // 						hoverBorderColor: 'purple'
  //         }]
  //     },
  //     options: {
  //       title:{
  //       },
  //         legend:{
  //           display:false,
  //           labels:{
  //             display:false
  //             // fontColor: "#000",
  //             // boxWidth: 20,
  //             // padding: 20
  //           },
  //         },
  //         scales: {
  //             yAxes: [{
  //                 ticks: {
  //                     beginAtZero:true
  //                 }
  //             }]
  //         }
  //     }
  // });
  //
  //
  //
  //
  // // Dough nut chart
  //
  // var maintenanceChart = document.getElementById("maintenance-chart").getContext('2d');
  //
  //
  //
  // new Chart(maintenanceChart, {
  //
  //     type: 'doughnut',
  //
  //     data: {
  //
  //       labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
  //
  //       datasets: [
  //         {
  //           label: "Population (millions)",
  //           backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
  //           data: [2478,5267,734,784,433]        }
  //       ]
  //
  //     },
  //     options: {
  //
  //       cutoutPercentage:80,
  //
  //       legend:{
  //         labels:{
  //           fontFamily:'Work sans',
  //           fontColor:'#393C40',
  //         },
  //         position:'bottom'
  //       }
  //
  //     }
  // });
  //
  //



// }



////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
// Graphics generation


//Toggle buttons


// maintenance tab expand
$('[data-open-details]').click(function (e) {
  e.preventDefault();
  $(this).next().toggleClass('is-active');
  $(this).toggleClass('is-active');
});



// //////////////////////////////////////
// //////////////////////////////////////

// Conditions for mobile only scripts

if(windowSize <= sm){

  menuChild.appendChild(signUpBtn);
  header.appendChild(miscButtons);
  document.querySelector('.top-bar-right').remove();
  body.insertBefore(menuDropDown, header.nextSibling);

  if(isSignedUp == true){

    header.appendChild(userSttgBtn);

  }else if(isSignedUp == false){

  }

}



// continueBTN.onclick = formSend;
//
//
//
// function formSend(e){
//
//   fetch('/sign-up-x').then(function(response) {
//     alert('esto funciono');
//     return response.json();
//   })
//   .then(function(myJson) {
//     console.log(myJson);
//   });
//
//
//
//   // alert('hola');
//
//   e.preventDefault();
// }


$(document).foundation();
