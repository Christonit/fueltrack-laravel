function signUpValidation(username, userEmail, userPassword){

    var  newUsername = username;
    var  newEmail = userEmail;
    var  newPassword = userPassword;

    console.log(newUsername + ' ' + newEmail);

      if (newUsername !== '' && newEmail !== '' &&  newPassword !== '' && emailPtrn.test(newEmail) == true ) {

        document.querySelector('#signup-vehicle-info-basic').classList.remove('hide');
        userDetails.classList.add('hide');
        document.querySelector('.tabs-title.is-active').classList.replace('is-active','is-done');
        document.querySelector('.tabs-title.is-done').nextElementSibling.classList.add('is-active');
        // continueBTN = document.querySelector(addVehicleForms[0] + ' a.success').onclick = vehicleValidation;



      }else{
      }

}


let saludo = 'Klk';

export {signUpValidation,saludo};
