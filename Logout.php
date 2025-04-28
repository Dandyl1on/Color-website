<?php
session_start();
session_destroy();
echo "<script>
localStorage.setItem('isLoggedIn', 'false');
window.location.href = 'Index.php';
</script>";
?>