// Import other necessary scripts
import "./bootstrap";
import "./modal";
import "./payment";
import "./taskModal";

import {
    showProfileModal,
    submitRating,
    closeProfileModal,
} from "./viewProfile";

import { initializeCalendar } from "./taskCalendar";

import "./freelanceSort"; // Import the freelanceSort.js file

// Make functions globally available if needed
window.showProfileModal = showProfileModal;
window.submitRating = submitRating;
window.closeProfileModal = closeProfileModal;

document.addEventListener("DOMContentLoaded", function () {
    if (document.getElementById("calendar")) {
        initializeCalendar();
    }
});
