

 
 //propiedades de fullCalendar
 document.addEventListener('DOMContentLoaded', function() {
   var calendarEl = document.getElementById('calendar');
   var calendar = new FullCalendar.Calendar(calendarEl, {
	 locale: 'es',
	 displayEventTime: false,
	 headerToolbar: {
	   left: 'prev,next today',
	   center: 'title',
	   right: 'dayGridMonth'
	 },

	 dayCellDidMount: function(info) {
	   if (info.date.getDay() === 0) { 
			   info.el.style.backgroundColor = "#999999";
		   }
	   },

	 events: {
	   url: 'ics/feed.ics',
	   format: 'ics',
	   failure: function() {
		 document.getElementById('script-warning').style.display = 'block';
	   }
	 },

	 loading: function(bool) {
	   document.getElementById('loading').style.display =
		 bool ? 'block' : 'none';
	 },
   });

   calendar.setOption('datesSet', function(info) {
	 $('.fc-day[data-date="' + bloqueo + '"]').css('background-color', '#999999');
   });

	 calendar.render();
   });






