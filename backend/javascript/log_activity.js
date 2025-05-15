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
    //OKS NA
    //MERON PA PERO KASAMA NA SA ISANG JAVASCIPRT SA PAGE_ADMIN_ARICLTE_MANAGEMENT.PHP UN

    ////////page_admin_activity_log.php////////
    // BAKA MAY PROBLEM DITO,, DOUBLE CHECK !!!!!!

    $('#cleanLogsBtn').click(function() {
        $.post('../backend/phpscripts/log_activity.php', {
            action: 'DELETE',
            details: 'Cleaned logs'
        });
    });
    //OKS NA


    ////////page_admin_account_management.php////////
    // ADD ID IN ADD KEYWORD BUTTON
    $('#newAccountBtn').click(function() {
        $.post('../backend/phpscripts/log_activity.php', {
            action: 'CREATE',
            details: 'Admin create new Account'
        });
    });
    //OKS NA

    
    ////////page_admin_account_management.php////////
    // ADD ID IN ADD EXPORT BUTTON
    $('#exportAccountsBtn').click(function() {
        $.post('../backend/phpscripts/log_activity.php', {
            action: 'READ',
            details: 'Exported user accounts'
        });
    });
    //OKS NARIN

    
    ////////page_admin_keywords.php////////
    // ADD ID IN ADD KEYWORD BUTTON
    $('#addKeywordBtn').click(function() {
        $.post('../backend/phpscripts/log_activity.php', {
            action: 'CREATE',
            details: 'Created new keyword'
        });
    });
    //OKS NA

    /// MERON DIN SA ADMIN_KEYWORDS.JS PERO KASAMA NA SA ONCLICK
    // OKS NARIN


    ////////page_user_edit_article.php////////
    $('#adminEditArticleBtn').click(function() {    
        $.post('../backend/phpscripts/log_activity.php', {
            action: 'UPDATE',
            details: 'Admin edited an article'
        });
    });

    ////////page_user_edit_article.php////////
    $('#adminChangeAccBtn').click(function() {
        $.post('../backend/phpscripts/log_activity.php', {
            action: 'UPDATE',
            details: 'Admin changed account details'
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
    // OKS NARIN

    ////////page_change_password_accounts.php////////
    $('#changePassBtn').click(function() {    
        $.post('../backend/phpscripts/log_activity.php', {
            action: 'UPDATE',
            details: 'User changed password'
        });
    });
    //OKS NARIN


    ////////////////////////////// USER //////////////////////////////

    ////////page_user_password_accounts.php////////
    $('#commentArticle').click(function() {    
        $.post('../backend/phpscripts/log_activity.php', {
            action: 'CREATE',
            details: 'User commented on an article'
        });
    });


    
    ////////page_user_create_article.php////////
    $('#createArticleBtn').click(function() {    
        $.post('../backend/phpscripts/log_activity.php', {
            action: 'CREATE',
            details: 'User created an article'
        });
    });


    ////////page_user_edit_article.php////////
    $('#usrEditArticleBtn').click(function() {    
        $.post('../backend/phpscripts/log_activity.php', {
            action: 'UPDATE',
            details: 'User edited an article'
        });
    });

    
    



});