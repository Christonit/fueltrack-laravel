function reviewInfo(){



}




function newVehicleValidation(e){

      var maker = document.querySelector('select[name="maker"]');
      var model = document.querySelector('select[name="model"]');
      var year = document.querySelector('select[name="year"]');

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

    var  usageYears = document.querySelector('input[name="usageYear"]');
    var  acquisitionDate = document.querySelector('input[name="AcquisitionDate"]');
    var  totalDistance = document.querySelector('input[name="totalDistance"]');

      if ( usageYears.value == '' && acquisitionDate.value == '' && totalDistance.value == '') {


      }else {

        vehicleInfoUsage.classList.add('hide');
        vehicleInfoMisc.classList.remove('hide');
        // continueBTN = document.querySelector(addVehicleForms[3] + ' a.success').onclick = vehicleUsageValidation;
      }

}

function newUserValidation(){

    var  username = document.querySelector('input[name="username"]').value;
    var  email = document.querySelector('input[name="email"]').value;
    var  password = document.querySelector('input[name="password"]').value;


      if (username !== '' && email !== '' &&  password !== '' && emailPtrn.test(email) == true ) {

        document.querySelector('#signup-vehicle-info-basic').classList.remove('hide');
        userDetails.classList.add('hide');
        document.querySelector('.tabs-title.is-active').classList.replace('is-active','is-done');
        document.querySelector('.tabs-title.is-done').nextElementSibling.classList.add('is-active');
        continueBTN = document.querySelector(addVehicleForms[1] + ' a.success').onclick = newVehicleValidation;



      }else{
      }
      alert('Revisar tu:' + username + ' '+ password + ' ' + email);

}


export { reviewInfo, newVehicleValidation, vehicleUsageValidation, newUserValidation};
