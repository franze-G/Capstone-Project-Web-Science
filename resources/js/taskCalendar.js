document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar");
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay",
        },
        events: "/api/projects",
        eventClick: function (info) {
            // Customize this to show project details or open your existing modal
            alert(
                "Project: " +
                    info.event.title +
                    "\nStatus: " +
                    info.event.extendedProps.status +
                    "\nPriority: " +
                    info.event.extendedProps.priority
            );
            info.jsEvent.preventDefault();
        },
        eventColor: function (info) {
            switch (info.event.extendedProps.priority) {
                case "high":
                    return "#FF4136";
                case "medium":
                    return "#FF851B";
                default:
                    return "#2ECC40";
            }
        },
    });
    calendar.render();
});
