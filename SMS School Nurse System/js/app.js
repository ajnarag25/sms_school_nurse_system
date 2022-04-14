document.addEventListener("DOMContentLoaded", function(event) {

 const showNavbar = (toggleId, navId, bodyId, headerId) =>{
 const toggle = document.getElementById(toggleId),
 nav = document.getElementById(navId),
 bodypd = document.getElementById(bodyId),
 headerpd = document.getElementById(headerId)
 
 // Validate that all variables exist
 if(toggle && nav && bodypd && headerpd){
 toggle.addEventListener('click', ()=>{
 // show navbar
 nav.classList.toggle('showNav')
 // change icon
 toggle.classList.toggle('bx-x')
 // add padding to body
 bodypd.classList.toggle('body-pd')
 // add padding to header
 headerpd.classList.toggle('body-pd')
 })
 }
 }
 
 showNavbar('header-toggle','nav-bar','body-pd','header')
 
 /*===== LINK ACTIVE =====*/
 const linkColor = document.querySelectorAll('.nav_link')
 
 function colorLink(){
 if(linkColor){
 linkColor.forEach(l=> l.classList.remove('active'))
 this.classList.add('active')
 }
 }
 linkColor.forEach(l=> l.addEventListener('click', colorLink))
 });


// auto bday addpatient
function calculate_bday() {
let bday = $('#bday').val();
let dob = new Date(bday);
let month_diff = Date.now() - dob.getTime();
let age_dt = new Date(month_diff);
let year = age_dt.getUTCFullYear();
let age = Math.abs(year - 1970);
$('#age').val(age);
}

// auto bday studentlist
function calculate_bdays() {
  let bday = $('#bdays').val();
  let dob = new Date(bday);
  let month_diff = Date.now() - dob.getTime();
  let age_dt = new Date(month_diff);
  let year = age_dt.getUTCFullYear();
  let age = Math.abs(year - 1970);
  $('#ages').val(age);
  }
  
// add meridian
let inputEle = document.getElementById('time');
function onTimeChange() {
  var timeSplit = inputEle.value.split(':'),
    hours,
    minutes,
    meridian;
  hours = timeSplit[0];
  minutes = timeSplit[1];
  if (hours > 12) {
    meridian = 'pm';
    hours -= 12;
  } else if (hours < 12) {
    meridian = 'AM';
    if (hours == 0) {
      hours = 12;
    }
  } else {
    meridian = 'am';
  }

  let t = hours + ':' + minutes + ' ' + meridian;
  inputEle.value(t)
}

// set min date - to date today
var today = new Date().toISOString().split('T')[0];
document.getElementsByName("date")[0].setAttribute('min', today);

// set min date - to date today
var today = new Date().toISOString().split('T')[0];
document.getElementsByName("date1")[0].setAttribute('min', today);