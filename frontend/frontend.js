var registrieren = document.querySelector('.registrieren');
const login = document.querySelector('.login');
const edit = document.querySelector('.edit');
const logout = document.querySelector('.logout');
const statistik = document.querySelector('.statistik');


registrieren.addEventListener('click' ,() => {location.href="./registrieren.html"});
login.addEventListener('click' ,()=>{location.href="./login.html"});
edit.addEventListener('click', ()=>{location.href="./edit.html"});
statistik.addEventListener('click', ()=>{location.href="./statistik.html"});
logout.addEventListener('click', ()=>{location.href="./logout.html"});

