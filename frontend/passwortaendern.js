const passwortaendern = document.querySelector('input[type="submit"]');
var hidden = document.getElementsByName("hiddensite");
var status;
passwortaendern.addEventListener('click',()=>{
  const formData = new FormData(document.querySelector('form'))
  var token = hidden.value;
  fetch('http://quizzapp.chickenkiller.com/quizzapp/backend/api.php?passtoken='+token, {
    method: 'GET',
    body: formData
  })
  .then(res => {
    status = res.status
    return res.text()
  })
  .then(data => {
    alert(data)
    if(status == 200)
    location.href = "./index.html"

  })
  .catch(err => { alert(err) })

})
