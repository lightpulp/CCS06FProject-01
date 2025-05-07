let table;

function loadCategories() {
    $.get("../backend/phpscripts/admin_categories.php", function(data) {
        const categories = JSON.parse(data);
        let output = '';

        categories.forEach(cat => {
            output += `
                <tr>
                    <td>${cat.category_id}</td>
                    <td>${cat.category_name}</td>
                    <td>${cat.created_at}</td>
                    <td>
                        <button class="delete-btn" data-id="${cat.category_id}">Delete</button>
                    </td>
                </tr>
            `;
        });

        $('#category-table-body').html(output);

        if ($.fn.dataTable.isDataTable('#categoryTable')) {
            table.clear().destroy();
        }

        table = $('#categoryTable').DataTable();
    });
}

$(document).ready(function() {
    loadCategories();

    $('#categoryForm').submit(function(e) {
        e.preventDefault();
        const name = $('#categoryName').val();

        $.post("../backend/phpscripts/admin_categories.php", { categoryName: name }, function() {
            $('#categoryName').val('');
            loadCategories();
        });
    });

    $(document).on('click', '.delete-btn', function() {
        const id = $(this).data('id');

        if (confirm("Are you sure you want to delete this category?")) {
            $.ajax({
                url: "../backend/phpscripts/admin_categories.php",
                type: "DELETE",
                data: { id: id },
                success: function() {
                    loadCategories();
                }
            });
        }
    });
});
