<?php

session_start();

session_destroy();

echo "<script>window.open('login.php?logged_out=logged out','_self')</script>";

?>