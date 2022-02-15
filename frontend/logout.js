const logout = document.querySelector('input[type="submit"]');
var status;
logout.addEventListener('click',()=>{
  const formData = new FormData(document.querySelector('form'))
  fetch('http://quizzapp.chickenkiller.com/quizzapp/backend/api.php', {
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