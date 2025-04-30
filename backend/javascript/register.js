$('#registerForm').on('submit', function(e) {
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
//EMAIL CHECKER STILL NOT WORKING
    if (x == 0) {
        $.ajax({
            url: "../backend/phpscripts/register.php",
            type: "POST",
            data: $('#registerForm').serialize(),
            success: function(response) {
                console.log("Response from server:", response);
                let res = JSON.parse(response);
                if (res.status === "success") {
                    alert("Registered successfully!");
                    window.location.href = "page_login.php";
                } else {
                    alert("Error");
                }
            }
        });
    } else {
        alert("Somethings wrong, try again later")
    }

});