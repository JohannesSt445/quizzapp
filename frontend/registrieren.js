const registrieren = document.querySelector('input[type="submit"]');
var status;
registrieren.addEventListener('click',()=>{
  const formData = new FormData(document.querySelector('form'))
  fetch('http://quizzapp.chickenkiller.com/backend/api.php', {
    method: 'POST',
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
