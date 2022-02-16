var kategorie_dropdown = document.getElementById("kategorie");
var lvl_dropdown = document.getElementById("level");
var startbutton = document.getElementById("start");
var frageText = document.getElementById("frage");
var buttonArray = [document.getElementById("button1"),document.getElementById("button2"),document.getElementById("button3"),document.getElementById("button4")];


startbutton.addEventListener('click' ,() => {

  questionText(frageArray.array);
  buttonArray[0].disabled = false;
  buttonArray[1].disabled = false;
  buttonArray[2].disabled = false;
  buttonArray[3].disabled = false;
  ansBtnText(antwortArray.array, buttonArray);
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
    option.text = item.KATEGORIE;
    option.value = item.KATEGORIEID;
    kategorie_dropdown.appendChild(option);
  });
}


async function getSchwierigkeit(){
  var api = await fetch('http://quizzapp.chickenkiller.com/quizzapp/backend/api.php?type=kategorie');

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
  var level = lvl_dropdown.value;

  var api = await fetch('http://quizzapp.chickenkiller.com/quizzapp/backend/api.php?type=kategorie');

  var json_data = await api.json();

  
  json_data.forEach((item,idx) =>
  {
    fragenarray.array.push({
    key: item.FRAGE,
    value: item.FRAGENID
    })
  });
  console.log(frageArray);
  getAntworten(frageArray);
}


async function getAntworten(fragen){
  var api = await fetch('http://quizzapp.chickenkiller.com/quizzapp/backend/api.php?type=kategorie',{

  method: 'POST',
  headers: {"Content-Type": "application/json",
    'type' : 'antworten'},
  body: JSON.stringify(fragen)

}).catch(err => { alert(err)
});

var json_data = await resizeBy.json();
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

lvl_dropdown.onchange = function(){
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


function frageText(frage){
  if(frage != undefined){
    var element = frage.shift()
    console.log(frgae)
    frageText.innerHTML = element.key;
  }
  else{
    frageText.innerHTML = "Done!";
  }
}


function antwortButtonText(antworten, buttonArray){
  if(antworten != undefined){
      var ele = antwort.shift()
      var counter = 0;
      ele.forEach((item) =>
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