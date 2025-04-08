<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <style>
        /* Success message styles */
       /* Success message styles */
       #success-message-container {
            position: fixed; /* Fixed position to always appear on top */
            top: 20px; /* Distance from the top of the page */
            left: 20px; /* Distance from the left of the page */
            width: calc(100% - 40px); /* Adjust width with margins */
            max-width: 400px; /* Optional: limit the maximum width */
            z-index: 10; /* Ensure it appears above other content */
            display: flex;
            flex-direction: column;
            align-items: stretch;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            
        }

        #success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-left: 5px solid #28a745;
            border-radius: 4px 4px 0 

0; /* Rounded corners at the top */ position: relative; }


#success-message .close {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 16px;
        color: #155724;
        cursor: pointer;
    }

    #progress-bar {
        width: 0;
        height: 5px;
        background-color: #28a745;
        border-radius: 0 0 4px 4px; /* Rounded corners at the bottom */
        transition: width 3s linear;
    }




</style>
<?php

if (isset($_SESSION['success'])) {
    echo '<div id="success-message-container">
            <div id="success-message">
                <button class="close" onclick="hideMessage()">x</button>
                <span>' . $_SESSION['success'] . '</span>
            </div>
            <div id="progress-bar"></div>
          </div>';
    unset($_SESSION['success']); // Clear the message after displaying
}
?>

<!-- Your account settings form goes here -->
<form id="account-settings-form">
    <!-- Form content -->
</form>

<script>
    // Show the message on page load
    document.addEventListener("DOMContentLoaded", function() {
        var messageBox = document.getElementById('success-message');
        var progressBar = document.getElementById('progress-bar');
        
        if (messageBox) {
            var container = document.getElementById('success-message-container');
            container.style.display = 'flex';
            progressBar.style.width = '100%';

            // Auto hide the message after 3 seconds
            setTimeout(function() {
                container.style.display = 'none';
            }, 3000);
        }
    });

    // Hide the message when close button is clicked
    function hideMessage() {
        var container = document.getElementById('success-message-container');
        container.style.display = 'none';
    }
</script>

</body>
</html>
