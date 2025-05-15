$(document).ready(function() {


    // page_admin_categories.php
    $('#submitCategoryBtn').click(function() {
        $.post('../backend/phpscripts/log_activity.php', {
            action: 'CREATE',
            details: 'Admin created a new category'
        });
    });    

    //////////////////// MGA HINDI PA NACOCOMMIT /////////////////////


    ////////////////////////////// ADMIN ////////////////////////////// 

    ////////page_admin_article_management.php////////
    // ADD ID IN EXPORT
    $('#exportArticlesBtn').click(function() {
        $.post('../backend/phpscripts/log_activity.php', {
            action: 'READ',
            details: 'Exported articles'
        });
    });

    ////////page_admin_activity_log.php////////
    // BAKA MAY PROBLEM DITO,, DOUBLE CHECK !!!!!!

    $('#cleanLogsBtn').click(function() {
        $.post('../backend/phpscripts/log_activity.php', {
            action: 'DELETE',
            details: 'Cleaned logs'
        });
    });


    ////////page_admin_account_management.php////////
    // ADD ID IN ADD KEYWORD BUTTON
    $('#newAccountBtn').click(function() {
        $.post('../backend/phpscripts/log_activity.php', {
            action: 'CREATE',
            details: 'Admin create new Account'
        });
    });

    
    ////////page_admin_account_management.php////////
    // ADD ID IN ADD EXPORT BUTTON
    $('#exportAccountsBtn').click(function() {
        $.post('../backend/phpscripts/log_activity.php', {
            action: 'READ',
            details: 'Exported user accounts'
        });
    });

    
    ////////page_admin_keywords.php////////
    // ADD ID IN ADD KEYWORD BUTTON
    $('#addKeywordBtn').click(function() {
        $.post('../backend/phpscripts/log_activity.php', {
            action: 'CREATE',
            details: 'Created new keyword'
        });
    });

    ////////////////////////////// USER & ADMIN //////////////////////////////


    ////////page_user_account.php////////
    // ADD ID IN SAVE CHANGES BUTTON
    $('#changeAccBtn').click(function() {
        $.post('../backend/phpscripts/log_activity.php', {
            action: 'UPDATE',
            details: 'Changed account details'
        });
    });

    ////////page_change_password_accounts.php////////
    $('#changePassBtn').click(function() {    
        $.post('../backend/phpscripts/log_activity.php', {
            action: 'UPDATE',
            details: 'User changed password'
        });
    });


    ////////////////////////////// USER //////////////////////////////



});