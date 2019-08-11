import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state:{
        test:'Exito',
        years:[],
        makers:'',
        models:'',
        stats:''
    },
    mutations: {
        storeYears(state,years){
            state.years = years;
        },
        storeMakers(state,makers){
            state.makers = makers
        },
        storeModels(state,models){
            state.models = models
        },
        storeStats(state,stats){
            // console.log(stats)
            state.stats = stats

        }
    },
    actions:{
        getYears(context){

            let parser = new DOMParser();

            var xmlToDoc = x => parser.parseFromString(x,"text/xml");

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


            context.commit('storeYears',years);

        },
        getMakers(context,payload){

            let brands = [];

            let parser = new DOMParser();

            var xmlToDoc = x => parser.parseFromString(x,"text/xml");

            fetch(`https://www.fueleconomy.gov/ws/rest/vehicle/menu/make?year=${payload}`)
                .then(function (response) {
                    return response.text();
                })
                .then(function (data) {

                    // console.log(data);

                    let xmlDoc = xmlToDoc(data);

                    let brandList = xmlDoc.childNodes[0];

                    for(let i = 0; i < brandList.childElementCount; i++) {
                        brands.push( brandList.childNodes[i].childNodes[1].textContent );

                    };

                }).catch(error => console.error('Error:', error));

            context.commit('storeMakers',brands);
        },

        getModels(context, payload){

            let models = [];

            let parser = new DOMParser();

            var xmlToDoc = x => parser.parseFromString(x,"text/xml");

            fetch(`https://www.fueleconomy.gov/ws/rest/vehicle/menu/model?year=${payload.year}&make=${payload.maker}`)
                .then(function (response) {

                    return response.text();

                })
                .then(function (data) {
                    let xmlDoc = xmlToDoc(data);

                    let modelList = xmlDoc.childNodes[0];

                    for(let i = 0; i < modelList.childElementCount; i++) {
                        models.push( modelList.childNodes[i].childNodes[1].textContent );

                    };
                })
                .catch(error => console.error('Error:', error));

            context.commit('storeModels',models);

        },
         getVehicleStats(context,payload){
            var maker = payload.maker;
            var model = payload.model;
            var year = payload.year;

            let parser = new DOMParser();

            var xmlToDoc = x => parser.parseFromString(x,"text/xml");


            var highwayMpg = null;
            var cityMpg = null;
            var combinedMpg = null;
            var fuelType = null;
            var fuelTypePrimary = null;
            var fuelTypeSecondary = null;
            var message = null;



            var fuelgov = `https://www.fueleconomy.gov/ws/rest/ympg/shared/vehicles?make=${maker}&model=${model}`;
             return fetch(fuelgov)
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


                         // this.hasVehicle = true;

                         let vehicleStats = {
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

                         context.commit('storeStats',vehicleStats);


                     })

         }
    }
});