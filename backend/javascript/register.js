$('#registerForm').validate({
    errorElement: 'div',
    errorClass: 'invalid-feedback',
    highlight(el) {
        $(el).addClass('is-invalid').removeClass('is-valid');
    },
    unhighlight(el) {
        $(el).addClass('is-valid').removeClass('is-invalid');
    },
    errorPlacement(error, element) {
        if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    },
    rules: {
        user_fname: { required: true },
        user_lname: { required: true },
        user_name:  { required: true },
        user_email: { required: true, email: true },
        password:   { required: true },
        confirmPassword: {
            required: true,
            equalTo: '#regPassword'
        },
        birthdate:  { required: true, date: true },
        address:    { required: true },
        number: {
            required: true,
            digits: true,
            minlength: 11,
            maxlength: 11
        }
    },
    messages: {
        confirmPassword: {
            equalTo: 'Passwords must match.'
        },
        number: {
            minlength: 'Enter an 11-digit phone number, e.g. 09171234567',
            maxlength: 'Enter an 11-digit phone number, e.g. 09171234567'
        }
    },
    submitHandler: function(form, e) {
        e.preventDefault();

        let x = 0;

        const user_pass = $('#regPassword').val();
        const user_passCheck = $('#regConfirmPassword').val();
        const email = $('#user_email').val();
        const number = $('#number').val();
        
        if (user_pass !== user_passCheck) {
            alert("Passwords do not match.");
            x++;
            return;
        }

        if (!/^\d{11}$/.test(number)) {
            alert("Phone number must be exactly 11 digits.");
            x++;
            return;
        }

        if (x == 0) {
            $.ajax({
                url: "../backend/phpscripts/register.php",
                type: "POST",
                data: $('#registerForm').serialize(),
                success: function(response) {
                    console.log("Response from server:", response); // Log the response for debugging

                    if (response.status === "success") {
                        alert("Registered successfully!");
                        window.location.href = "page_login.php";
                    } else if (response.status === "error") {
                        alert("Error: " + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX request failed:", error);
                    alert("An error occurred while processing your request. Please try again later.");
                }
            });
        } else {
            alert("Something went wrong. Please try again later.");
        }
    }
});