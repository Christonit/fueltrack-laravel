export  getYears(){

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

}

 export getMakers(year = this.currentYear){

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
}

 export getModels(maker = this.makers[0], year = this.currentYear){
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

}

