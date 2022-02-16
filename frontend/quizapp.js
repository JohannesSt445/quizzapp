var kategorie_dropdown = document.getElementById("kategorie");
var schwierigkeit_dropdown = document.getElementById("level");
var startbutton = document.getElementById("start");
var frageText = document.getElementById("frageText");
var buttonArray = [document.getElementById("button1"),document.getElementById("button2"),document.getElementById("button3"),document.getElementById("button4")];


startbutton.addEventListener('click' ,() => {

  getfrageText(frageArray.array);
  
  buttonArray[0].disabled = false;
  buttonArray[1].disabled = false;
  buttonArray[2].disabled = false;
  buttonArray[3].disabled = false;
  antwortButtonText(antwortArray.array, buttonArray);
  antwortArray.array = [];
});


var frageArray = {};
frageArray.type = 'fragen';
frageArray.array = [];
var antwortArray = {};
antwortArray.type = 'antworten';
antwortArray.array = [];

async function getKategorien(){
  var api = await fetch('http://quizzapp.chickenkiller.com/quizzapp/backend/api.php?type=kategorie');

  var json_data = await api.json();

  kategorie_dropdown.innerHTML = "";
  json_data.forEach((item,idx) =>
  {
    var option = document.createElement("option");
    option.text = item.KATEGORIENAME;
    option.value = item.KATEGORIEID;
    kategorie_dropdown.appendChild(option);
  });
}


async function getSchwierigkeit(){
  var api = await fetch('http://quizzapp.chickenkiller.com/quizzapp/backend/api.php?type=schwierigkeit');

  var json_data = await api.json();

  schwierigkeit_dropdown.innerHTML = "";
  json_data.forEach((item,idx) =>
  {
    var option = document.createElement("option");
    option.text = item.NAME;
    option.value = item.SCHWIERIGKEITSID;
    schwierigkeit_dropdown.appendChild(option);
  });
}


async function getFrage(){

  var kategorie = kategorie_dropdown.value;
  var schwierigkeit = schwierigkeit_dropdown.value;

  var api = await fetch('http://quizzapp.chickenkiller.com/quizzapp/backend/api.php?type=frage&kategorieid='+kategorie+'&schwierigkeit='+schwierigkeit);

  var json_data = await api.json();

  
  json_data.forEach((item,idx) =>
  {
    frageArray.array.push({
    key: item.FRAGE,
    value: item.FRAGENID
    })
  });
  
 
}


async function getAntworten(fragenid){
  var api = await fetch('http://quizzapp.chickenkiller.com/quizzapp/backend/api.php?type=antwort&fragenid='+fragenid);
  var json_data = await api.json();
  console.log(json_data);
  json_data.forEach((item,idx) =>
  {
    antwortArray.array.push(item)
  });
    console.log(antwortArray);
}


async function getStatistik(){
  var api = await fetch('http://quizzapp.chickenkiller.com/quizzapp/backend/api.php?type=kategorie');
  json_data = await api.json();

  json_data.forEach((item) =>
  {
    user.innerHTML = item.USERNAME;
    richtig.innerHTML = item.RICHTIGEANTWORT;
    falsch.innerHTML = item.FLASCHEANTWORT;
  });

}


kategorie_dropdown.onchange = function(){
  getFrage();
}

schwierigkeit_dropdown.onchange = function(){
  getFrage();
}

function addPunkte(){
  if(c == 'R'){
    var api = fetch('http://quizzapp.chickenkiller.com/quizzapp/backend/api.php?type=kategorie');
  }

  if(c == 'F'){
    var api = fetch('http://quizzapp.chickenkiller.com/quizzapp/backend/api.php?type=kategorie');
  }

  getStatistik();
  buttonArray[0].value = "Done!";
  buttonArray[1].value = "Done!";
  buttonArray[2].value = "Done!";
  buttonArray[3].value = "Done!";
  buttonArray[0].disabled = true;
  buttonArray[1].disabled = true;
  buttonArray[2].disabled = true;
  buttonArray[3].disabled = true;
}


function getfrageText(fragenarray){
  if(fragenarray != undefined){
    console.log(fragenarray);
    var element = fragenarray.shift()
    getAntworten(element.value);
    frageText.innerHTML = element.key;
  }
  else{
    frageText.innerHTML = "Done!";
  }
}


function antwortButtonText(antworten, buttonArray){
  if(antworten != undefined){

      var counter = 0;
      antworten.forEach((item) =>
      {
        buttonArray[counter].value = item.ANTWORT;
        if(item.RICHTIGEANTWORT == 1){
          buttonArray[counter].addEventListener('click',()=>{
            addPunkte('R')
        })
      }
      else{
        buttonArray[counter].addEventListener('click',()=>{
          addPunkte('F');
        })
      }
      counter++;
  });
  
}
}


getKategorien();
getSchwierigkeit();
getStatistik();