function searchDate(){document.querySelector("#date").addEventListener("input",t=>{const e=t.target.value;window.location="?date="+e})}function startApp(t){searchDate()}document.addEventListener("DOMContentLoaded",(function(){startApp()}));