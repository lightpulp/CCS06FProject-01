
<form id="logoutForm" action="../backend/phpscripts/logout.php" method="POST" style="display:inline;">
    <button type="button" onclick="confirmLogout()" class="btn btn-danger btn-sm">Logout</button>
</form>

<script>
function confirmLogout() {
    if (confirm("Are you sure you want to log out?")) {
        document.getElementById("logoutForm").submit();
    }
}
</script>