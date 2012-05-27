<style>
label span
{
	display:inline-block;
	width:100px;
	padding-bottom:5px;
	
}

body
{
	font-family:arial;
}

.horizontal_middle
{
	width:260px;
}
#login_page .horizontal_middle
{
	margin-left:auto;
	margin-right:auto;
	margin-top:200px;
}

div.form 
{
	width:160px;
	
	#border:1px solid black;
	border-radius:30px;
	padding: 30px ;
	
	
	box-shadow:0px 0px 10px 10px  #ccc;
	height:170px;
}



input[type=submit]
{
float:right;
position:relative;
display:inline-block;
}

</style>

<?php
    session_start();
?>
<div id="login_page">
	<div class="horizontal_middle">
		<h1> Amit Levy's Site </h1>
		<div class="form">
			<form method="POST" action="validate_login.php">
				<p><label><span>Username</span> <input type="text" name="username"/></label></p>
				<p><label><span>Password</span> <input type="password" name="password"/></label></p>
				<input type="submit"/>
			</form>
		</div>
	</div>
</div>