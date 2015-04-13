$(document).ready(function() {
	var currentTime = new Date();
	var day = currentTime.getDay();

	var weekday = new Array(7);
	weekday[0]=  "Sunday";
	weekday[1] = "Monday";
	weekday[2] = "Tuesday";
	weekday[3] = "Wednesday";
	weekday[4] = "Thursday";
	weekday[5] = "Friday";
	weekday[6] = "Saturday";

    $.ajax({
        type: "GET",
        url: "http://localhost/todayoftheweek/time.php",
        data: 'day=' + weekday[day],
        success: function(){
            
        }
    });
});
