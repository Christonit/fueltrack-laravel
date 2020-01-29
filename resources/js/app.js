
import Vue from 'vue'

window.Vue = require('Vue');

import store from './store/index.js';

// import StatsTable from './modules/fuelgov/stats-table.vue';
import StatsTable from './components/utilities/stats-table.vue';
import ExpensesHistoric from './components/my-car/expenses-historic.vue';
import MaintenancesHistoric from './components/my-car/maintenances-historic.vue';
import RegisterUsersForm from './components/forms/register-users.vue';
import AddVehicleForm from './components/forms/add-vehicle-form.vue';


// Vue.component('stats-table', require('./modules/fuelgov/stats-table.vue').default);



$(document).foundation();

const windowSize = screen.width;
const xs = 512;
const sm = 768;
const md = 896;
const lg = 1152;
const xl = 1280;



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

/*
* The following block of code may be used to automatically register your
* Vue components. It will recursively scan this directory for the Vue
* components and automatically register them with their "basename".
*
* Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
*/

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// import  ExampleComponent from './components/ExampleComponent.vue';

const app = new Vue({
    el: '#app',
    store,
    data:{
        message:'hola mundo',
        makers:'',
        models:'',
        years:'',
        currentYear : new Date().getFullYear(),
        compare:true,
        hasVehicle:false,
        vehicle:{}
    },
    components:{
        StatsTable,
        RegisterUsersForm,
        AddVehicleForm,
        ExpensesHistoric,
        MaintenancesHistoric

    },
    created(){


    },
    mounted(){

    },

    computed:{

        testStore(){
            return this.$store.state.test;
        }

    },
    methods:{
        selectMaker(e){
            this.models = this.getModels(e.target.value, this.$refs.selectedYear.value)

        },
        xmlToDoc(dataToParse){
            var parser = new DOMParser();
            return parser.parseFromString(dataToParse,"text/xml");
        },

        getYears(){

            let xmlToDoc = this.xmlToDoc;
            let years = [];


            fetch('https://www.fueleconomy.gov/ws/rest/vehicle/menu/year')
                .then(function (response) {
                    return response.text();
                })
                .then(function (data) {


                    let yearsList = xmlToDoc(data)

                    yearsList = yearsList.childNodes[0]

                    for(let i = 0; i < yearsList.childElementCount; i++) {

                        years.push( yearsList.childNodes[i].childNodes[1].textContent);

                    };

                })
                .catch(error => console.error('Error:', error));


            return years;

        },
        getMakers(year = this.currentYear){

            var currentYear = year;
            // currentYear = year.getFullYear();
            let brands = [];

            let xmlToDoc = this.xmlToDoc;
            fetch(`https://www.fueleconomy.gov/ws/rest/vehicle/menu/make?year=${year}`)
                .then(function (response) {
                    return response.text();
                })
                .then(function (data) {

                    // console.log(data);

                    let xmlDoc = xmlToDoc(data);

                    let brandList = xmlDoc.childNodes[0];

                    // brandCount = brandList.childElementCount

                    // console.log(brandList.childElementCount)
                    for(let i = 0; i < brandList.childElementCount; i++) {
                        brands.push( brandList.childNodes[i].childNodes[1].textContent );

                    };



                    // this.makers  = brands;
                }).catch(error => console.error('Error:', error));

            return brands;
        },
        getModels(maker = this.makers[0], year = this.currentYear){
            let xmlToDoc = this.xmlToDoc;
            let models = [];

            fetch(`https://www.fueleconomy.gov/ws/rest/vehicle/menu/model?year=${year}&make=${maker}`)
                .then(function (response) {

                    return response.text();

                })
                .then(function (data) {
                    let xmlDoc = xmlToDoc(data);

                    let modelList = xmlDoc.childNodes[0];

                    for(let i = 0; i < modelList.childElementCount; i++) {
                        models.push( modelList.childNodes[i].childNodes[1].textContent );
                        // console.log(modelList.childNodes[i].childNodes[1].textContent);


                    };
                })
                .catch(error => console.error('Error:', error));

            return models;

        },
        getVehicleStats(maker, model, year){
            var maker = maker;
            var model = model;
            var year = year;
            let xmlToDoc = this.xmlToDoc;


            var highwayMpg = null;
            var cityMpg = null;
            var combinedMpg = null;
            var fuelType = null;
            var fuelTypePrimary = null;
            var fuelTypeSecondary = null;
            var message = null;

            if (typeof maker === 'undefined' || typeof maker === 'object'){

                maker = this.$refs.selectedMaker.value;

            } else if( typeof maker === 'function' || typeof maker === 'boolean' ){
                return 'Error: Insert correct value.'
            }

            if (typeof model === 'undefined'){

                model = this.$refs.selectedModel.value;

            }else if( typeof model === 'function' || typeof model === 'boolean' || typeof model === 'object' ){

                return 'Insert correct value.'
            }


            if ( typeof year === 'undefined'    ){

                year = this.$refs.selectedYear .value;

            }else if( typeof year !== 'number' ){
                return 'Insert correct value.'

            }


            var fuelgov = `https://www.fueleconomy.gov/ws/rest/ympg/shared/vehicles?make=${maker}&model=${model}`;
            fetch(fuelgov)
                .then( (response)  => {

                    return response.text();

                })
                .then( (data) =>  {

                    let xmlDoc = xmlToDoc(data);

                    let stats = xmlDoc.childNodes[0];


                    for(let i = 0; i < stats.childElementCount; i++){

                        console.log(`${maker} ${model}  ${year}`);


                        if ( stats.childNodes[i].childNodes[80].textContent == year) {


                            //Unrounded highway miles
                            highwayMpg = stats.childNodes[i].childNodes[43].textContent;

                            //Unrounded combined miles
                            combinedMpg = stats.childNodes[i].childNodes[20].textContent;

                            //Unrounded city miles
                            cityMpg = stats.childNodes[i].childNodes[9].textContent;

                            //Fuel type
                            fuelType = stats.childNodes[i].childNodes[36].textContent;

                            //Fuel type 1 for Gasoline usage
                            fuelTypePrimary = stats.childNodes[i].childNodes[37].textContent;

                            //Fuel type 2 if its hybrid
                            fuelTypeSecondary = stats.childNodes[i].childNodes[38].textContent;




                            break;
                        }


                    }

                    cityMpg = Number(parseFloat(cityMpg).toFixed(2));
                    highwayMpg = Number(parseFloat(highwayMpg).toFixed(2));
                    combinedMpg = Number(parseFloat(combinedMpg).toFixed(2));

                    if( isNaN(highwayMpg) ){

                        // && highwayMpg == '' || highwayMpg == null && cityMpg == '' || cityMpg == null){
                        highwayMpg='';

                    }


                    if(isNaN(cityMpg)){

                        // && highwayMpg == '' || highwayMpg == null && cityMpg == '' || cityMpg == null){
                        cityMpg ='';

                    }


                    if ( isNaN(combinedMpg) || combinedMpg == null && cityMpg != '' && highwayMpg != '' ){

                        combinedMpg = Number( (highwayMpg * 0.45 )+ (cityMpg  * 0.55) );
                        message = 'Platform calculated average.';

                    }


                    // console.log(`${cityMpg } ${highwayMpg } ${ combinedMpg }`)


                    this.hasVehicle = true;

                    return this.vehicle = {
                        maker:maker,
                        model:model,
                        year:parseInt(year),
                        highwayMpg: highwayMpg,
                        cityMpg: cityMpg,
                        combinedMpg: combinedMpg,
                        fuelType:fuelType,
                        fuelTypePrimary:fuelTypePrimary,
                        fuelTypeSecondary:fuelTypeSecondary,
                        message:message
                    }

                })

        }



    }
// components:{
//     ExampleComponent
    // }
});

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






}



$('.maintenance-service').click(function (e) {
    e.preventDefault();
    $(this).parent().parent().parent().next().toggleClass('is-active');
    $(this).parent().parent().toggleClass('is-active');
});



// //////////////////////////////////////
// //////////////////////////////////////

// Conditions for mobile only scripts

if(windowSize <= sm){

    // creates Floating Action Button
    if(isUserSignedIn == true){
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


$('a.success').click( (e)=>{
    e.preventDefault()
});
