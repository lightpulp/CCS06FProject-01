    $(document).ready(function () {
    // Handle account update
    $('#accountForm').submit(function (e) {
        e.preventDefault();

        const accountData = {
            user_id: $('#user_id').val(),
            user_fname: $('#user_fname').val(),
            user_lname: $('#user_lname').val(),
            user_name: $('#user_name').val(),
            user_email: $('#user_email').val(),
            birthdate: $('#birthdate').val(),
            number: $('#number').val(),
            address: $('#address').val(),
            role: $('#role').val(),
            active: $('#active').val()
        };

        $.ajax({
            url: '../backend/phpscripts/admin_edit_account.php',
            type: 'POST',
            data: JSON.stringify(accountData),
            contentType: 'application/json',
            dataType: 'json', // Explicitly expect JSON response
            success: function (response) {
                if (response.success) {
                    alert('Account updated successfully!');
                    window.location.href = 'page_admin_account_management.php';
                } else {
                    alert('Error: ' + (response.error || 'Unknown error occurred'));
                }
            },
            error: function(xhr, status, error) {
                try {
                    // Try to parse the response if it's JSON
                    const response = JSON.parse(xhr.responseText);
                    alert('Error: ' + (response.error || error));
                } catch (e) {
                    // If not JSON, show the raw error
                    alert('Error: ' + error + '\nServer response: ' + xhr.responseText);
                }
            }
        });
    });
});