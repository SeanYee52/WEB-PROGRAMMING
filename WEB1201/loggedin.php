<h1>LOG IN SUCCESSFUL</h1>
<?php
    session_start();
    echo $_SESSION['user_id'];
    echo $_SESSION['username'];
    echo $_SESSION['admin_id'];
    echo $_SESSION['name'];
?>