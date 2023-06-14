window.addEventListener("beforeunload", function (event) {
    
   
    // Make an AJAX request to log out the user
        fetch('/logout', {
            
           
    method: 'POST',
            
           
    credentials: 'same-origin', // Send cookies along with the request
        });
    });