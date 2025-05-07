function loadUsers() {
    const table = $('#accountTable').DataTable();

    $.getJSON("../backend/phpscripts/admin_account_table.php", function(response) {
        table.clear().rows.add(response.data).draw();
    });
}

$(document).ready(function() {
    loadUsers(); // load users after table is initialized
});
