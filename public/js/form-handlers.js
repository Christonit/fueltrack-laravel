let servicePerformedCheck = $('span[data-open="done-service"]');

let maintenanceServiceButton = $('form[name="service-performed"] a[data-form-action="continue"]');

let maintenanceInput = $('form[name="service-performed"] input[name="maintenance_service"]');

let maintenanceServiceCategory = $('form[name="service-performed"] select[name="service_category"]');

let onCategoryChange =() =>{

    return maintenanceServiceCategory.val();
};


let addMaintenanceServiceId = (e) =>{

  let maintenanceId = e.target.attributes['data-maintenance-id'].value;


      maintenanceInput.attr('value', maintenanceId);


};




let sendMaintenanceServiceData = (e) =>{

      maintenanceID = maintenanceInput[0].getAttribute('value');
      // console.log('/mark-as-performed/'+ maintenanceID +'/');
      fetch('/mark-as-performed/'+ maintenanceID +'/', {
            method: 'post',
            body: new FormData(document.querySelector('form[name="service-performed"]'))

        }).then(function(response){
            if(response.ok){

                console.log('envio exitoso');

                return;

            }
            else {
                throw "Error en la llamada Ajax";
            }
        }).catch(function(error){
            console.log(error);
        });

};

servicePerformedCheck.click((e)=>{
    addMaintenanceServiceId(e);
    e.preventDefault();
});


maintenanceServiceButton.click((e)=>{
    sendMaintenanceServiceData(e);
    e.preventDefault();

})


maintenanceServiceCategory.onchange = onCategoryChange();