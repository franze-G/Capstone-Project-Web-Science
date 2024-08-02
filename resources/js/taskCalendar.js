import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";

export function initializeCalendar() {
    const calendarEl = document.getElementById("calendar");
    if (!calendarEl) {
        console.error("Calendar element not found.");
        return;
    }

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,dayGridWeek,dayGridDay",
        },
        events: async function (info, successCallback, failureCallback) {
            try {
                const response = await fetch("/api/calendar-tasks");
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                const tasks = await response.json();
                successCallback(
                    tasks.map((task) => ({
                        id: task.id,
                        title: `${task.title} (${task.priority})`, // Display title and priority
                        start: task.due_date, // Ensure this is in YYYY-MM-DD format
                    }))
                );
            } catch (error) {
                console.error("Error fetching tasks:", error);
                failureCallback(error);
            }
        },
        editable: true,
        eventClick: function (info) {
            console.log("Event clicked:", info.event);
        },
        eventDrop: function (info) {
            console.log("Event dropped:", info.event);
        },
    });

    calendar.render();
}
