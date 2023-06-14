window.addEventListener("beforeunload", function (event) {
    // Make an AJAX request to clear the session
    fetch('/clear-session', {
        method: 'POST',
        credentials: 'same-origin', // Send cookies along with the request
    });
});
