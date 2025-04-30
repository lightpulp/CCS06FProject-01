$('#saveAccForm').on('submit', function(e) {
    e.preventDefault();

    if (!confirm("Do you want to save changes to your account details?")) {
        return;
    }

    $.ajax({
        url: "../backend/phpscripts/save_account.php",
        type: "POST",
        data: $('#saveAccForm').serialize(),
        success: function(response) {
            alert("Account details saved successfully!");
        },
        error: function() {
            alert("Something went wrong while saving.");
        }
    });
});
