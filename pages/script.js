$(document).ready(function() {
    // Function to check for new entries
    function checkForNewEntries() {
        $.ajax({
            url: 'check.php',
            type: 'GET',
            success: function(response) {
                if (response === 'true') {
                    $('.wrapper').css('background-color', 'bluevoilet');
                    console.log(response);
                } else {
                    console.log(response)
                }
            }
        });
    }

    // Check for new entries every 5 seconds
    setInterval(checkForNewEntries, 1000);
});
