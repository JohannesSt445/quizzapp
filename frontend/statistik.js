var user = document.getElementById("user");
var richtig = document.getElementById("richtig");
var falsch = document.getElementById("falsch");


async function getStatistik(){
  var api = await fetch('https://quizzapp.crabdance.com/backend/model.php?type=stats');

  var json_data = await api.json();

  console.log(json_data);



  json_data.forEach((item) =>
  {

    user.innerHTML = item.USERNAME;
    richtig.innerHTML = item.RICHTIGEANTWORT;
    falsch.innerHTML = item.FALSCHEANTWORT;
  });


}

getStatistik();