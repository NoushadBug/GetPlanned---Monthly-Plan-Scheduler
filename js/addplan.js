
//////// WRITING THE HEADING WITH DATE MONTH AND YEAR DYNAMICALLY ////////


var headerElements = document.getElementById('head');
headerElements.innerHTML = localStorage.getItem('date')+" "+localStorage.getItem('month')+", "+localStorage.getItem('year')+"<br>"+localStorage.getItem('day');


//////// STORING SELECTED DATE MONTH AND YEAR FROM LOCAL STORAGE ////////

function sendDateInfo() 
{
    document.getElementById('hiddenvalue').value = localStorage.getItem('date')+" "+localStorage.getItem('month')+", "+localStorage.getItem('year');
}


