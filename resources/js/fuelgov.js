/*
// // Fetches vehicle years
// var maker ='hola';
// var year = '';
// var model = '';
// var mIndex;
// var moIndex;
// var yIndex;
//

// class vehicleFuelEconomy{
//
//     constructor(){
//
//     }
//
//     create(){
//
//         this.getYears();
//
//         this.getMakers();
//
//         let vModels = new Promise(function (resolve, reject) {
//
//             var checkMaker = setInterval( ()=>{
//
//                 var  maker = document.querySelector('select[name="maker"]');
//                 let options =  document.querySelector('select[name="maker"] option');
//
//                 if(maker.contains(options) == true){
//
//                     resolve();
//
//                     clearInterval(checkMaker);
//
//                 }else {
//
//                 }
//             },150);
//
//
//         });
//
//         vModels.then( () =>{
//
//             return this.getModels();
//         })
//
//     }
//
//
//
//     getMakers(){
//         let currentYear = new Date();
//         currentYear = currentYear.getFullYear();
//         fetch('https://www.fueleconomy.gov/ws/rest/vehicle/menu/make?year='+currentYear+'')
//             .then(function (response) {
//                 return response.text();
//             })
//             .then(function (data) {
//                 var x = $(data).find('value').each(function(){
//                     var y = $(this).text();
//                     var options = $('<option></option>');
//                     options.val(y).html(y);
//                     $('select[name="maker"]').append(options);
//                 });
//             });
//
//     }
//
//     getYears(){
//         fetch('https://www.fueleconomy.gov/ws/rest/vehicle/menu/year')
//             .then(function (response) {
//                 return response.text();
//             })
//             .then(function (data) {
//                 var x = $(data).find('value').each(function(){
//                     var y = $(this).text();
//                     var options = $('<option></option>');
//                     options.val(y).html(y);
//                     $('select[name="year"]').append(options);
//                 });
//             })
//             .catch(error => console.error('Error:', error));
//
//     }
//
//     getModels(){
//
//         maker = document.querySelector('select[name="maker"]');
//         mIndex = maker.selectedIndex;
//         maker =  maker.options[mIndex].value;
//
//         year = document.querySelector('select[name="year"]');
//         yIndex = year.selectedIndex;
//         year =  year.options[yIndex].value;
//
//         fetch("https://www.fueleconomy.gov/ws/rest/vehicle/menu/model?year="+year+"&make="+maker+"")
//             .then(function (response) {
//
//                 return response.text();
//
//             })
//             .then(function (data) {
//                 $('select[name="model"]').html('');
//
//                 var x = $(data).find('value').each(function(){
//                     var y = $(this).text();
//                     var options = $('<option></option>');
//                     options.val(y).html(y);
//                     $('select[name="model"]').append(options);
//
//                 });
//             })
//             .catch(error => console.error('Error:', error));
//
//     }
//
//
//     getVehicleStats(){
//         maker = document.querySelector('select[name="maker"]');
//         mIndex = maker.selectedIndex;
//         maker =  maker.options[mIndex].value;
//
//
//         if (/\s/.test(maker)) {
//             maker = maker.replace(' ','%20');
//         }
//         model = document.querySelector('select[name="model"]');
//         moIndex = model.selectedIndex;
//         model =  model.options[moIndex].value;
//
//         if (/\s/.test(model)) {
//             model = model.replace(' ','%20');
//         }
//
//         year = document.querySelector('select[name="year"]');
//         yIndex = year.selectedIndex;
//         year =  year.options[yIndex].value;
//
//         let vehicleStats = new Array()
//         // let vehicleStats = new Object();
//
//
//         var fuelgov = "https://www.fueleconomy.gov/ws/rest/ympg/shared/vehicles?make="+maker+"&model="+model+"";
//
//         fetch(fuelgov)
//             .then(function (response) {
//
//                 return response.text();
//
//             })
//             .then(function (data) {
//
//                 var modelList = $(data).find('vehicle').length;
//                 var i = 0;
//
//
//                 if(modelList == 0 ){
//
//                     console.log('No tenemos informacion de ningun modelo de este fabricante, intenta otro modelo.');
//
//                 }else {
//
//                     var fgYear = $('year',data).each(function(){
//
//                         i++
//
//                         if (this.innerHTML == year) {
//                             var vehicle = this.parentElement.childNodes;
//                             vehicleStats.push(vehicle[20].innerHTML);
//
//                             vehicleStats.push(vehicle[9].innerHTML);
//
//                             vehicleStats.push(vehicle[42].innerHTML);
//
//                             if ($('#fetched-results').length == 1 ) {
//
//                                 $('#fetched-results').remove();
//
//                             }
//
//                             return false;
//                         }else {
//                             if(i == modelList){
//
//                                 if ($('#fetched-results').length == 1 ) {
//                                     return false;
//
//                                 }else {
//                                     var callout = $('<div id="fetched-results" class="grid-container fluid clearfix"></div>');
//                                     $('#vehicle-search').append(callout);
//
//                                     $(callout).load("no-models.html");
//                                 }
//
//
//
//
//
//
//
//                                 return false;
//
//                             }
//
//
//                         }
//
//
//
//
//                     });
//                 }
//
//
//
//
//
//                 if(vehicleStats.length == 3)
//                 {
//
//                     // console.log('1 '+ vehicleStats[1]);
//
//                     return vehicleStats;
//                 }
//
//
//             })
//             .catch(error => console.error('Error:', error));
//
//         let end = setInterval( ()=>{
//
//             if(vehicleStats.length == 3){
//                 clearInterval(end);
//                 // console.log('2 '+ vehicleStats[2] + ' hola');
//
//                 return vehicleStats;
//             }
//
//         },50);
//
//
//         return vehicleStats;
//
//     }
//
//
// }
//
//
// var browseVehicles = new vehicleFuelEconomy;
//
// browseVehicles.create();
//
// let vBrands = document.querySelector(' select[name="maker"]');
// vBrands.onchange = function(){
//     browseVehicles.getModels();
// };
//
// $('#vehicle-search button[type="button"]').click(browseVehicles.getVehicleStats);
//
// let vYear = document.querySelector('select[name="year"]');
// vYear.onchange = function(){
//     browseVehicles.getModels();
// };
*/
