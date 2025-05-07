$(document).ready(function () {
    // Initialize DataTable
    const table = $('#articlesTable').DataTable();

    // Fetch articles from the backend
    $.get("../backend/phpscripts/admin_article_management.php", function (data) {
        try {
            const articles = JSON.parse(data);
            // If there are articles, populate the table
            if (Array.isArray(articles)) {
                articles.forEach(article => {
                    let status = '';
                    switch (article.status) {
                        case '1':
                            status = 'Pending';
                            break;
                        case '2':
                            status = 'Approved';
                            break;
                        case '3':
                            status = 'Fake';
                            break;
                        case '4':
                            status = 'Deleted';
                            break;
                    }

                    // Add row to DataTable
                    table.row.add([
                        article.article_id,
                        article.title,
                        article.user_name,
                        status,
                        article.category_name,
                        `<button class="btn btn-primary btn-sm" onclick="editArticle(${article.article_id})">Edit</button>
                         <button class="btn btn-danger btn-sm" onclick="deleteArticle(${article.article_id})">Delete</button>`
                    ]).draw();
                });
            } else {
                console.error('Error: No articles data.');
            }
        } catch (error) {
            console.error("Failed to parse articles data:", error);
        }
    });

    /*

    FOR EDITING & DELETING ARTICLES
    // Function to edit an article (this can redirect to another page for editing)
    window.editArticle = function(articleId) {
        window.location.href = `edit_article.php?id=${articleId}`;
    };

    // Function to delete an article (soft delete only)
    window.deleteArticle = function(articleId) {
        if (confirm("Are you sure you want to delete this article?")) {
            $.ajax({
                url: "../backend/phpscripts/admin_delete_article.php",
                type: "POST",
                data: { article_id: articleId },
                success: function(response) {
                    // Reload the page or update the table
                    location.reload();
                },
                error: function() {
                    alert("Error deleting article.");
                }
            });
        }
    };

    */
});
