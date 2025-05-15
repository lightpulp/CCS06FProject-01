        $(document).ready(function() {
            // Log category creation
            $('#submitCategoryBtn').click(function() {
                // Simple AJAX call to log the action
                alert("CREATE Category WOWOWW");
                $.post('../backend/phpscripts/log_activity.php', {
                    action: 'Category Created',
                    details: 'Admin created a new category'
                });
            });
        });