<?php
 session_destroy();
 $_COOKIE['userId'] = null;
 $_COOKIE['hmac'] = null;
 header("Location:/amit/login_form.php");

?>