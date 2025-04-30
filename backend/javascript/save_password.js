$(document).ready(function() {
    $('#savePassForm').on('submit', function(e) {
        e.preventDefault();

        // Get form values
        const oldPass = $('#user_pass').val();
        const newPass = $('#new_pass').val();
        const newPassCheck = $('#new_passCheck').val();

        // Validate if new passwords match
        if (newPass !== newPassCheck) {
            alert("New passwords do not match.");
            return;
        }

        // Proceed to submit the form
        $.post('../backend/phpscripts/save_password.php', {
            user_pass: oldPass,
            new_pass: newPass
        }, function(response) {
            alert(response);
        });
    });
});