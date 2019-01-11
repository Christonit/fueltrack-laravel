// Fetches vehicle years
var maker ='hola';
var year = '';
var model = '';
var mIndex;
var moIndex;
var yIndex;

class vehiclePopulation{

    constructor(){

    }

    create(){

        this.getYears();

        this.getMakers();

        let vModels = new Promise(function (resolve, reject) {

            var checkMaker = setInterval( ()=>{

                var  maker = document.querySelector('select[name="maker"]');
                let options =  document.querySelector('select[name="maker"] option');

                if(maker.contains(options) == true){

                    resolve();

                    clearInterval(checkMaker);

                }else {

                }
            },150);


        });

        vModels.then( () =>{

            return this.getModels();
        })

    }



    getMakers(){

        fetch('https://www.fueleconomy.gov/ws/rest/vehicle/menu/make?year=2012')
            .then(function (response) {
                return response.text();
            })
            .then(function (data) {
                var x = $(data).find('value').each(function(){
                    var y = $(this).text();
                    var options = $('<option></option>');
                    options.val(y).html(y);
                    $('select[name="maker"]').append(options);
                });
            });

    }

    getYears(){
        fetch('https://www.fueleconomy.gov/ws/rest/vehicle/menu/year')
            .then(function (response) {
                return response.text();
            })
            .then(function (data) {
                var x = $(data).find('value').each(function(){
                    var y = $(this).text();
                    var options = $('<option></option>');
                    options.val(y).html(y);
                    $('select[name="year"]').append(options);
                });
            })
            .catch(error => console.error('Error:', error));

    }

    getModels(){

        maker = document.querySelector('select[name="maker"]');
        mIndex = maker.selectedIndex;
        maker =  maker.options[mIndex].value;

        year = document.querySelector('select[name="year"]');
        yIndex = year.selectedIndex;
        year =  year.options[yIndex].value;

        fetch("https://www.fueleconomy.gov/ws/rest/vehicle/menu/model?year="+year+"&make="+maker+"")
            .then(function (response) {

                return response.text();

            })
            .then(function (data) {
                $('select[name="model"]').html('');

                var x = $(data).find('value').each(function(){
                    var y = $(this).text();
                    var options = $('<option></option>');
                    options.val(y).html(y);
                    $('select[name="model"]').append(options);

                });
            })
            .catch(error => console.error('Error:', error));

    }


    getVehicleStats(){
        maker = document.querySelector('select[name="maker"]');
        mIndex = maker.selectedIndex;
        maker =  maker.options[mIndex].value;

        if (/\s/.test(maker)) {
            maker = maker.replace(' ','%20');
        }
        model = document.querySelector('select[name="model"]');
        moIndex = model.selectedIndex;
        model =  model.options[moIndex].value;

        if (/\s/.test(model)) {
            model = model.replace(' ','%20');
        }

        year = document.querySelector('select[name="year"]');
        yIndex = year.selectedIndex;
        year =  year.options[yIndex].value;

        var fuelgov = "https://www.fueleconomy.gov/ws/rest/ympg/shared/vehicles?make="+maker+"&model="+model+"";

        fetch(fuelgov)
            .then(function (response) {

                return response.text();

            })
            .then(function (data) {

                var modelList = $(data).find('vehicle').length;
                var i = 0;


                if(modelList == 0 ){

                    if ($('#fetched-results').length == 1 ) {

                        $('#fetched-results').remove();
                        // return false;

                    }else {
                        var callout = $('<div id="fetched-results" class="grid-container fluid clearfix"></div>');
                        $('#vehicle-search').append(callout);

                        $(callout).load('/no-model-found');
                    }

                    console.log('');

                }else {

                    var fgYear = $('year',data).each(function(){

                        i++

                        if (this.innerHTML == year) {
                            var vehicle = this.parentElement.childNodes;

                            console.log(fuelgov);

                            // Combinned unrounded MPG for highway and city
                            console.log(vehicle[20].innerHTML);

                            // Unrounded MPG for city -- cityA08U
                            console.log(vehicle[9].innerHTML);


                            // Unrounded MPG for highway -- highway08U
                            console.log(vehicle[42].innerHTML);

                            // console.log(vehicle);
                            if ($('#fetched-results').length == 1 ) {

                                $('#fetched-results').remove();

                            }

                            // console.log(vehicle[43].nodeName);
                            return false;

                        }else {

                            if(i == modelList){

                                if ($('#fetched-results').length == 1 ) {
                                    // $('#fetched-results').remove();

                                    return false;

                                }else {
                                    $('#fetched-results').remove();

                                    console.log(data)
                                    var callout = $('<div id="fetched-results" class="grid-container fluid clearfix"></div>');
                                    $('#vehicle-search').append(callout);

                                    $(callout).load('/no-car-found');
                                }

                                return false;

                            }


                        }




                    });
                }
                return false;
            })
            .catch(error => console.error('Error:', error));


    }


}


var popular = new vehiclePopulation;
popular.create();

let vBrands = document.querySelector('#vehicle-search select[name="maker"]');
vBrands.onchange = function(){
    popular.getModels();
};

$('#vehicle-search button[type="button"]').click(popular.getVehicleStats);

let vYear = document.querySelector('#vehicle-search select[name="year"]');
vYear.onchange = function(){
    popular.getModels();
};
