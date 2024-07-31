import "./bootstrap";
import "./modal";
import "./payment";
import "./taskModal";

// Import profile, star rating functionality, and the close profile modal function from the combined file
import {
    showProfileModal,
    submitRating,
    closeProfileModal,
} from "./viewProfile";

// Make functions globally available if needed
window.showProfileModal = showProfileModal;
window.submitRating = submitRating;
window.closeProfileModal = closeProfileModal;
