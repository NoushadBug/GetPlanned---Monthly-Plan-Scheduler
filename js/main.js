// QUERY SELECTORS
const date_picker_element = document.querySelector('.date-picker');
const selected_date_element = document.querySelector('.date-picker .selected-date');
const dates_element = document.querySelector('.date-picker .dates');
const mth_element = document.querySelector('.date-picker .dates .month .mth');
const next_mth_element = document.querySelector('.date-picker .dates .month .next-mth');
const prev_mth_element = document.querySelector('.date-picker .dates .month .prev-mth');
const days_element = document.querySelector('.date-picker .dates .days');


// VARIABLES
const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
const LastDates = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
const dayslist = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
var myDay = new Map([['Sat', 'Saturday'],['Sun', 'Sunday'],['Mon', 'Monday'],['Tue', 'Tuesday'],['Wed', 'Wednesday'],['Thu', 'Thursday'],['Fri', 'Friday']]);
var leapyear = false;
var affectedDates= [];

let date = new Date();
let day = date.getDate();
let month = date.getMonth();
let year = date.getFullYear();
let gethisday = date.getDay();

let selectedDate = date;
let selectedDay = day;
let selectedMonth = month;
let selectedYear = year;

var element = document.getElementById("myDIV");

mth_element.textContent = months[month] + year;

selected_date_element.textContent = formatDate(date);
selected_date_element.dataset.value = selectedDate;
var a = 1;

// GENERATING THE DATES OF CURRENT MONTH
populateDates();

// EVENT LISTENERS
date_picker_element.addEventListener('click', toggleDatePicker);
next_mth_element.addEventListener('click', goToNextMonth);
prev_mth_element.addEventListener('click', goToPrevMonth);

// FUNCTIONS
function toggleDatePicker (e) {
	if (!checkEventPathForClass(e.path, 'dates')) {
		dates_element.classList.toggle('active');
	}

}

function goToNextMonth (e) {
	month++;
	if (month > 11) {
		month = 0;
		year++;
	}
	mth_element.textContent = months[month] + ' ' + year;
	populateDates();
}

function goToPrevMonth (e) {
	month--;
	if (month < 0) {
		month = 11;
		year--;
	}
	mth_element.textContent = months[month] + ' ' + year;
	populateDates();
}

const unique = (value, index, self) => {
	return self.indexOf(value) === index
  }


function populateDates(e) 
{

	$.post("connection.php", {
		month:months[month],
		year:year
		},
	function (data, status, jqXHR) 
	{
		days_element.innerHTML = '';

		leapyear = (year % 100 === 0) ? (year % 400 === 0) : (year % 4 === 0);
		if (leapyear === true)
		{
			LastDates[1] = 29;
		}
		else
		{
			LastDates[1] = 28;
		}

		amount_days = LastDates[month];	
		
		var count = 0;
		affectedDates = [];
		
		for (var i = 11; i<(data.length); i++)
		{
			
			if(data[i+1]!='"')
			{
				i++;
				affectedDates[count] = data[i-1]+data[i];
				
			}
			else
			{
				affectedDates[count] = data[i];
			}
			count++;
			i+=11;
		
		}
		
		affectedDates = affectedDates.filter(unique);
		if (months[month]=="January")
		{
			var jan = document.getElementById("wrapper");
			jan.style.backgroundColor = "red";
			console.log(months[month]);
		}
		for (let i = 0; i < amount_days; i++) 
		{
			const day_element = document.createElement('div');
			day_element.classList.add('day');
			day_element.textContent = i+1;

			if (selectedDay == (i + 1) && selectedYear == year && selectedMonth == month) {
				day_element.classList.add('selected');
				day_element.id = "uniqueday";
				
			}


			for(let j=0; j< affectedDates.length; j++)
			{
				if(i+1 == affectedDates[j])
				{var spanvar = document.createElement('span');
				day_element.appendChild(spanvar);}
				
			}

			day_element.addEventListener('click', function () {
				selectedDate = new Date(year + '-' + (month + 1) + '-' + (i + 1));
				selectedDay = (i + 1);
				selectedMonth = month;
				selectedYear = year;

				selected_date_element.textContent = formatDate(selectedDate);
				selected_date_element.dataset.value = selectedDate;

				populateDates();
				stablePop();
				a = 0;
			});

			days_element.appendChild(day_element);
		}

	}
		
	);
}

const dayselected = document.querySelector('#uniqueday');
if (dayselected)
{
	dayselected.addEventListener('click', stablePop);
}


// HELPER FUNCTIONS
function checkEventPathForClass (path, selector) {
	for (let i = 0; i < path.length; i++) {
		console.log();
		if (path[i].classList && path[i].classList.contains(selector)) {
			return true;
		}
	}
	
	return false;
}
function formatDate (d) {
	let day = d.getDate();
	if (day < 10) {
		day = '0' + day;
	}

	let month = d.getMonth() + 1;
	if (month < 10) {
		month = '0' + month;
	}

	let year = d.getFullYear();
	return  months[month-1] + ' '+ day + ', ' + year + ' (' + selectedDate.toString().split(' ')[0]+')';
}

function myFunction(a) {
	element.innerHTML = '';
	element.classList.toggle("mydivstyleactive");
	if (element.style.opacity == "0" )
	{
		element.style.opacity = "1";
	}	
	else
	{
		element.style.opacity = "0";
	}
	if(a != '1')
	{
		stablePop();
	}
}

function stablePop(){	
	console.log("dhukse");
	var Dynamicday = myDay.get(selectedDate.toString().split(' ')[0]);
	element.innerHTML = "<h2 style= \"font-weight:lighter;font-size:400%;\">"+selectedDay+"</h2><h2>"+months[selectedMonth]+", "+
	selectedYear+"</h2><p>"+Dynamicday+"</p><br><br>"+
	"<a href=\"./addplan.html\">add a plan</a><br><a href=\"./viewplan.php\">view plans</a></div>";
	localStorage.clear();
	localStorage.setItem('date',selectedDay);
	localStorage.setItem('day',Dynamicday);
	localStorage.setItem('month',months[selectedMonth]);
	localStorage.setItem('year',selectedYear);
}




