$(document).ready(function() {
    $("#savePassForm").validate({
    rules: {
        user_pass: {
            required: true
        },
        new_pass: {
            required: true
        },
        new_passCheck: {
            required: true
        },
    },
    messages: {
        user_pass: "Please enter your old password.",
        new_pass: "Please enter your new password.",
        new_passCheck: "Please Confirm your new password.",
    },
    submitHandler: function (form, e) {
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
            $('#savePassForm')[0].reset();
        });
        }
    });
});