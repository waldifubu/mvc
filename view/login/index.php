<?php
namespace View;

echo "MAIN - Login";
?>

<style>
	#loginBox {
		-moz-box-shadow: 10px 10px 5px #888;
		-webkit-box-shadow: 10px 10px 5px #888;
		box-shadow: 10px 10px 5px #888;
		border: 2px solid black;
		width: 360px;
		padding: 10px;
		height: 140px;
	}
</style>

<div id="loginBox">
<form action="login/checkLogin" method="post" id="login">
	<label>Login</label><input type="text" name="login" id="formLogin"/><br />
	<label>Kennwort</label><input type="password" name="password" id="formPass"/><br />
	<br />
	<label></label><input type="submit" id="subby"/>
</form>
</div>