$(document).ready(function () {
    // Load categories into dropdown
    $.get("../backend/phpscripts/user_create_article.php", function (data) {
        const categories = JSON.parse(data);
        const $dropdown = $('#category');

        $dropdown.empty();
        $dropdown.append('<option value="">-- Select Category --</option>');

        categories.forEach(category => {
            $dropdown.append(`<option value="${category.category_id}">${category.category_name}</option>`);
        });
    });

    // Handle article submission
    $('#articleForm').submit(function (e) {
        e.preventDefault();

        const articleData = {
            title: $('#title').val(),
            content: $('#content').val(),
            source_url: $('#source_url').val(),
            category_id: $('#category').val(),
            date_published: $('#date_published').val()
        };

        $.ajax({
            url: '../backend/phpscripts/user_create_article.php',
            type: 'POST',
            data: JSON.stringify(articleData),
            contentType: 'application/json',
            success: function (response) {
                const res = JSON.parse(response);
                if (res.success) {
                    alert('Article submitted successfully!');
                    $('#articleForm')[0].reset();
                } else {
                    alert('Error: ' + res.error);
                }
            }
        });
    });
});
