// Fetches vehicle years
var maker ='';
var year = '';
var model = '';
var selectedMaker = '';
var mIndex;
var moIndex;
var yIndex;

class vehiclePopulation{

      constructor(){

        $.get("https://www.fueleconomy.gov/ws/rest/vehicle/menu/year",function(data, status){
          var x = $(data).find('value').each(function(){
          		var y = $(this).text();
              var options = $('<option></option>');
                  options.val(y).html(y);
                  $('select[name="year"]').append(options);
            });

        });

        this.getMakers();

        this.getModels();
      }

      getMakers(){
        $.get("https://www.fueleconomy.gov/ws/rest/vehicle/menu/make?year=2012",function(data, status){
          var x = $(data).find('value').each(function(){
          		var y = $(this).text();
              var options = $('<option></option>');
                  options.val(y).html(y);
                  $('select[name="maker"]').append(options);
            });
            maker = document.querySelector('select[name="maker"]');
            maker.options[0].createAttribute = 'selected';



          });
      }

      getModels(){

        setTimeout(function(){
          if(mIndex <= -1 ){
            mIndex = 0;
          }

          maker = document.querySelector('select[name="maker"]');
          mIndex = maker.selectedIndex;

          maker =  maker.options[mIndex].value;

          $.get("https://www.fueleconomy.gov/ws/rest/vehicle/menu/model?year=2012&make="+maker+"",function(data, status){
            var x = $(data).find('value').each(function(){
                var y = $(this).text();
                var options = $('<option></option>');
                    options.val(y).html(y);
                    $('select[name="model"]').append(options);
              });
          });

        }, 800);

      }
      //
      // getVehicleStats(){
      //   maker = document.querySelector('select[name="maker"]');
      //   mIndex = maker.selectedIndex;
      //   maker =  maker.options[mIndex].value;
      //
      //   model = document.querySelector('select[name="maker"]');
      //   var moIndex = maker.selectedIndex;
      //   maker =  maker.options[moIndex].value;
      //
      //   year = document.querySelector('select[name="maker"]');
      //   var yIndex = maker.selectedIndex;
      //   year =  maker.options[yIndex].value;
      //
      //   console.log('Tu vehiculo:' + ' ' + maker + model + ' ' + year);
      // }

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
        console.log(maker + ','+model+','+year);
        $.get("https://www.fueleconomy.gov/ws/rest/ympg/shared/vehicles?make="+maker+"&model="+model+"",function(data, status){
//         var jsonText = JSON.stringify(xmlToJson($(data)[0]));
// console.log(JSON.parse(jsonText));

// console.log(data);


            var fgYear = $('year',data).each(function(){

                  if (this.innerHTML == '2011') {
                        var vehicle = this.parentElement.childNodes;


                        // Combinned unrounded MPG for highway and city
                        console.log(vehicle[20].innerHTML);

                        // Unrounded MPG for city -- cityA08U
                        console.log(vehicle[9].innerHTML);


                        // Unrounded MPG for highway -- highway08U
                        console.log(vehicle[42].innerHTML);

                        console.log(vehicle);

                        // console.log(vehicle[43].nodeName);
                    return false;
                  }else {

                  }

              });

         });

      }


}
