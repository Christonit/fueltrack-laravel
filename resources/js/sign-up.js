continueBTN.onclick = signUpValidation;

previewBtn.addEventListener('click', (e) => {

      document.querySelector('.tabs-title').nextElementSibling.classList.remove('is-done','is-active');
      vehicleInfoMisc.classList.add('hide');
      userDetails.classList.remove('hide');
      document.querySelector('.tabs-title ').classList.add('is-active');
});

backBTN1.onclick = previewsTab;
backBTN2.onclick = previewsTab;
