<?php
    include 'require_all.php';

    $password = $_GET['password'];
    $encrypt = new EncryptDecrypt();


    echo "The encrypted value for [".$password."] is [".$encrypt->encrypt($password, $password)."]";

?>