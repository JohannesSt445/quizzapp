var user = document.getElementById("user");
var punkte = document.getElementById("punkte");


async function getStatistik(){
  var api = await fetch('http://quizzapp.chickenkiller.com/quizzapp/backend/model.php?type=statistik');

  var json_data = await api.json();

  console.log(json_data);



  json_data.forEach((item) =>
  {

    user.innerHTML = item.USERNAME;
    punkte.innerHTML = item.PUNKTE;
    
  });


}

getStatistik();