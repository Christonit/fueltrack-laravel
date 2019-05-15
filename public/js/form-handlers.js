
let servicePerformedCheck = $('span[data-open="done-service"]');

let maintenanceServiceButton = $('form[name="service-performed"] a[data-form-action="continue"]');

let maintenanceInput = $('form[name="service-performed"] input[name="maintenance_service"]');

let maintenanceServiceCategory = $('form[name="service-performed"] select[name="service_category"]');

let onCategoryChange =(e) =>{
    return e.target.value;
};


let fetchSelfServiceOptions =  fetch('/self-service-options').then( (response)=>{
        return response.text();
    }).then( (data)=>{
        return data;
    });


let addMaintenanceServiceId = (e) =>{

  let maintenanceId = e.target.attributes['data-maintenance-id'].value;


      maintenanceInput.attr('value', maintenanceId);


};



// let fetchLastMaintenance = () => {
//
//     fetch('/latest-maintenance')
//         .then(response => {
//                 return response.text();
//
//         }).then(data => {
//
//             console.log(data);
//         return data;
//
//     }).catch(function (error) {
//         console.log(error);
//     });
// }


$('.fuelprices-btn').click( ()=>{

    console.log(fetchLastMaintenance());

});

let sendMaintenanceServiceData = (e) =>{

    maintenanceID = maintenanceInput[0].getAttribute('value');
    // console.log('/mark-as-performed/'+ maintenanceID +'/');

    fetch('/mark-as-performed/'+ maintenanceID +'/', {
        method: 'post',
        body: new FormData(document.querySelector('form[name="service-performed"]'))

    }).then(function(response){
        if(response.ok){

            // console.log('envio exitoso');


            return;
        }
        else {
            throw "Error en la llamada Ajax";
        }
    }).then().catch(function(error){
        console.log(error);
    });

};

servicePerformedCheck.click((e)=>{
    addMaintenanceServiceId(e);

    e.preventDefault();
});


maintenanceServiceButton.click((e)=>{

    let maintance_id = $('#done-service input[name="maintenance_service"]').val();


    sendMaintenanceServiceData(e);

            fetch('/latest-maintenance')
            .then(response => {
                return response.text();

            }).then(data => {

                $('[data-maintenance-id="'+maintance_id+'"]').parent().parent().remove();

                return $('#maintenance-logs tbody').prepend(data);


            }).catch(function (error) {
                console.log(error);
            });




    // console.log(e.targets.parent().parent());
    e.preventDefault();

});


maintenanceServiceCategory.on('change', (e) =>{
    let category = onCategoryChange(e);

    if(category == 'accesory install' || category == 'miscellaneous'){

        fetch('/self-service-options').then( (response)=>{
            return response.text();
        }).then( (data)=>{
            $('#warranty-options').after(data);
            $('#warranty-options').remove();
            return;
        });


    }else{
        fetch('/only-warranty-options').then( (response)=>{
            return response.text();
        }).then( (data)=>{

            $('#service-options').before(data);
            $('#service-options').remove();


            return;
        });
    }

});
