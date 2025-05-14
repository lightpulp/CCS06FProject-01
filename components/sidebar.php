<?php
$activePage = basename($_SERVER['PHP_SELF']);
$userRole = $_SESSION['role']; // 1 = admin, 0 = user
?>

<div class="sidebar position-fixed top-0 bottom-0 bg-white border-end">
    <div class="d-flex align-items-center p-3">
        <a href="#" class="sidebar-logo text-uppercase fw-bold text-decoration-none text-brand fs-4">TUTUBAN</a>
        <i class="sidebar-toggle ri-arrow-left-circle-line ms-auto fs-5 d-none d-md-block"></i>
    </div>

    <ul class="sidebar-menu p-3 m-0 mb-0">
        <?php if ($userRole == 1): // Admin ?>
            <li class="sidebar-menu-item <?= $activePage == 'page_admin_dashboard.php' ? 'active' : '' ?>">
                <a href="page_admin_dashboard.php">
                    <i class="ri-dashboard-line sidebar-menu-item-icon"></i> Dashboard
                </a>
            </li>
            <li class="sidebar-menu-item <?= $activePage == 'page_admin_article_management.php' ? 'active' : '' ?>">
                <a href="page_admin_article_management.php"><i class="ri-newspaper-line sidebar-menu-item-icon"></i> Manage Articles</a>
            </li>
            <li class="sidebar-menu-item">
                <a href="#"><i class="ri-bar-chart-2-line sidebar-menu-item-icon"></i> Reports</a>
            </li>
            <li class="sidebar-menu-item <?= $activePage == 'page_admin_activity_log.php' ? 'active' : '' ?>">
                <a href="page_admin_activity_log.php"><i class="ri-time-line sidebar-menu-item-icon"></i> Activity Logs</a>
            </li>
            <li class="sidebar-menu-item <?= $activePage == 'page_admin_account_management.php' ? 'active' : '' ?>">
                <a href="page_admin_account_management.php"><i class="ri-group-line sidebar-menu-item-icon"></i> Account Management</a>
            </li>
            <?php else: // User ?>
            <li class="sidebar-menu-item <?= $activePage == 'page_user_dashboard.php' ? 'active' : '' ?>">
                <a href="page_user_dashboard.php">
                    <i class="ri-dashboard-line sidebar-menu-item-icon"></i> User Overview
                </a>
            </li>
            <li class="sidebar-menu-item <?= $activePage == 'page_user_create_article.php' ? 'active' : '' ?>">
                <a href="page_user_create_article.php">
                    <i class="ri-file-add-line sidebar-menu-item-icon"></i> Create Article
                </a>
            </li>
            <li class="sidebar-menu-item <?= $activePage == 'page_user_article_management.php' ? 'active' : '' ?>">
                <a href="page_user_article_management.php">
                    <i class="ri-newspaper-line sidebar-menu-item-icon"></i> My Articles
                </a>
            </li>
            <li class="sidebar-menu-item <?= $activePage == 'page_user_explore_article.php' ? 'active' : '' ?>">
                <a href="page_user_explore_article.php"><i class="ri-bar-chart-2-line sidebar-menu-item-icon"></i> Explore</a>
            </li>
        <?php endif; ?>

        <!-- Settings Section -->
        <li class="sidebar-menu-item has-dropdown">
            <a href="#" id="settingBar">
                <i class="ri-settings-2-line sidebar-menu-item-icon"></i> Settings
                <i class="ri-arrow-down-s-line sidebar-menu-item-accordion ms-auto"></i>
            </a>
            <ul class="sidebar-dropdown-menu">
                    <li class="sidebar-dropdown-menu-item <?= $activePage == 'page_user_account.php' ? 'active' : '' ?>">
                        <a href="page_user_account.php">Profile Setting</a>
                    </li>
                    <li class="sidebar-dropdown-menu-item <?= $activePage == 'page_change_password_account.php' ? 'active' : '' ?>">
                        <a href="page_change_password_account.php">Change Password</a>
                    </li>
                <?php if ($userRole == 1): // Admin ?>
                    <li class="sidebar-dropdown-menu-item <?= $activePage == 'page_admin_categories.php' ? 'active' : '' ?>">
                        <a href="page_admin_categories.php">Category Management</a>
                    </li>
                    <li class="sidebar-dropdown-menu-item <?= $activePage == 'page_admin_keywords.php' ? 'active' : '' ?>">
                        <a href="page_admin_keywords.php">Keywords Management</a>
                    </li>
                <?php endif; ?>
            </ul>
        </li>
    </ul>
</div>
<div class="sidebar-overlay d-none"></div>
