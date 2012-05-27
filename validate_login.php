<?php 
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	// check if username & password match
	require_once 'require_all.php';

    $c = new LoginController();
    $c->login();



//
//    $query_result = query("query");
//    echo $query_result;
//	$query_result = query("select username, password, isAdmin from customer where username like :username", $username);
	
	//header('Location:login_form.php');
?>
 


