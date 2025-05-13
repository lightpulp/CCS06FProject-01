$(document).ready(function () {
    const articleId = new URLSearchParams(window.location.search).get('article_id');

    function fetchComments() {
        $.post('../backend/phpscripts/user_view_explore_article.php', {
            action: 'fetch_comments',
            article_id: articleId
        }, function (data) {
            const comments = JSON.parse(data);
            const container = $('.comments-list');
            container.empty();

            if (comments.length === 0) {
                container.append('<p class="text-muted">No comments yet.</p>');
            } else {
                comments.forEach(comment => {
                    const time = new Date(comment.created_at).toLocaleString();
                    container.append(`
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <img class="navbar-profile-image me-2" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f" alt="User" />
                                <strong>${comment.user_name}</strong>
                                <small class="text-muted ms-auto">${time}</small>
                            </div>
                            <p class="mb-2 text-muted">${comment.comment}</p>
                            <hr>
                        </div>
                    `);
                });
            }
        });
    }

    $('.btn:contains("Comment")').click(function () {
        const textarea = $('.comment-auto-resize');
        const comment = textarea.val().trim();

        if (!comment) return;

        $.post('../backend/phpscripts/user_view_explore_article.php', {
            action: 'post_comment',
            article_id: articleId,
            comment: comment
        }, function (response) {
            const res = JSON.parse(response);
            if (res.status === 'success') {
                textarea.val('');
                textarea.trigger('input');
                fetchComments();
            } else {
                alert("Failed to post comment.");
            }
        });
    });

    // Initial load
    fetchComments();
});
